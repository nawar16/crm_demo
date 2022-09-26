<?php

use App\Services\Activity\ActivityLogger;
use Carbon\Carbon;

if (! function_exists('activity')) {
    function activity(string $logName = null): ActivityLogger
    {
        $defaultLogName = "default";
        return app(ActivityLogger::class)
            ->withname($logName ?? $defaultLogName);
    }
}

if (! function_exists('frontendDate')) {
    function frontendDate(): String
    {
        return app(\App\Repositories\Format\GetDateFormat::class)->getFrontendDate();
    }
}
if (! function_exists('frontendTime')) {
    function frontendTime(): String
    {
        return app(\App\Repositories\Format\GetDateFormat::class)->getFrontendTime();
    }
}
if (! function_exists('carbonTime')) {
    function carbonTime(): String
    {
        return app(\App\Repositories\Format\GetDateFormat::class)->getCarbonTime();
    }
}

if (! function_exists('carbonFullDateWithText')) {
    function carbonFullDateWithText(): String
    {
        return app(\App\Repositories\Format\GetDateFormat::class)->getCarbonFullDateWithText();
    }
}

if (! function_exists('carbonDateWithText')) {
    function carbonDateWithText(): String
    {
        return app(\App\Repositories\Format\GetDateFormat::class)->getCarbonDateWithText();
    }
}

if (! function_exists('carbonDate')) {
    function carbonDate(): String
    {
        return app(\App\Repositories\Format\GetDateFormat::class)->getCarbonDate();
    }
}

if (! function_exists('isDemo')) {
    function isDemo(): String
    {
        return app()->environment() == "demo" ? 1 : 0;
    }
}

if (! function_exists('formatMoney')) {
    function formatMoney($amount, $useCode = false): String
    {
        return app(\App\Repositories\Money\MoneyConverter::class, ['money' => $amount])->format($useCode);
    }
}
if (! function_exists('defaultDateRange')) {
    function defaultDateRange()
    {
        return implode(' to ', [now()->subDays(30)->format('F d, Y'), now()->format('F d, Y')]);
    }
}


if (! function_exists('dateRangeTextToArray')) {
    function dateRangeTextToArray($range = false)
    {
        if (! $range) {
            $range = defaultDateRange();
        }

        [$from, $to] = explode(' to ', $range);
        $from = Carbon::parse(trim($from))->startOfDay();
        $to = Carbon::parse(trim($to))->endOfDay();

        return [$from, $to];
    }
}
