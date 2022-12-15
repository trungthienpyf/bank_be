<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PostController extends Controller
{
    public function index(Request $request)
    {


        return Post::query()->whereNull('winner')->latest()->get()->map(function ($item) {
            if($item->winner){
                $item->winnerName = User::find($item->winner)->fullName;
            }
          
            return $item;
        });
    }
    public function store(Request $request)
    {
        Post::create($request->all());
        return '00';
   }
}
