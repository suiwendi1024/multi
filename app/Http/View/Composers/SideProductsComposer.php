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
        $count = \App\Models\Product::count();
        $ids = [];

        while (count($ids) < 3) {
            $id = random_int(1, $count);

            if (!in_array($id, $ids)) {
                $ids[] = $id;
            }
        }

        $view->with('side_products', \App\Models\Product::findMany($ids));
    }
}
