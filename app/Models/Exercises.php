<?php

namespace App\Models;

use App\Models\Calory_Outtakes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercises extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id',
        'exercise_name',
        'calory_burn',
    ];

    public function caloryOuttakes()
    {
        return $this->hasMany(Calory_Outtakes::class);
    }
}
