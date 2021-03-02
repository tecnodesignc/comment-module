<?php
namespace Modules\Comments\Events\Handlers;



use Modules\Comments\Events\CommentBroadcastEvent;
use Modules\Comments\Events\CommentWasCreated;

class CommentBroadcast
{

    public function handle(CommentWasCreated $event)
    {

      $availableEntities = config('encore.comments.config.availableEntities');


     /* if(in_array($event->type, $availableEntities)){
            event(new CommentBroadcastEvent( $event->type, $event->id,  $event->comment));
        }*/
    }

}
