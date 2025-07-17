<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'team_id',
        'name',
        'email',
        'message',
        'status',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
