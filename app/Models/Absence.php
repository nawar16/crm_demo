<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use App\Observers\AbsenceObserver;

class Absence extends Model
{
    protected $fillable = [
        'external_id',
        'reason',
        'start_at',
        'end_at',
        'user_id',
        'comment',

    ];

    protected $dates = ['start_at', 'end_at'];

    protected $hidden = ['id', 'user_id'];

    public static function boot()
    {
        parent::boot();

        static::observe(AbsenceObserver::class);
        
    }
    public function getRouteKeyName()
    {
        return 'external_id';
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
