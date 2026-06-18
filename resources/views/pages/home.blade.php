@extends('layouts.app')

@section('title', 'FlagHive')

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
                    <span class="dollar">$</span> ls -la writeups/ | tail -0
                </h2>
                <a class="view-all" href="{{ route('writeups') }}">[view all]</a>
            </div>
            <div class="empty-card">
                <p class="empty-text">No writeups yet</p>
            </div>
        </section>
    </main>
@endsection
