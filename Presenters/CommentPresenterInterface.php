<?php

namespace Modules\Comments\Presenters;

interface CommentPresenterInterface
{
    /**
     * @param object $commentName
     * @return string rendered comment
     */
    public function render($commentName);
}
