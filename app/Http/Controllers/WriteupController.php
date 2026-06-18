<?php

namespace App\Http\Controllers;

use App\Models\Writeup;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WriteupController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        $query = Writeup::with(['user', 'category']);

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('ctf', 'like', "%{$search}%");
            });
        }

        if ($category = request('category')) {
            $query->where('category_id', $category);
        }

        if ($ctfSearch = request('ctf')) {
            $query->where('ctf', 'like', "%{$ctfSearch}%");
        }

        $sort = request('sort', 'newest');
        match ($sort) {
            'oldest' => $query->oldest(),
            'title' => $query->orderBy('title'),
            default => $query->latest(),
        };

        $writeups = $query->paginate(20);

        return view('pages.writeups', compact('writeups', 'categories'));
    }

    public function show(Writeup $writeup)
    {
        $writeup->load(['user', 'category']);
        $html = Str::markdown($writeup->content);

        return view('pages.writeup-show', compact('writeup', 'html'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('pages.writeup-create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'ctf' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
        ]);

        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']);

        $writeup = Writeup::create($data);

        return redirect()->route('writeups.show', $writeup);
    }
}
