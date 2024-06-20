<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

     // Jika menggunakan timestamps
     public $timestamps = true;
     
    protected $fillable = [
        'fname', 'lname', 'phone_number', 'age', 'gender', 'medical_history', 'email', 'address','disease_history'
    ];
}
