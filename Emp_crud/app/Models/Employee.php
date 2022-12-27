<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Model
{
   
    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;
    protected $table = "employees";
    protected $primaryKey = "emp_id";
    protected $fillable = [
        'user', 'firstname', 'middlename', 'lastname', 'dob', 'email', 'mobile', 'address', 'state','city', 'image', 'file'

    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user", "id");
    }

   
}
