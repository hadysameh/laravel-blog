<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Post;//to use the model 
use DB; //will bring the db liberray

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //this construct wont make as able to create or delete unless we loged in
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
        // this line is blocking every thing in the dashboard if user isnot authenticated
        //['except'=>['index','show'] this array is the exception pages
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $posts= Post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts',$posts);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            // this validation shit deals with sessions
            'cover_image'=>'image|nullable|max:1999'//means it must be image
            //max:1999 limits the size of the image to under 2mb
        ]);
        //handle file upload

        if($request->hasFile('cover_image'))//to check if there is a image uploaded
        {
            //get filename with the extension
            $fileNameWithExt =
             $request->file('cover_image')->getClientOriginalName();
            //get just file name
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);//extract the name form the ext ,normal php
            //get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //file name to store
            $fileNameToStore= $filename.'.'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }
        else
        {
            $fileNameToStore='noimage.jpg';
        }

        //create post

        $post= new Post;//this line creates a new post, new row
        
        //Post is a model ,this is like what is in pics in folder 3


        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id= auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        return redirect('/posts')->with('success'.'Post Created');
        //we created the messages file this is how we set it
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
        //will find it 'the post' by the id
        return view('posts.show')->with('post',$post);
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
        //check for correct user to access edit page
        if(Auth::user()->id != $post->user_id)
        {
            return redirect('/posts')->with('error','Unautherized Page');
        }
        return view('posts.edit')->with('post',$post);
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
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required'
        ]);

        //handle file upload

        if($request->hasFile('cover_image'))//to check if there is a image uploaded
        {
            //get filename with the extension
            $fileNameWithExt =
             $request->file('cover_image')->getClientOriginalName();
            //get just file name
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);//extract the name form the ext ,normal php
            //get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //file name to store
            $fileNameToStore= $filename.'.'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }
        

        $post= Post::find($id);

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image'))
        {
            $post->cover_image= $fileNameToStore;
        }
        $post->save();
        return redirect('/posts')->with('success'.'Post Updated');
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
        if(auth()->user()->id != $post->user_id)
        {
            return redirect('/posts')->with('error','Unautherized Page');
        }
        if($post->cover_image != 'noimage.jpg')
        {
            //delet
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success','Post Removed');
    }
}
