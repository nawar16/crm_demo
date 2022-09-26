<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Salary extends Model
{
    use HasFactory;

    protected $table = 'salaries';

    protected $fillable = [
        'user_id',
        'month',
        'leave_days',
        'unjustfied_days',
        'deduction_days',
        'unjustified_hour',
        'deduction_hour',
        'sick_days',
        'annual_days',
        'leave_hour',
        'late_hour',
        'total_hour',
        'basic_salary',
        'accomdation',
        'transport',
        'tele_communication',
        'total_salary',
        'absence_deduction_day',
        'total_leaves',
        'over_time_count',
        'over_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getSummeryReport($from = false, $to = false)
    {
        return self::getRange($from, $to)
            ->with('user')
//            ->select('*', \DB::raw('SUM(worked) AS total_worked'))
            ->groupBy('user_id');
    }

    public static function getRange($from = false, $to = false)
    {
        if (! $from && ! $to) {
            [$from, $to] = Helper::dateRangeTextToArray();
        }
        return self::latest('in_time')->whereBetween('in_time', [$from, $to]);
    }

}
