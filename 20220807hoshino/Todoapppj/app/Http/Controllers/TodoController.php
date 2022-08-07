<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Todo;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $Todos = Todo::where('users_id', $user['id'])->get();
        $Tags = Tag::all();
        $param = ['user' =>$user, 'Todos' => $Todos, 'Tags' => $Tags];
        return view('index', $param);
    }
    public function create(TodoRequest $request)
    {
        $form = $request->all();
        $user = Auth::user();
        $tag = Tag::where('tag', $form['select'])->first();
        Todo::create([
            'content' => $form['content'],
            'users_id' => $user['id'],
            'tags_id' =>  $tag['id']
        ]);
        return redirect('/');
    }
    public function update(TodoRequest $request)
    {
        $form = $request->all();
        $user = Auth::user();
        $tag = Tag::where('tag', $form['select'])->first();
        unset($form['_token']);
        Todo::where('id', $request->id)->update([
            'content' => $form['content'],
            'users_id' => $user['id'],
            'tags_id' =>  $tag['id']            
        ]);
        return redirect('/');
    }
    public function delete(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/');
    }
}