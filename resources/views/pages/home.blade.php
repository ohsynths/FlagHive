@extends('layouts.app')

@section('title', 'FlagHive')

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
        margin-bottom: 3rem;
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

    .card-sub .user { color: #fff; }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #333;
        padding-bottom: 0.5rem;
        margin-bottom: 1rem;
    }

    .section-title {
        font-size: 0.875rem;
        font-weight: 400;
        color: #888;
    }

    .section-title .dollar { color: #fff; }

    .view-all {
        font-size: 0.75rem;
        color: #888;
        text-decoration: none;
    }

    .view-all:hover { color: #fff; }

    .writeup-row {
        border: 1px solid #333;
        border-bottom: none;
        padding: 0.75rem 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        font-size: 0.875rem;
    }

    .writeup-row:last-child {
        border-bottom: 1px solid #333;
    }

    .writeup-row:hover {
        background-color: #0a0a0a;
    }

    .writeup-row a {
        color: #fff;
        text-decoration: none;
    }

    .writeup-row a:hover {
        text-decoration: underline;
    }

    .writeup-row .meta {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.75rem;
        color: #555;
    }

    .writeup-row .meta .badge {
        color: #888;
    }

    .empty-card {
        border: 1px solid #333;
        background-color: #0a0a0a;
        padding: 2rem;
        text-align: center;
    }

    .empty-text {
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
            <p class="card-header"><span class="dollar">$</span> cat writeups/README</p>
            <h1 class="card-title">
                <span class="primary cursor-blink">~/flaghive</span>
            </h1>
            <p class="card-sub">
                <span class="user">ohsynthz</span>@root:~/flaghive
            </p>
        </div>

        <section>
            <div class="section-header">
                <h2 class="section-title">
                    <span class="dollar">$</span> ls -la writeups/ | tail -{{ $recent->count() }}
                </h2>
                <a class="view-all" href="{{ route('writeups') }}">[view all]</a>
            </div>
            @forelse ($recent as $w)
                <div class="writeup-row">
                    <a href="#">{{ $w->title }}</a>
                    <div class="meta">
                        <span class="badge">{{ $w->category->name }}</span>
                        <span class="badge">{{ $w->ctf->name }}</span>
                        <span style="color:#fff">{{ $w->user->name }}</span>
                        <span>{{ $w->created_at->format('Y-m-d') }}</span>
                    </div>
                </div>
            @empty
                <div class="empty-card">
                    <p class="empty-text">No writeups yet</p>
                </div>
            @endforelse
        </section>
    </main>
@endsection
