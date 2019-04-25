<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ReplyRequest;
use App\Models\Reply;
use App\Models\Topic;
use App\Transformers\ReplyTransformer;
use App\User;
use Illuminate\Http\Request;

class RepliesController extends Controller
{

    public function store(ReplyRequest $request, Topic $topic, Reply $reply){

        $reply->content  = $request->content;
        $reply->topic_id = $topic->id;
        $reply->user_id  = $this->user()->id;
        $reply->save();

        return $this->response->item($reply, new ReplyTransformer())
            ->setStatusCode(200);
    }


    public function destroy(Topic $topic, Reply $reply){

        if($topic->id != $reply->topic_id){
            return $this->response->errorBadRequest();
        }

        $this->authorize('destroy', $reply);

        $reply->delete();

        return $this->response->noContent();
    }

    public function index(Topic $topic, Request $request){
        $replies = $topic->replies()->paginate(20);
        //dd($this->response);
        return $this->response->paginator($replies, new ReplyTransformer());
    }


    public function userIndex(User $user){

        $replies = $user->replies()->paginate(20);
        return $this->response->paginator($replies, new ReplyTransformer());
    }


}
