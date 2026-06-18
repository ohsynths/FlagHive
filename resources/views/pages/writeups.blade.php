@extends('layouts.app')

@section('title', 'FlagHive - writeups')

@section('styles')
    main {
        max-width: 100%;
        margin: 0 auto;
        padding: 1.5rem 1rem;
    }

    .card {
        border: 1px solid #333;
        background-color: #0a0a0a;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .card-header {
        margin-bottom: 0.5rem;
        font-size: 0.75rem;
        color: #888;
    }

    .card-header .dollar { color: #fff; }

    .card-title {
        font-size: 1.5rem;
        font-weight: 400;
        letter-spacing: -0.025em;
        margin-bottom: 0.75rem;
        color: #fff;
    }

    .card-sub {
        font-size: 0.875rem;
        color: #888;
    }

    .filter-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .filter-bar select, .filter-bar input {
        background: #0a0a0a;
        border: 1px solid #333;
        color: #888;
        padding: 0.5rem 0.75rem;
        font-family: inherit;
        font-size: 0.75rem;
        outline: none;
        appearance: none;
        -webkit-appearance: none;
        cursor: pointer;
    }

    .filter-bar select:focus, .filter-bar input:focus {
        border-color: #fff;
        color: #fff;
    }

    .filter-bar input.search {
        flex: 1;
        min-width: 200px;
    }

    .filter-bar select.sm { width: 140px; }
    .filter-bar select.md { width: 160px; }

    .writeup-row {
        border: 1px solid #333;
        border-bottom: none;
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
    }

    .writeup-row:last-child {
        border-bottom: 1px solid #333;
    }

    .writeup-row:hover {
        background-color: #0a0a0a;
    }

    .writeup-title {
        font-size: 0.875rem;
        color: #fff;
        text-decoration: none;
    }

    .writeup-title:hover {
        text-decoration: underline;
    }

    .writeup-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 0.75rem;
        color: #555;
    }

    .writeup-meta span { white-space: nowrap; }

    .writeup-meta .badge {
        color: #aaa;
    }

    .empty-card {
        border: 1px solid #333;
        background-color: #0a0a0a;
        padding: 2rem;
        text-align: center;
    }

    .empty-card p {
        font-size: 0.875rem;
        color: #888;
    }

    .pagination {
        margin-top: 1.5rem;
        display: flex;
        gap: 0.5rem;
        font-size: 0.75rem;
        color: #888;
    }

    .pagination a, .pagination span {
        color: #888;
        text-decoration: none;
        padding: 0.25rem 0.5rem;
        border: 1px solid #333;
    }

    .pagination a:hover {
        color: #fff;
        border-color: #fff;
    }

    .filter-form {
        display: contents;
    }

    @media (min-width: 640px) {
        main { padding: 2rem 1.5rem; }
    }

    @media (min-width: 1024px) {
        main { padding: 2rem 2rem; }
    }
@endsection

@section('content')
    <main>
        <div class="card">
            <p class="card-header"><span class="dollar">$</span> ls -la writeups/</p>
            <h1 class="card-title cursor-blink">Writeups</h1>
            <p class="card-sub">Total: <span style="color:#fff">{{ $writeups->total() }}</span> writeups</p>
        </div>

        <form class="filter-bar" method="GET" action="{{ route('writeups') }}">
            <input type="text" name="search" class="search" placeholder="$ grep -i &quot;&quot;" value="{{ request('search') }}" onchange="this.form.submit()" onkeydown="if(event.key==='Enter')this.form.submit()">
            <select name="category" class="sm" onchange="this.form.submit()">
                <option value="">[category]</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <input type="text" name="ctf" class="search" style="min-width:180px;flex:0" placeholder="$ where ctf like" value="{{ request('ctf') }}" onchange="this.form.submit()" onkeydown="if(event.key==='Enter')this.form.submit()">
            <select name="sort" class="sm" onchange="this.form.submit()">
                <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>newest</option>
                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>oldest</option>
                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>title</option>
            </select>
        </form>

        @forelse ($writeups as $writeup)
            <div class="writeup-row">
                <a href="{{ route('writeups.show', $writeup) }}" class="writeup-title">{{ $writeup->title }}</a>
                <div class="writeup-meta">
                    <span class="badge">{{ $writeup->category->name }}</span>
                    <span class="badge">{{ $writeup->ctf }}</span>
                    <span style="color:#fff">{{ $writeup->user->name }}</span>
                    <span>{{ $writeup->created_at->format('Y-m-d') }}</span>
                </div>
            </div>
        @empty
            <div class="empty-card">
                <p>No writeups yet</p>
            </div>
        @endforelse

        @if ($writeups->hasPages())
            <div class="pagination">
                {{ $writeups->links() }}
            </div>
        @endif
    </main>
@endsection
