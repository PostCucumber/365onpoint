<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = [];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
