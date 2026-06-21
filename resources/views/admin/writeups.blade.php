@extends('layouts.app')

@section('title', 'FlagHive - admin writeups')

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
            <p class="card-header"><span class="dollar">$</span> ls -la writeups/ --all</p>
            <h1 class="card-title cursor-blink">All writeups</h1>
            <div class="admin-nav">
                <a href="{{ route('admin.dashboard') }}">[dashboard]</a>
                <a href="{{ route('admin.users') }}">[users]</a>
                <a class="active" href="{{ route('admin.writeups') }}">[writeups]</a>
                <a href="{{ route('admin.logs') }}">[logs]</a>
            </div>
        </div>

        <div style="overflow-x:auto">
            <table>
                <thead>
                    <tr>
                        <th>TITLE</th>
                        <th>AUTHOR</th>
                        <th>CATEGORY</th>
                        <th>CTF</th>
                        <th>DATE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($writeups as $w)
                        <tr>
                            <td><a href="{{ route('writeups.show', $w) }}" style="color:#fff;text-decoration:none">{{ $w->title }}</a></td>
                            <td>{{ $w->user->name }}</td>
                            <td>{{ $w->category->name }}</td>
                            <td>{{ $w->ctf }}</td>
                            <td>{{ $w->created_at->format('Y-m-d') }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.writeups.delete', $w) }}" style="display:inline" onsubmit="return confirm('Delete this writeup?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:none;border:1px solid #333;color:#888;padding:0.2rem 0.5rem;font-family:inherit;font-size:0.7rem;cursor:pointer">[delete]</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($writeups->hasPages())
            <div class="pagination">{{ $writeups->links() }}</div>
        @endif
    </main>
@endsection
