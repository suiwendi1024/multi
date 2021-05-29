<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class RankingPostsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('ranking_posts', \App\Models\Post::latest('comments_count')->limit(10)->get());
    }
}
