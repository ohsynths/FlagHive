<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Writeup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function home()
    {
        $recent = Writeup::with(['category', 'user'])->latest()->take(5)->get();
        return view('pages.home', compact('recent'));
    }

    public function stats()
    {
        $totalWriteups = Writeup::count();
        $totalCategories = Category::count();
        $totalCtfs = Writeup::distinct('ctf')->count('ctf');
        $recent = Writeup::with(['user', 'category'])->latest()->take(10)->get();

        return view('pages.stats', compact('totalWriteups', 'totalCategories', 'totalCtfs', 'recent'));
    }

    public function publicProfile(User $user)
    {
        $writeups = $user->writeups()->with(['category'])->latest()->paginate(20);
        return view('pages.user-public', compact('user', 'writeups'));
    }

    public function profile()
    {
        $user = auth()->user();
        $writeups = $user->writeups()->with(['category'])->latest()->paginate(20);
        return view('pages.profile', compact('user', 'writeups'));
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:png,jpg,jpeg,gif', 'max:2048'],
        ]);

        $user = auth()->user();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar' => $path]);

        return back()->with('success', 'Avatar updated.');
    }
}
