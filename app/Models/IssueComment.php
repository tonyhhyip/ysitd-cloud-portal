<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueComment extends Model
{
    public $incrementing = false;

    public function comment()
    {
        return $this->belongsTo(Issue::class);
    }
}