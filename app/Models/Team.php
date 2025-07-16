<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prefecture;

class Team extends Model
{
    use HasFactory;

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    protected $fillable = [
        'user_id',
        'prefecture_id',
        'city',
        'name',
        'grade_range',
        'practice_days',
        'introduction',
    ];
    
    protected $casts = [
        'practice_days' => 'array',
    ];
    
}
