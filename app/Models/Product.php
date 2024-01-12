<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'product_price',
        'product_quantity',
        'product_status',
        'product_main_image',
        'product_purchasing_count'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productTranslations()
    {
        return $this->HasMany(ProductTranslation::class,"product_id");
    }

    public function images()
    {
        return $this->HasMany(ProductImage::class);
    }
    
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function scopeByLocale($query)
    {
        return $query->with(['productTranslations' => function($q){
            $q->where('locale',request()->language_id);
        }]);
    }

    public function scopeActive($query)
    {
        return $query->where('product_status', 'active');
    }

}
