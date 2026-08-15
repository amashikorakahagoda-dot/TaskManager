<?php

namespace App\Helpers;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityHelper
{
    public static function log($subject, $action, $details = null)
    {
        if (Auth::check()) {
            Activity::create([
                'user_id' => Auth::id(),
                'subject_id' => $subject->id,
                'subject_type' => get_class($subject),
                'action' => $action,
                'details' => $details,
            ]);
        }
    }

    public static function getRecentActivities($limit = 10)
    {
        return Activity::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->limit($limit)
            ->get();
    }
}