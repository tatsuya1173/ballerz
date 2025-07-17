<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'image_path',
        'caption',
        'order',
    ];

    public $timestamps = ['created_at'];
    public $updated_at = false;

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}

