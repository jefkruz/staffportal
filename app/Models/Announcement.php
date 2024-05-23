<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $table = 'tbl_notifications';

    public function comments()
    {
        return PostComment::where('post_id', $this->id)->latest()->get();
    }
}
