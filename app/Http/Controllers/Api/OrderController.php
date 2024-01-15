<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\GetOrderRequest;
use App\Http\Requests\Order\GetUserOrdersRequest;
use App\Http\Requests\Order\UserCheckoutRequest as OrderUserCheckoutRequest;
use App\Interfaces\CartInterface;
use App\Interfaces\OrderInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\UserInterface;
use App\Repositories\OrderRepository;


class OrderController extends Controller
{
    public function __construct(private OrderInterface $orderRepository , private CartInterface $cartRepository , private UserInterface $userRepository , private ProductInterface $productRepository){
    }
    public function userCheckout(OrderUserCheckoutRequest $request){
        $user = auth()->user();
        $cart = $this->cartRepository->checkCartIfEmpty($user->id);
        if (!$cart) {
            return $this->sendError(__('messages.cart_is_empty'));
        }
        
        $cart_products_quantities_available = $this->cartRepository->checkCartProductsQuantities($cart);
        if (!$cart_products_quantities_available) {
            return $this->sendError(__('messages.cart_products_quantities_are_not_in_storage'));
        }
        
    
        $order_code = $this->orderRepository->getNewOrderCode();
        $cart_products = $this->cartRepository->getCartProductsForOrder($cart->id);
        $totals = $this->cartRepository->getCartTotalsForOrder($cart->id);

        $address_request = $request->only('zone_number','lat','long','building_number','street');
        // $this->userService->updateUserAddressByUser($user->id,$address_request);
        
        // Payment
        $order_payment_status = "pending";
        $payment_method = $request->payment_method;
        
        if($payment_method == "online") {
            $payment_id = $request->payment_id;
            // some code
            
        } elseif($payment_method == "cash_on_delivery") {
            $payment_id = null;
        }

        $order = OrderRepository::createOrder($payment_id, $order_payment_status, $payment_method, $user->id, $order_code, $totals->overall_total, $cart_products, $totals);

        if($order) {
            $this->userRepository->updateUserAddressByUser($user->id,$address_request, $order->id);
        }

        $this->cartRepository->emptyUserCart($user->id);

        foreach ($cart_products['products'] as $product) {
            $this->productRepository->substractQuantityIncreasePurchaseCount($product->id, $product->product_quantity);
        }

        return $this->sendResponse(__('messages.order_submitted'), []);
    }

    public function getUserOrders(GetUserOrdersRequest $request){
        $user = auth()->user();
        $success = $this->orderRepository->getUserOrders($user->id, $request->per_page);

        return $this->sendResponse(ResponseEnum::GET, $success);
    }

    public function getOrderTrackDetails(GetOrderRequest $request){
        $user = auth()->user();
      
        $result = $this->orderRepository->checkIfUserDidOrder($user->id, $request->order_id);
        
        if (!$result) {
            return $this->sendError(__('messages.order_not_found'), 400);
        } 

        $success = $this->orderRepository->getOrderTrackDetails($request->order_id);
        return $this->sendResponse(ResponseEnum::GET, $success);
    }
}
