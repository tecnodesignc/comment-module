<?php

namespace Modules\Comments\Entities;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = 'comments__comments';
    protected $fillable = [
        'comment',
        'approved',
        'guest_name',
        'commentable_type',
        'commentable_id',
        'guest_email',
        'user_id',
        'options'
    ];
    protected $with = ['commentable'];
    protected $casts = [
        'approved' => 'boolean',
        'options' => 'array'
    ];
    protected $fakeColumns = ['options'];


    /**
     * The model that was commented upon.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Returns all comments that this comment is the parent of.
     */
    public function children()
    {
        return $this->hasMany(Comment::class, 'child_id');
    }

    /**
     * Returns the comment to which this comment belongs to.
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'child_id');
    }

    public function user()
    {
        $driver = config('encore.user.config.driver');

        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
    }
    public function getOptionsAttribute($value)
    {
        $options = json_decode($value);

        if (isset($options->mainImage))
            $options->mainImage = url($options->mainImage);
        if (isset($options->secondaryImage))
            $options->secondaryImage = url($options->secondaryImage);

        return $options;
    }

    public function setOptionsAttribute($value)
    {
        $this->attributes['options'] = json_encode($value);
    }


}
