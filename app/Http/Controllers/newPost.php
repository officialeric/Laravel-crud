<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class newPost extends Controller
{
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
