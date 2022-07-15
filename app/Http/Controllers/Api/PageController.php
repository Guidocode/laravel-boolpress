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

        $posts = Post::orderBy('id', 'desc')->with(['category', 'tags'])->paginate(5);

        // $categories = Category::all();

        // $data = [
        //     'posts' => $posts,
        //     'categories' => $categories
        // ];

        return response()->json($posts);
    }

    public function show($slug){

        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();

        return response()->json($post);

    }
}
