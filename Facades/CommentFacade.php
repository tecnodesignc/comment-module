<?php

namespace Modules\Comments\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Comments\Presenters\CommentPresenter;


class CommentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CommentPresenter::class;
    }

}
