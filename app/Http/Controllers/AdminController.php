<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\User;
use App\Models\Writeup;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalWriteups = Writeup::count();
        $totalCategories = Category::count();
        $recentUsers = User::latest()->take(5)->get();
        $recentWriteups = Writeup::with(['user', 'category'])->latest()->take(5)->get();
        $recentLogs = ActivityLog::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalWriteups', 'totalCategories', 'recentUsers', 'recentWriteups', 'recentLogs'));
    }

    public function users()
    {
        $users = User::withCount('writeups')->latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function writeups()
    {
        $writeups = Writeup::with(['user', 'category'])->latest()->paginate(20);
        return view('admin.writeups', compact('writeups'));
    }

    public function logs()
    {
        $query = ActivityLog::with('user');

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('action', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($userId = request('user')) {
            $query->where('user_id', $userId);
        }

        if ($action = request('action')) {
            $query->where('action', $action);
        }

        $logs = $query->latest()->paginate(50);

        $users = User::orderBy('name')->get();
        $actions = ActivityLog::select('action')->distinct()->orderBy('action')->pluck('action');

        return view('admin.logs', compact('logs', 'users', 'actions'));
    }
}
