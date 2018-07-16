<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'resident_id',
        'date',
        'reason',
        'debit',
        'credit',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }

    public static function parseCurrency($currencyString)
    {
        $currency = preg_replace('/\$/', '', $currencyString);
        $currency = ((float) $currency) * 100;

        return $currency;
    }
}
