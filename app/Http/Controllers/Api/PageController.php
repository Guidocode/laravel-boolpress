<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // creo la function index e all'interno prendo l'elenco dei post e restituisco il json

    public function index(){

        $posts = Post::with('category')->with('tags')->get();

        $categories = Category::all();

        $data = [
            'posts' => $posts,
            'categories' => $categories
        ];

        return response()->json($data);
    }
}
