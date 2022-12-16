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


        return Post::query()->with("postComments")->whereNull('winner')->latest()->get()->map(function ($item) {
            if ($item->winner) {
                $item->winnerName = User::find($item->winner)->fullName;
            }
            if($item->postComments){
                $item->sumAmount = $item->amountStart +$item->postComments->sum('amount')  ;
            }
            return $item;
        });
    }

    public function showPostUser(Request $request)
    {

        return Post::query()->with("postComments")->where('user_id', $request->id)->latest()->get()->map(function ($item) {
            if ($item->winner) {
                $item->winnerName = User::find($item->winner)->fullName;
            }
            if($item->postComments){
                $item->sumAmount = $item->postComments->sum('amount') + $item->amountStart;
            }
            return $item;


        });
    }

    public function showPostReward(Request $request)
    {
        return Post::query()->with("postComments")->where('winner', $request->id)->latest()->get()->map(function ($item) {
            if ($item->winner) {
                $item->winnerName = User::find($item->winner)->fullName;
            }
            if($item->postComments){
                $item->sumAmount = $item->postComments->sum('amount') + $item->amountStart;
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
