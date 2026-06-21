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

    public function banUser(User $user)
    {
        if ($user->is_admin && $user->id !== auth()->id()) {
            return back()->withErrors(['Cannot ban another admin.']);
        }

        $user->update(['banned_at' => now()]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'user.banned',
            'description' => "Banned user \"{$user->name}\"",
            'subject_id' => $user->id,
            'subject_type' => User::class,
        ]);

        return back()->with('success', "User \"{$user->name}\" banned.");
    }

    public function unbanUser(User $user)
    {
        $user->update(['banned_at' => null]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'user.unbanned',
            'description' => "Unbanned user \"{$user->name}\"",
            'subject_id' => $user->id,
            'subject_type' => User::class,
        ]);

        return back()->with('success', "User \"{$user->name}\" unbanned.");
    }

    public function deleteWriteup(Writeup $writeup)
    {
        $title = $writeup->title;
        $author = $writeup->user->name;

        $writeup->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'writeup.force-deleted',
            'description' => "Admin deleted writeup \"{$title}\" by {$author}",
        ]);

        return back()->with('success', 'Writeup deleted.');
    }
}
