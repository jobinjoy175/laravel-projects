<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'email'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
