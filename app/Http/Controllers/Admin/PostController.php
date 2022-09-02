<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // mi vado a prendere i dati che voglio dal db e li passo alla view index
        $posts = Post::orderBy('id', 'desc')->paginate(5);

        //prendo tutte le categorie e le passo alla show
        $categories = Category::all();

        // dd($posts);

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //prendo tutte le categorie e le passo alla store
        $categories = Category::all();

        //prendo tutti i tags e le passo alla store
        $tags = Tag::all();

        // ritorno alla view create
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // arrivano i dati da create

        $data = $request->all();

        if (array_key_exists('image', $data)) {
            $data['original_name_image'] = $request->file('image')->getClientOriginalName();
            $data['image'] = Storage::put('uploads', $data['image']);
        }

        $new_post = new Post();

        $data['slug'] = Post::genereteSlug($data['title']);
        $new_post->fill($data);

        $new_post->save();
        // dd($new_post);


        // verifi se esiste l'array tags dentro data con il metodo array_key_exists() poi faccio l'attach
        if(array_key_exists('tags', $data)){

            $new_post->tags()->attach($data['tags']);
        }
        // dd($data);

        return redirect()->route('admin.posts.show', $new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // vado a prendere il singolo record tramite id e lo passo alla view show
        $post = Post::find($id);

        //prendo tutte le categorie e le passo alla show
        $categories = Category::all();

        if($post->image){
            $post->image = url("storage/" . $post->image );
        }else{
            $post->image = url("storage/uploads/placeholder-image.png");
        }

        return view('admin.posts.show', compact('post', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // modifico il record passato con id
        $post = Post::find($id);

        //prendo tutte le categorie e le passo alla update
        $categories = Category::all();

        //prendo tutti i tags e le passo alla update
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        // salvo la modifica
        $post = Post::find($id);

        $data = $request->all();

        if(array_key_exists('image', $data)){

            // se l'immagine è già presente vuol dire che va sostituita
            // quindi se presente la elimino
            if($post->image){
                Storage::delete($post->image);
            }

            $data['original_name_image'] = $request->file('image')->getClientOriginalName();
            $data['image'] = Storage::put('uploads', $data['image']);
        }

        // cambio lo slug solo se modifico il titolo
        if($data['title'] != $post->title){
            $data['slug'] = Post::genereteSlug($data['title']);
        }

        $post->update($data);

        // verifico se esiste l'array tags dentro data con il metodo array_key_exists(), se esiste faccio sync() altrimenti detach
        if(array_key_exists('tags', $data)){

            $post->tags()->sync($data['tags']);
        }else{

            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // cancello l'elemento selezionato

        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
