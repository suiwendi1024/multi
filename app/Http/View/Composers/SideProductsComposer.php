<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class SideProductsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('side_products', \App\Models\Product::inRandomOrder()->limit(3)->get());
    }
}
