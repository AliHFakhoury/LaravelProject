<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class APIController extends Controller {
    public function testController(Request $request){
        return response()->json([
            'message' => 'API Controller works!',
            'request' => $request
        ]);
    }

    public function getPosts(){
        $posts = Post::all();

        return response()->json($posts);
    }

    public function createPost(Request $request){
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        
        $incomingFields['user_id'] = "2"; // will be updated based on logged in user via session.

        $createPost = Post::create($incomingFields);

        return response()->json([
            'response' => $createPost
        ]);
    }

    public function getPost($id){
        $post = Post::find($id);

        return response()->json($post);
    }

    public function deletePost($id){
        $post = Post::find($id);

        if($post){
            $deleted = $post->delete();
            return response()->json([
                "message" => "Post deleted."
            ]);
        }else{
            return response()->json([
                "message" => "Post not found."
            ]);
        }

    }

    public function testCORS(){
        return response()
        ->json(['data' => 'your data'])
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Origin, Authorization');
    }
}