<?php
namespace App\Traits;
use App\Models\Payment;
use App\Models\PostComment;
use App\Models\User;
use Illuminate\Http\Request;

trait PostCommentTrait{
    use RefeshTokenTrait;
    public function storeEndTime ($post_id) {
        $checkPost=  PostComment::query()->with('post')->where('post_id',$post_id)->latest()->first();
        $sum=PostComment::query()->where('post_id',$post_id)->sum('amount');
        if(!empty($checkPost)){
            $sum= $sum +$checkPost->post->amountStart;
            $toAcc=User::where('id',$checkPost->post->user_id)->first();
            $fromAcc=User::where('id',$checkPost->user_id)->first();
            $this->sendMoney($sum, 'Tiền đấu giá thành công', $fromAcc->accountNumber, $toAcc->accountNumber, $checkPost->user_id);


//            Payment::create([
//                'description'=>'Tiền đấu giá',
//                'amount'=>$sum,
//                'toAcc'=>$toAcc->accountNumber,
//                'fromAcc'=>$fromAcc->accountNumber,
//            ]);

        }

    }
}
