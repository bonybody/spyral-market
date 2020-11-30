<?php

namespace App\Http\Middleware;

use App\Category;
use App\Sub_category;
use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\View\Factory;

class SetValueBeforehand
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function __construct()
    {
        $this->categories = Category::all();
        $this->sub_categories = Sub_category::all();
    }

    public function handle($request, Closure $next)
    {
        View::share([
            'categories' => $this->categories,
            'sub_categories' => $this->sub_categories,
            ]);
        return $next($request);
    }
}
