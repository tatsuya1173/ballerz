<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamSchedule extends Model
{
    protected $fillable = ['team_id', 'date', 'start_time', 'end_time', 'title', 'memo'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}


