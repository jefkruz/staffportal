<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    use HasFactory;
    protected $guarded;

    public function events()
    {
        return StaffEvent::where('category_id', $this->id)->get();
    }
}
