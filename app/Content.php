<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $primaryKey = 'content_id';

    protected $table = 'content';

    protected $fillable = [
        'title',
        'notice',
        'license',
        'authorities',
        'rightsholders',
        'location'
    ];
}
