<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Todo;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class FindController extends Controller
{
    public function find(Request $request)
    {
        $user = Auth::user();
        $Todos = null;
        $Tags = Tag::all();
        $param = ['user' =>$user, 'Todos' => $Todos, 'Tags' => $Tags];
        return view('find', $param);
    }
    public function search(Request $request)
    {
        $form = $request->all();
        $user = Auth::user();
        if(count($form) == 3){
            $tag = Tag::where('tag', $form['select'])->first();
        } else{
            $tag = ['id' => 0];
        }
        $Tags = Tag::all();
        if($form['content'] == null){
        $Todos = Todo::where('users_id', $user['id'])->where('tags_id', 'LIKE BINARY',"%{$tag['id']}%")
        ->get();            
        }else{
        $Todos = Todo::where('users_id', $user['id'])->where('content', 'LIKE BINARY',"%{$form['content']}%")->orWhere('tags_id', 'LIKE BINARY',"%{$tag['id']}%")
        ->get();
        }
        
        $find = [
        'user' =>$user, 'Todos' => $Todos, 'Tags' => $Tags
        ];
        return view('find', $find);
    }
}
