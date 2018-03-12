<?php namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Routing\Middleware;
use Session;
 
 
class Language {
 
 
    public function handle($request, Closure $next)
    {
        
        $locales = config('app.locales');
        $locale = $request->get('lang');
        if(!is_null($locale) && is_array($locales) && array_key_exists($locale, $locales)){
            \App::setLocale($locale);
            session(['lang'=>$locale]);
        }elseif(!is_null(session('lang'))){
            \App::setLocale(session('lang'));
        }else{
            \App::setLocale(config('app.default_locale'));
        }
        
        return $next($request);
    }
 
}