<?php

namespace Modules\Comments\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateCommentRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'commentable_type' => 'required|string',
            'commentable_id' => 'required|min:1',
            'comment' => 'required|string'

        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'commentable_type.required' => trans('comments::comments.messages.type require'),
            'commentable_type.string' => trans('comments::comments.messages.type is string'),
            'commentable_id.required' => trans('comments::comments.messages.id require'),
            'commentable_id.min'=>trans('comments::comments.messages.id min 1'),
            'comment.required' => trans('comments::comments.messages.message is require'),
            'comment.string' => trans('comments::comments.messages.type is string'),
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}
