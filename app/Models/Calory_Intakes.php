<?php


namespace App\Models;
use App\Models\User;
use App\Models\Foods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calory_Intakes extends Model
{
    use HasFactory;
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'calory_intakes';

    protected $fillable = [
        'food_id',
        'user_id',
        'quantity',
        'meal',
        'breakfast_calorie_intake',
        'lunch_calorie_intake',
        'dinner_calorie_intake',
        'snack_calorie_intake',
        'total_calorie_intake'
    ];

    public function food()
    {
        return $this->belongsTo(Foods::class, 'food_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

