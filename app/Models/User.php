<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded;
    protected $table ='tbl_users';
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isDirector()
    {
        return Director::where('user_id', $this->id)->exists();
    }

    public function isDepartmentHead()
    {
        return DepartmentHead::where('user_id', $this->id)->exists();
    }

    public function getInitials()
    {
        $firstName = strtoupper(substr($this->firstName, 0, 1));
        $lastName = strtoupper(substr($this->lastName, 0, 1));

        return $firstName . $lastName; // Concatenate the initials
    }

    public function fullname()
    {
        return$this->title. " ". $this->firstName. " ". $this->lastName;
    }



    public function department()
    {
        return $this->belongsTo(Department::class, 'deptID','deptID');
    }



    public function family()
    {
        return JobFamily::find($this->family_id);
    }

}
