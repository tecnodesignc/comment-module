<?php

namespace Modules\Comments\Presenters;

use Modules\Comments\Repositories\CommentRepository;

abstract class AbstractCommentPresenter implements CommentPresenterInterface
{

    /**
     * @var CommentRepository
     */
    protected $commentRepository;

    /**
     * CommentPresenter constructor.
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

}
