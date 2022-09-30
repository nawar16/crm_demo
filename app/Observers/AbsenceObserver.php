<?php

namespace App\Observers;

class AbsenceObserver
{
    private $relations;

    public function __construct()
    {
        $this->relations = [
            'user'
        ];
    }
    /**
     * Handle the absence "created" event.
     *
     * @param  \App\Models\Absence  $absence
     * @return void
     */
    public function created(Absence $absence)
    {
        $absence->user->salary->increment('leave_days');
        dd($absence->user->salary);
    }

    /**
     * Handle the absence "updated" event.
     *
     * @param  \App\Models\Absence  $absence
     * @return void
     */
    public function updated(Absence $absence)
    {
        //
    }

    /**
     * Handle the absence "deleted" event.
     *
     * @param  \App\Models\Absence  $absence
     * @return void
     */
    public function deleted(Absence $absence)
    {
        // foreach ($this->relations as $relation) {
        //     $absence->$relation()->delete();
        // }
    }

    /**
     * Handle the absence "restored" event.
     *
     * @param  \App\Models\Absence  $absence
     * @return void
     */
    public function restored(Absence $absence)
    {
        // foreach ($this->relations as $relation) {
        //     $absence->$relation()->withTrashed()->restore();
        // }
    }

    /**
     * Handle the absence "force deleted" event.
     *
     * @param  \App\Models\Absence  $absence
     * @return void
     */
    public function forceDeleted(Absence $absence)
    {
        //
    }
}
