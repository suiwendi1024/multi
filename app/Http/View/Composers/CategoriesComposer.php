<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class CategoriesComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', \App\Models\Category::firstGeneration()->whereType('post')->with('children')->get());
    }
}
