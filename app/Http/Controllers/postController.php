<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class newPost extends Controller
{

  public function deletePost(Post $post){
    if(auth()->user()->id === $post['user_id']){
      $post->delete();
    }
    return redirect('/home');

  }

  public function updatePost(Post $post,Request $request){
    if(auth()->user()->id !== $post['user_id']){
      return redirect('/home');
    }

    $fields = $request->validate([
     'title' => 'required',
     'details' => 'required',
    ]);

    $fields['title'] = strip_tags($fields['title']);
    $fields['details'] = strip_tags($fields['details']);

    $post->update($fields);

    return redirect('home');
  }

  public function showEditScreen(Post $post){

    if(auth()->user()->id !== $post['user_id']){
      return redirect('/home');
    }

      return view('edit-post', ['post' => $post]);
  }

    public function post(Request $request){
        $fields = $request->validate([
          'title' => 'required',
          'details' => 'required'
        ]);

        $fields['title'] = strip_tags($fields['title']);
        $fields['details'] = strip_tags($fields['details']);
        $fields['user_id'] = auth()->id();

        Post::create($fields);
        return redirect('/home');
    }
}
