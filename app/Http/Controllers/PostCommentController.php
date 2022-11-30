<?php

namespace App\Http\Controllers;

use App\Events\MessagePosted;
use App\Models\PostComment;
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

        // Thêm dòng bên dưới
        // Gửi đến các user khác trong phòng TRỪ user tạo tin nhắn này
        broadcast(new MessagePosted($message->post_id));

        return $message->amount;
    }
    public function show (Request $request) {


       return  PostComment::where('post_id',$request->post_id)->latest()->get();
    }
}
