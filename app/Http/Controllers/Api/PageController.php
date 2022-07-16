<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // creo la function index e all'interno prendo l'elenco dei post e restituisco il json

    public function index(){

        $posts = Post::orderBy('id', 'desc')->with(['category', 'tags'])->paginate(5);

        $categories = Category::all();
        $tags = Tag::all();

        // $data = [
        //     'posts' => $posts,
        //     'categories' => $categories
        // ];

        return response()->json(compact('posts', 'categories', 'tags'));
    }

    public function show($slug){

        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();

        return response()->json($post);

    }

    public function getCategoryWithPosts($slug_category){

        $category = Category::where('sluh', $slug_category)->with('posts')->first();

        return response()->json($category);
    }

    public function getTagsWithPosts($slug_tag){

        $tag = Tag::where('sluh', $slug_tag)->with('posts')->first();

        return response()->json($tag);
    }
}
