<?php

namespace App\Models;

use App\Models\User;
use App\Models\Exercises;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calory_Outtakes extends Model
{
    use HasFactory;
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'calory__outtakes';

    protected $fillable = [
        'exercise_id',
        'user_id',
        'quantity',
        'total_calorie_outtake'
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercises::class, 'exercise_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
