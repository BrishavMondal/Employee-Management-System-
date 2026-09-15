<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_name',
        'email',
        'phone',
        'position',
        'application_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'application_date' => 'date',
    ];
}