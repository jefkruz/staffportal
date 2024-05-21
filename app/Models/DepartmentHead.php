<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentHead extends Model
{
    use HasFactory;

    public function department()
    {
        return Department::find($this->department_id);
    }


    public function profile()
    {
        return User::find($this->user_id);
    }
}
