<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostInteration;
use Illuminate\Http\Request;
use Validator;

class PostInterationController extends Controller
{
    //
    public function likePost(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'post_id' => ['required'],
        ]); 
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()],401);
        } 
        try {
            $post = Post::find($request['post_id']);
            $this->authorize('like', [Post::class, $post]);
            $postInteraction = PostInteration::where('user_id' , auth()->user()->id)
                                                ->where('post_id' ,$request['post_id'])
                                                ->first();
            if ($postInteraction) {
                $postInteraction->delete();
                return response()->json([
                    "status" => 0,
                    "message" => "Post Unliked",
                    ],200);
            } else {
                PostInteration::create([
                    "user_id" => auth()->user()->id,
                    "post_id" => $request['post_id'] ,
                ]);
                return response()->json([
                    "status" => 1,
                    "message" => "Post Liked",
                    ],200);
            }
        } catch (\Exception $e) {
            return response()->json([
                "message"=>"Something went wrong ",
                ],500);
        }
    }
}
