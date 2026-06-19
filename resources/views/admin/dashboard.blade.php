@extends('layouts.app')

@section('title', 'FlagHive - admin')

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

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-box {
        border: 1px solid #333;
        background-color: #0a0a0a;
        padding: 1.25rem;
    }

    .stat-box .stat-label {
        font-size: 0.75rem;
        color: #888;
        margin-bottom: 0.5rem;
    }

    .stat-box .stat-value {
        font-size: 2rem;
        color: #fff;
        letter-spacing: -0.025em;
    }

    .section-title {
        font-size: 1rem;
        font-weight: 400;
        color: #fff;
        margin-bottom: 1rem;
        border-bottom: 1px solid #333;
        padding-bottom: 0.5rem;
    }

    .row {
        border: 1px solid #333;
        border-bottom: none;
        padding: 0.75rem 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.875rem;
    }

    .row:last-child { border-bottom: 1px solid #333; }

    .row:hover { background-color: #0a0a0a; }

    .row a { color: #fff; text-decoration: none; }
    .row a:hover { text-decoration: underline; }

    .row .meta {
        font-size: 0.75rem;
        color: #555;
        display: flex;
        gap: 0.75rem;
    }

    .admin-nav {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
    }

    .admin-nav a {
        color: #888;
        text-decoration: none;
    }

    .admin-nav a:hover { color: #fff; }
    .admin-nav .active { color: #fff; }

    @media (min-width: 640px) { main { padding: 2rem 1.5rem; } }
    @media (min-width: 1024px) { main { padding: 2rem 2rem; } }
@endsection

@section('content')
    <main>
        <div class="card">
            <p class="card-header"><span class="dollar">$</span> sudo -i</p>
            <h1 class="card-title cursor-blink">Admin panel</h1>
            <div class="admin-nav">
                <a class="active" href="{{ route('admin.dashboard') }}">[dashboard]</a>
                <a href="{{ route('admin.users') }}">[users]</a>
                <a href="{{ route('admin.writeups') }}">[writeups]</a>
                <a href="{{ route('admin.logs') }}">[logs]</a>
            </div>
        </div>

        <div class="stat-grid">
            <div class="stat-box">
                <div class="stat-label"><span class="dollar">$</span> users</div>
                <div class="stat-value">{{ $totalUsers }}</div>
            </div>
            <div class="stat-box">
                <div class="stat-label"><span class="dollar">$</span> writeups</div>
                <div class="stat-value">{{ $totalWriteups }}</div>
            </div>
            <div class="stat-box">
                <div class="stat-label"><span class="dollar">$</span> categories</div>
                <div class="stat-value">{{ $totalCategories }}</div>
            </div>
        </div>

        <div class="card">
            <h2 class="section-title">Recent users</h2>
            @foreach ($recentUsers as $u)
                <div class="row">
                    <span>{{ $u->name }}</span>
                    <div class="meta">
                        <span>{{ $u->email }}</span>
                        <span>{{ $u->created_at->format('Y-m-d') }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card">
            <h2 class="section-title">Recent writeups</h2>
            @foreach ($recentWriteups as $w)
                <div class="row">
                    <a href="{{ route('writeups.show', $w) }}">{{ $w->title }}</a>
                    <div class="meta">
                        <span>{{ $w->user->name }}</span>
                        <span>{{ $w->category->name }}</span>
                        <span>{{ $w->created_at->format('Y-m-d') }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card">
            <h2 class="section-title">Recent activity</h2>
            @foreach ($recentLogs as $log)
                <div class="row">
                    <span>{{ $log->user?->name ?? '—' }} / {{ str_replace('.', ' » ', $log->action) }}</span>
                    <div class="meta">
                        <span>{{ $log->description }}</span>
                        <span>{{ $log->created_at->format('Y-m-d H:i') }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
