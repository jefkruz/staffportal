<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Event extends Model
{
    use HasFactory;
    protected $table ='tbl_meetings';

    public function accepted()
    {
        return EventAttendance::where('portalID', Session::get('user')->portalID)->where('meetingID', $this->meetingID)->exists();
    }
}
