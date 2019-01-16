<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;
use Illuminate\Http\File;
use Validator ;
use Illuminate\Http\Request;


class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
                                {
        $posts =   Post::orderBy('created_at','desc')->paginate(5);
        return view('/posts.index' , compact('posts'));
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
        if((auth()->user()) || (auth()->user()->type == 'admin' ) ||$this->middleware('auth') ) {
            $fileNameStoreImage = null;
            $fileNameStoreVideo = null;
            $fileNameStoreFile = null;
            //
            $this->validate($request, [
                'title' => 'required',
                'body' => 'required',
                'post_image' => 'image|nullable|max:3024 | mimes:jpg,png,jpeg,svg',
                'post_video' => 'nullable | max:20000 |mimes:mp4,3pg,flv,mkv,weba',
                'post_file' => 'nullable|max:1024 | mimes:pdf,txt,docx,doc,pptx,ppt,xls '
            ]);

            // upload image
            if ($request->hasFile('post_image')) {

                $filenameWithExtention = $request->file('post_image')->getClientOriginalName();
                $fileName = pathinfo($filenameWithExtention, PATHINFO_FILENAME);
                $extension = $request->file('post_image')->getClientOriginalExtension();
                $fileNameStoreImage = $fileName . '_' . time() . '.' . $extension;

                $path = $request->file('post_image')->move(base_path() . '/public/uploaded/images/', $fileNameStoreImage);

            }


           //upload video
            if ($request->hasFile('post_video')) {

                $filenameWithExtention = $request->file('post_video')->getClientOriginalName();
                $fileName = pathinfo($filenameWithExtention, PATHINFO_FILENAME);
                $extension = $request->file('post_video')->getClientOriginalExtension();
                $fileNameStoreVideo = $fileName . '_' . time() . '.' . $extension;

                $path = $request->file('post_video')->move(base_path() . '/public/uploaded/videos/', $fileNameStoreVideo);

            }

            //upload file
            if ($request->hasFile('post_file')) {

                $filenameWithExtention = $request->file('post_file')->getClientOriginalName();
                $fileName = pathinfo($filenameWithExtention, PATHINFO_FILENAME);
                $extension = $request->file('post_file')->getClientOriginalExtension();
                $fileNameStoreFile = $fileName . '_' . time() . '.' . $extension;

                $path = $request->file('post_file')->move(base_path() . '/public/uploaded/files/', $fileNameStoreFile);


            }

            $post = new Post;
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->user_id = auth()->user()->id;
            $post->post_image = $fileNameStoreImage;
            $post->post_video = $fileNameStoreVideo;
            $post->post_file = $fileNameStoreFile;
            $post->save();

            return redirect('/posts')->with('success', 'Done successfully');
        }else{
            return redirect('/login')->with('Unauthorized' , 'Please Login First');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post  =   Post::find($id);

        if((auth()->user()->id == $post->user_id) || (auth()->user()->type == 'admin' ) ){
             return view('posts.edit')->with('post',$post);
        }

        return redirect('/posts')->with('error','Unauthorized');
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
        $post = Post::findOrFail($id);

     if((auth()->user()->id == $post->user_id) || (auth()->user()->type == 'admin' ) ){

        $fileNameStoreImage = $post->post_image;
        $fileNameStoreVideo = $post->post_video;
        $fileNameStoreFile = $post->post_file;

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'post_image' => 'image|nullable|max:3024 | mimes:jpg,png,jpeg,svg',
            'post_video' => 'nullable | max:20000 |mimes:mp4,3pg,flv,mkv,weba',
            'post_file' => 'nullable|max:1024 | mimes:pdf,txt,docx,doc,pptx,ppt,xls '
        ]);

//upload image
        if ($request->hasFile('post_image')) {

            $filenameWithExtention = $request->file('post_image')->getClientOriginalName();
            $fileName = pathinfo($filenameWithExtention, PATHINFO_FILENAME);
            $extension = $request->file('post_image')->getClientOriginalExtension();
            $fileNameStoreImage = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('post_image')->move(base_path() . '/public/uploaded/images/', $fileNameStoreImage);
        }

//        upload video
        if ($request->hasFile('post_video')) {

            $filenameWithExtention = $request->file('post_video')->getClientOriginalName();
            $fileName = pathinfo($filenameWithExtention, PATHINFO_FILENAME);
            $extension = $request->file('post_video')->getClientOriginalExtension();
            $fileNameStoreVideo = $fileName . '_' . time() . '.' . $extension;

            $path = $request->file('post_video')->move(base_path() . '/public/uploaded/videos/', $fileNameStoreVideo);

//            $fileNameStoreImage = null;
//            $fileNameStoreFile = null;
        }

        //        upload file
        if ($request->hasFile('post_file')) {

            $filenameWithExtention = $request->file('post_file')->getClientOriginalName();
            $fileName = pathinfo($filenameWithExtention, PATHINFO_FILENAME);
            $extension = $request->file('post_file')->getClientOriginalExtension();
            $fileNameStoreFile = $fileName . '_' . time() . '.' . $extension;

            $path = $request->file('post_file')->move(base_path() . '/public/uploaded/files/', $fileNameStoreFile);

//            $fileNameStoreVideo = null;
//            $fileNameStoreImage = null;
        }

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->post_image = $fileNameStoreImage;
        $post->post_video = $fileNameStoreVideo;
        $post->post_file = $fileNameStoreFile;
        $post->update();

                 return redirect('/posts')->with('success', 'Done successfully');
    }else{
         return redirect('/posts')->with('error','Unauthorized');
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
        $post =   Post::findOrFail($id);
        $comment = Comment::where('post_id',$id);
        if((auth()->user()->id == $post->user_id) ||  auth()->user()->type == 'admin'){

            if($post->post_image){
                Storage::delete('/public/uploaded/images/'.$post->post_image);
            }
            if($post->post_video){
                Storage::delete('/public/uploaded/videos/'.$post->post_video);
            }
            if($post->post_file){
                Storage::delete('/public/uploaded/files/'.$post->post_file);
            }

            $comment->delete();
            $post->delete() ;
            
            return redirect('/posts')->with('success', 'Done successfully');
         }else{
           return redirect('/posts')->with('error','Unauthorized');

        }

    }

//    view post
 public function viewPost($id)
 {
     $post = Post::findOrFail($id);
     return view('posts/viewPost' , compact('post'));
 }

 // add Commment
    public function addComment(Request $request , $id ){
        if ($request->isMethod('post')){
            $comment = new Comment();
            $comment->comment_body = $request->input('body');
            $comment->post_id = $id ;
            $comment->user_id = auth()->user()->id ;
            $comment->save();
        }

        return redirect()->back();
    }

    //delete comment
    public function destroyComment($id){
        $comment = Comment::findOrFail($id);
        $pid = $comment->post_id;
        $comment->delete();
        return redirect("/posts/".$pid.'/view');
    }

}

