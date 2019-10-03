<?php

namespace App\Http\Controllers;

use App\Post;
use App\Follower;
use App\Like;
use App\Http\Resources\Post as PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::orderBy('created_at','asc')->paginate(1);
        return PostResource::collection($posts);
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=new Post();
        $post->title=$request->title;
        $post->body=$request->body;
        $post->user_id=Auth::user()->id;
        if($post->save())
        {
            return new PostResource($post);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
    public function addLike(Request $request,$post_id)
    {
        if (!Like::where('user_id','=',Auth::user()->id)->where('post_id','=',$post_id)->exists())
         {
            $like=new Like();
            $like->like=1;
            $like->post_id=$post_id;
            $like->user_id=Auth::user()->id;
            $like->save();
        }
        $post=Post::find($post_id);
        return new PostResource($post);
    }
    
    public function removeLike(Request $request,$post_id ,$like_id)
    {
        $like=Like::find($like_id);
        if ($like !=null )
        {
            $like->delete();
        }
        
        
        $post=Post::find($post_id);
        return new PostResource($post);
    }
    public function follow(Request $request,$other_id)
    {
        $follow=new Follower();
        $follow->user_id=Auth::user()->id;
        $follow->leader_id=$other_id;
        $follow->save();
        return $follow;
    }
    public function unfollow(Request $request,$other_id)
    {
        $follow=Follower::where('user_id','=',Auth::user()->id)->where('leader_id','=',$other_id)->first();
        $follow->delete();
        return $follow;
    }
}
