<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

class LanguageHeaderSwitcher
{
 
    public function handle(Request $request, Closure $next)
    {
        //     $routeName = Route::currentRouteName();
        //     $routes = Route::getRoutes();
            
        // $routeNamesInFile = collect($routes)->map->getName();

        // dd($routeNamesInFile);
        $langFromRequest = $request->header('language') ; 
        if ($langFromRequest== 'ar' || $langFromRequest == 'en') {
            App::setLocale($langFromRequest);
            $request['language_id'] = $langFromRequest == 'ar' ? 2 : 1;
        } else {
            App::setLocale(config('app.fallback_locale'));
            $request['language_id'] = 1;
        }
        return $next($request);
    }
}
