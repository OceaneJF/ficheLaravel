<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function showCreate()
    {
        return view('post.create');
    }


    public function posts()
    {
        $posts = DB::table("posts")->orderBy("id", "desc")->paginate(10);

        return view('home', ['posts' => $posts]);
    }

    public function create(ResourceRequest $request)
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'Content-type' => 'application/json; charset=UTF-8',
        ])->post('https://jsonplaceholder.typicode.com/posts', [
            'title' => $request->title,
            'body' => $request->body,
            'userId' => 1
        ]);
        if ($response->successful()) {
            return redirect()->route("posts");
        }
        return back()->withErrors([
            'erreur' => "ca n'a pas été envoyé"
        ])->onlyInput('body');

    }


}
