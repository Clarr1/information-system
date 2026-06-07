<?php

namespace App\Http\Controllers;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    //
        public function index()
    {
        $logs = ActivityLog::with('user')
            ->latest()
            ->paginate(10);

        return view('product.activity_logs', compact('logs'));
    }
}
