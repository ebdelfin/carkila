<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }



    public function store(Request $request) {
    	$this->validate($request, [
            'user_id' 	=> 'required',
    		'owner_id' 	=> 'required',
    		'comment' 	=> 'required|max:5000',
            'rate'      => 'required',
    	]);

        //$post = Post::find($request->input('post_id'));
        $user = User::find($request->input('user_id'));


        $rate = $request->input('rate');

        $current_user = auth()->user()->id;
        $owner_id = $request->input('owner_id');
        //$user_id = $request->input('user_id');


        //if ($user->isRatedBy($owner_id)) {
        //    return back()->with('error', 'You already reviewed this user!');
        //}

        $user->getRatingBuilder()
                 ->user($owner_id) // you may also use $user->id
                 ->uniqueRatingForUsers(false) // update if already rated
                 ->rate($rate);
     


    	Comment::create([
    		'body' 		=> $request->input('comment'),
    		'owner_id' 	=> $request->input('owner_id'),
    		'user_id' 	=> $request->input('user_id'),
    	]);

    	return back()->with('success', 'Successfully rated.');
    }

    public function destroy($id) {
    	$comment = Comment::find($id);
        $post_id = $comment->post->id;
        $post = Post::find($post_id);

    	if (auth()->user()->id !== $comment->user_id) {
    		return back()->with('error', 'Unauthorized action');
    	}

        $post->deleteRatingsForUser($comment->user_id);

    	$comment->delete();
    	return back()->with('success', 'Comment has been successfully deleted.');
    }
}
