<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    public function attendances()
    {
        return $this->hasMany(MeetingAttendance::class, 'meeting_id');
    }

    public function getAttendanceCount()
    {
        return $this->attendances()->count() + 50;
    }

    public function attending()
    {
        return MeetingAttendance::where('portal_id', session('user')->portal_id)->where('meeting_id', $this->id)->exists();
    }

    public function isAvailable()
    {
        return $this->end_date >= date('Y-m-d H:i:s');
    }

    public function isLive()
    {
        return $this->end_date >= date('Y-m-d H:i:s') && $this->start_date <= date('Y-m-d H:i:s');
    }

    public function scopeOfType($query, $isAdmin)
    {
        return ($isAdmin) ? $query : $query->where('accessibility', 'all');
    }
}
