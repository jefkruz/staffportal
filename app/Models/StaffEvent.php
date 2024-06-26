<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffEvent extends Model
{
    use HasFactory;
    public function category()
    {
        return EventCategory::find($this->category_id);
    }
    public function comments()
    {
        return EventComment::where('event_id', $this->id)->latest()->get();
    }

    public function images()
    {
        return $this->hasMany(EventImage::class);
    }
}
