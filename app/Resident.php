<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Resident extends Model
{
    use Notifiable;
    protected $guarded = [];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public static function calculateManDays($resident)
    {
        $admitDate   = Carbon::parse($resident->date_of_admission);
        $releaseDate = $resident->actual_date_of_discharge == null ? Carbon::now() :
            Carbon::parse($resident->actual_date_of_discharge);

        $manDays = $admitDate->diffInDays($releaseDate);

        if ($manDays == 0) {
            $manDays += 1;
        }

        return $manDays;
    }

    public static function calculateManDaysForMonth($year, $month, $resident = null)
    {
        $residents = DB::table('residents')
            ->where('facility', \Auth::user()->facility)
            ->when($resident, function ($query) use ($resident) {
                return $query->where('id', $resident);
            })
            ->whereYear('date_of_admission', '<=', $year)
            ->get();

        $sum = 0;
        foreach ($residents as $resident) {
            $firstDayOfMonth = Carbon::now()->year($year)->month($month)->firstOfMonth();
            $lastDayOfMonth  = Carbon::now()->year($year)->month($month)->lastOfMonth();
            $softDeletedAt   = carbon::parse($resident->soft_deleted_at);
            $restoredAt      = carbon::parse($resident->restored_at);
            $admitDateTmp    = Carbon::parse($resident->date_of_admission);
            $admitDate       = $admitDateTmp->lessThanOrEqualTo($firstDayOfMonth) ? $firstDayOfMonth : $admitDateTmp;
            $releaseDate     = $resident->actual_date_of_discharge == null || Carbon::parse($resident->actual_date_of_discharge)->greaterThan($lastDayOfMonth) ? $lastDayOfMonth->addDay() :
                Carbon::parse($resident->actual_date_of_discharge);

            if ($admitDate->lessThanOrEqualTo($lastDayOfMonth) && $releaseDate->greaterThanOrEqualTo($firstDayOfMonth)) {
                $sum += $admitDate->diffInDays($releaseDate);
                if ($softDeletedAt !== null || $restoredAt !== null) {
                    $sum -= $restoredAt->diffInDays($softDeletedAt);
                }
            }
        }

        return $sum;
    }

    public static function calculateManDaysForCurrentMonth($resident = null)
    {
        $date            = Carbon::now();
        $tomorrow        = Carbon::tomorrow();
        $month           = $date->month;
        $year            = $date->year;
        $firstDayOfMonth = Carbon::now()->firstOfMonth();

        $residents = DB::table('residents')
            ->where('facility', \Auth::user()->facility)
            ->when($resident, function ($query) use ($resident) {
                return $query->where('id', $resident->id);
            })
            ->whereMonth('date_of_admission', '<=', $month)
            ->whereYear('date_of_admission', '<=', $year)
            ->get();


        $sum = 0;
        foreach ($residents as $resident) {
            $softDeletedAt   = carbon::parse($resident->soft_deleted_at);
            $restoredAt      = carbon::parse($resident->restored_at);
            $admitDateTmp = Carbon::parse($resident->date_of_admission);
            $admitDate    = $admitDateTmp->lt($firstDayOfMonth) ? $firstDayOfMonth : $admitDateTmp;
            $releaseDate  = $resident->actual_date_of_discharge == null ? $tomorrow :
                Carbon::parse($resident->actual_date_of_discharge);

            if ($releaseDate->greaterThanOrEqualTo($firstDayOfMonth)) {
                $sum += $admitDate->diffInDays($releaseDate);
                if ($softDeletedAt !== null || $restoredAt !== null) {
                    $sum -= $restoredAt->diffInDays($softDeletedAt);
                }
            }
        }

        return $sum;
    }

    public static function stayedHereDuring($year, $month, $resident)
    {
        $checkedDateEnd = Carbon::create($year, $month)->endOfMonth();
        $checkedDateBeginning = Carbon::create($year, $month)->firstOfMonth();

        return ((Carbon::parse($resident->date_of_admission)->lessThanOrEqualTo($checkedDateEnd) &&
            Carbon::parse($resident->actual_date_of_discharge)->greaterThanOrEqualTo($checkedDateBeginning)));
    }

    public static function calculateManDaysForFiscalYear($year, $month)
    {
        $today = Carbon::create($year, $month)->endOfMonth();

        $fyStart = $today->month >= 7 ? $today->copy()->month(7)->firstOfMonth() : $today->copy()->subYear(1)->month(7)->firstOfMonth();


        $diff = $fyStart->diffInMonths($today) != 0 ? $fyStart->diffInMonths($today) : 12;
        $sum  = 0;

        for ($i = 0; $i <= $diff; $i++) {
            $year  = $today->copy()->subMonthsNoOverflow($i)->year;
            $month = $today->copy()->subMonthsNoOverflow($i)->month;
            $sum += Resident::calculateManDaysForMonth($year, $month);
        }

        return $sum;
    }

    public static function totalBalance($id)
    {
        $credit = Transaction::where('resident_id', $id)->pluck('credit')->sum();
        $debit = Transaction::where('resident_id', $id)->pluck('debit')->sum();
        $total = $credit - $debit;

        return ($total);
    }
}
