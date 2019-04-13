<?php

namespace  App\Transformers;

use App\Models\Topic;
use League\Fractal\TransformerAbstract;

class TopicTransformer extends TransformerAbstract{

    public function transform(Topic $topic){
        return [
            'title' => $topic->title,
            'body' => $topic->body,

        ];
    }
}
