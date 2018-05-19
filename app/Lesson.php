<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = [];

    /**
     * @return string
     */
    public function path()
    {
        return "/lessons/{$this->channel->slug}/{$this->id}";
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }
}
