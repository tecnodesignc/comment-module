<?php

namespace Modules\Comments\Repositories\Cache;

use Modules\Comments\Repositories\CommentRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCommentDecorator extends BaseCacheDecorator implements CommentRepository
{
    public function __construct(CommentRepository $comment)
    {
        parent::__construct();
        $this->entityName = 'comments.comments';
        $this->repository = $comment;
    }
}
