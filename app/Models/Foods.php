<?php

namespace App\Models;

use App\Models\Calory_Intakes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foods extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id',
        'food_name',
        'food_calory',
        'food_description'
    ];

    public function caloryIntakes()
    {
        return $this->hasMany(Calory_Intakes::class);
    }
}
