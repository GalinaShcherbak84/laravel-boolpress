<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();

        return view('admin.posts.index', compact('posts', 'categories'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validazione
        $request->validate([
            'title'=>'required|unique:posts|max:20',
            'content'=>'required',
            'category_id'=>'nullable|exists:categories,id',
            'tags'=>'nullable|exists:tags,id',

        ],[
            'required'=>'The :attribute is required!!!!!', //customize
            'unique'=>'The :attribute must be unique!!!!!' //customize
        ]);
        $data = $request->all();

        //gen slug
        $data['slug'] = Str::slug($data['title'], '-');

        //create and save record in db
        $new_post = new Post();
        $new_post->fill($data); //!!!!!fIllable
        //save new post
        $new_post->save();

        //salva la relazione con tags in tabella pivot
        if(array_key_exists('tags',$data)){
            $new_post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $new_post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if (!$post) {
            abort(404);
        }
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::find($id);
        $tags = Tag::all();
        if (! $post) {
            abort(404);
        }
        return view('admin.posts.edit', compact('post', 'categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validation
        $request->validate([
            /* 'title'=>'required|unique:posts|max:20', */
            'title'=>[
                'required',
                Rule::unique('posts')->ignore($id),
                'max:255',
            ],
            'content'=>'required',
            'category_id'=>'nullable|exists:categories,id',
            'tags'=>'nullable|exists:tags,id'
        ],[
            'required'=>'The :attribute is required!!!!!', //customize
            'unique'=>'The :attribute must be unique!!!!!' //customize
        ]);

        $data = $request->all();
        $post = Post::find($id);

        //gen slug
        if($data['title'] != $post->title){
            $data['slug'] = Str::slug($data['title'],'-');
        }

        $post->update($data); // fillable

        //aggiorna relazionetabella pivot
        if(array_key_exists('tags',$data)){
            $post->tags()->sync($data['tags']);
        }else{
            $post->tags()->detach();
        }
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete($id);
        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }
}
