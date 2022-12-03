<?php

namespace App\Http\Controllers;

use App\Events\MessagePosted;
use App\Models\Payment;
use App\Models\PostComment;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;


class PostCommentController extends Controller
{
    public function store (Request $request) {

        $message = new PostComment();
        $message->user_id = $request->user_id;

        $message->post_id = $request->post_id;
        $message->amount = $request->amount;


        $message->save();


        broadcast(new MessagePosted($request->post_id,$request->user_id,$request->amount));

        return $message->amount;
    }
    public function storeEndTime (Request $request) {
      $checkPost=  PostComment::query()->with('post')->where('post_id',$request->post_id)->latest()->first();
        $sum=PostComment::query()->where('post_id',$request->post_id)->sum('amount');
        if(!empty($checkPost)){
            $sum= $sum +$checkPost->post->amount;
            $toAcc=User::where('id',$checkPost->post->user_id)->first();
            $fromAcc=User::where('id',$checkPost->user_id)->first();

            Payment::create([
                'description'=>'Tiền đấu giá',
                'amount'=>$sum,
                'toAcc'=>$toAcc->accountNumber,
                'fromAcc'=>$fromAcc->accountNumber,
            ]);

        }

        return "Không có người đấu giá";
    }
    public function show (Request $request) {


       return  PostComment::query()->where('post_id',$request->post_id)->latest()->get();
    }
}
