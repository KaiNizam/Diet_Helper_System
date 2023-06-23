<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informations extends Model
{
    use HasFactory;
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_id',
        'weight',
        'max_calories_intake',
        'remaining_calories_intake'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
