<?php

namespace App\Http\Controllers;

use App\Models\Writeup;
use App\Models\Category;
use App\Models\Ctf;

class WriteupController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        $ctfs = Ctf::orderBy('name')->get();

        $query = Writeup::with(['user', 'category', 'ctf']);

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($category = request('category')) {
            $query->where('category_id', $category);
        }

        if ($ctf = request('ctf')) {
            $query->where('ctf_id', $ctf);
        }

        $sort = request('sort', 'newest');
        match ($sort) {
            'oldest' => $query->oldest(),
            'title' => $query->orderBy('title'),
            default => $query->latest(),
        };

        $writeups = $query->paginate(20);

        return view('pages.writeups', compact('writeups', 'categories', 'ctfs'));
    }
}
