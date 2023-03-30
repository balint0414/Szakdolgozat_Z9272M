<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainer_id', 'student_id', 'location', 'start_time', 'end_time', 'status',
    ];

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
