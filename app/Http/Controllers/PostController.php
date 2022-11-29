<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PostController extends Controller
{
    public function index(Request $request)
    {

        return  Post::all();
    }
    public function store(Request $request)
    {
        Post::create($request->all());
        return '00';
   }
}
