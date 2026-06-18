@extends('layouts.app')

@section('title', 'FlagHive - writeups')

@section('nav-right')
    <a href="{{ route('login') }}">[login]</a>
@endsection

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
            <p class="card-sub">Total: <span style="color:#fff">0</span> writeups</p>
        </div>

        <div class="filter-bar">
            <input type="text" class="search" placeholder="$ grep -i &quot;&quot;">
            <select class="sm">
                <option>[category]</option>
                <option>web</option>
                <option>pwn</option>
                <option>rev</option>
                <option>crypto</option>
                <option>forensics</option>
                <option>misc</option>
                <option>osint</option>
            </select>
            <select class="md">
                <option>[ctf]</option>
            </select>
            <select class="sm">
                <option>newest</option>
                <option>oldest</option>
            </select>
        </div>

        <div class="empty-card">
            <p>No writeups yet</p>
        </div>
    </main>
@endsection
