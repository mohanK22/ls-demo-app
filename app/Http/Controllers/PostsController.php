<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Post;
use DB;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // $posts = Post::orderBy('updated_at', 'desc')->get();
        // $posts = Post::where('title', 'Post Two')-get();
        // $posts = DB::select('select * from posts');
        // $posts = Post::orderBy('updated_at', 'desc')->take(10)->get();
        $posts = Post::orderBy('updated_at', 'desc')->paginate(7);
        return view('pages.posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'post_title' => 'required',
            'post_body' => 'required',
            'post_cover_img' => 'image|nullable|max:4999'
        ]);

        // Handle file upload
        if($request->hasFile('post_cover_img')){
            // Get file name with extension
            $fileNameWithExt = $request->file('post_cover_img')->getClientOriginalName();

            // Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just file extension
            $fileExt = $request->file('post_cover_img')->getClientOriginalExtension();

            // File name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;

            // Upload Image File
            $path = $request->file('post_cover_img')->storeAs('public/cover_images', $fileNameToStore);

        }else{
            $fileNameToStore = 'noimageavailable.jpg';
        }


        // Create Post
        $post = new Post;
        $post->title = $request->input('post_title');
        $post->body = $request->input('post_body');
        $post->user_id = auth()->user()->id;
        $post->cover_img =$fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');

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
        return view('pages.posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // Check for User
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }else{
            return view('pages.posts.edit')->with('post', $post);
        }
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
        $this->validate($request,
        [
            'post_title' => 'required',
            'post_body' => 'required',
            'cover_img' => 'image|nullable|max:4999',
            'post_cover_img' => 'image|nullable|max:4999'
        ]);

        // Handle file upload
        if($request->hasFile('post_cover_img')){
            // Get file name with extension
            $fileNameWithExt = $request->file('post_cover_img')->getClientOriginalName();

            // Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just file extension
            $fileExt = $request->file('post_cover_img')->getClientOriginalExtension();

            // File name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;

            // Upload Image File
            $path = $request->file('post_cover_img')->storeAs('public/cover_images', $fileNameToStore);

        }

        // Update Post
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }else{
            $post->title = $request->input('post_title');
            $post->body = $request->input('post_body');
            $post->user_id = auth()->user()->id;
            if($request->hasFile('post_cover_img')){
                if($post->cover_img != 'noimageavailable.jpg'){
                    // Delete Image File
                    Storage::delete('public/cover_images/' . $post->cover_img);
                }
                $post->cover_img =$fileNameToStore;
            }
            $post->save();

            return redirect('/posts')->with('success', 'Post Updated');
        }
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

        // Check for User
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }else{

            if($post->cover_img != 'noimageavailable.jpg'){
                // Delete Image File
                Storage::delete('public/cover_images/' . $post->cover_img);
            }

            $post->delete();
            return redirect('/posts')->with('success', 'Post Deleted');
        }
    }
}
