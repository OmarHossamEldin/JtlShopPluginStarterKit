<?php

namespace Plugin\JtlShopStarterKite\Src\Controllers;

use Plugin\JtlShopStarterKite\Src\Models\Post;
use Plugin\JtlShopStarterKite\Src\Requests\PostStoreRequest;

class PostController extends BaseController
{
    public function index($smarty)
    {
        $post     = new Post;
        $posts    = $post->all();
        return $smarty->assign('posts', $posts);
    }

}
