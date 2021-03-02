<?php

namespace Modules\Comments\Presenters;
use Illuminate\Support\Facades\View;

class CommentPresenter extends AbstractCommentPresenter implements CommentPresenterInterface
{

    /**
     * renders comment.
     * @param object $commentable
     * pass Comment instance to render specific comment
     * pass string to automatically retrieve comment from repository
     * @param string $template blade template to render comment
     * @param array $options
     * @return string rendered comment HTML
     */
    public function render($commentable, $template = 'comments::front.comment.comments', $options=array()): string
    {
        $view = View::make($template)
            ->with([
                'comments' => $commentable->comments,
                'commentableType'=>get_class($commentable),
                'commentableId'=>$commentable->id,
                'options'=>$options
            ]);

        return $view->render();
    }
}
