@extends('layouts.app')

@section('title', 'FlagHive - activity logs')

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

    .admin-nav {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
    }

    .admin-nav a { color: #888; text-decoration: none; }
    .admin-nav a:hover { color: #fff; }
    .admin-nav .active { color: #fff; }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    table th {
        text-align: left;
        color: #888;
        font-weight: normal;
        font-size: 0.75rem;
        padding: 0.5rem 0.75rem;
        border-bottom: 1px solid #333;
    }

    table td {
        padding: 0.5rem 0.75rem;
        border-bottom: 1px solid #222;
        color: #ccc;
    }

    .filters {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
        align-items: center;
        width: 100%;
    }

    .filters input[type="text"] {
        flex: 1 1 200px;
    }

    .filters select {
        flex: 0 1 auto;
    }

    .filters input,
    .filters select {
        background: #000;
        border: 1px solid #333;
        color: #ccc;
        font-family: inherit;
        font-size: 0.875rem;
        padding: 0.5rem 0.75rem;
        outline: none;
    }

    .filters input:focus,
    .filters select:focus {
        border-color: #666;
    }

    .filters button {
        background: none;
        border: 1px solid #333;
        color: #888;
        font-family: inherit;
        font-size: 0.875rem;
        padding: 0.5rem 0.75rem;
        cursor: pointer;
    }

    .filters button:hover {
        border-color: #fff;
        color: #fff;
    }

    table tr:hover td { color: #fff; }

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

    .pagination a:hover { color: #fff; border-color: #fff; }

    @media (min-width: 640px) { main { padding: 2rem 1.5rem; } }
    @media (min-width: 1024px) { main { padding: 2rem 2rem; } }
@endsection

@section('content')
    <main>
        <div class="card">
            <p class="card-header"><span class="dollar">$</span> tail -f /var/log/syslog</p>
            <h1 class="card-title cursor-blink">Activity logs</h1>
            <div class="admin-nav">
                <a href="{{ route('admin.dashboard') }}">[dashboard]</a>
                <a href="{{ route('admin.users') }}">[users]</a>
                <a href="{{ route('admin.writeups') }}">[writeups]</a>
                <a class="active" href="{{ route('admin.logs') }}">[logs]</a>
            </div>
        </div>

        <form class="filters" method="GET" action="{{ route('admin.logs') }}">
            <input type="text" name="search" placeholder="search..." value="{{ request('search') }}">
            <select name="user">
                <option value="">all users</option>
                @foreach ($users as $u)
                    <option value="{{ $u->id }}" {{ request('user') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                @endforeach
            </select>
            <select name="action">
                <option value="">all actions</option>
                @foreach ($actions as $a)
                    <option value="{{ $a }}" {{ request('action') == $a ? 'selected' : '' }}>{{ $a }}</option>
                @endforeach
            </select>
            <button type="submit">[filter]</button>
            @if (request()->anyFilled(['search', 'user', 'action']))
                <a href="{{ route('admin.logs') }}" style="color:#888;font-size:0.75rem">[clear]</a>
            @endif
        </form>

        <div style="overflow-x:auto">
            <table>
                <thead>
                    <tr>
                        <th>USER</th>
                        <th>ACTION</th>
                        <th>DESCRIPTION</th>
                        <th>WHEN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr>
                            <td>{{ $log->user?->name ?? '—' }}</td>
                            <td>{{ $log->action }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($logs->hasPages())
            <div class="pagination">{{ $logs->links() }}</div>
        @endif
    </main>
@endsection
