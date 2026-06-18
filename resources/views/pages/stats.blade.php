@extends('layouts.app')

@section('title', 'FlagHive - stats')

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

    .card-sub .highlight { color: #fff; }

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

    .stat-box .stat-label .dollar { color: #fff; }

    .stat-box .stat-value {
        font-size: 2rem;
        color: #fff;
        letter-spacing: -0.025em;
    }

    .stat-box .stat-detail {
        font-size: 0.8rem;
        color: #888;
        margin-top: 0.25rem;
    }

    .table-wrap { overflow-x: auto; }

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
            <p class="card-header"><span class="dollar">$</span> cat stats/overview</p>
            <h1 class="card-title cursor-blink">Statistics</h1>
            <p class="card-sub">Overview of <span class="highlight">{{ $totalWriteups }}</span> writeups across <span class="highlight">{{ $totalCtfs }}</span> CTF events</p>
        </div>

        <div class="stat-grid">
            <div class="stat-box">
                <div class="stat-label"><span class="dollar">$</span> total_writeups</div>
                <div class="stat-value">{{ $totalWriteups }}</div>
                <div class="stat-detail">submissions</div>
            </div>
            <div class="stat-box">
                <div class="stat-label"><span class="dollar">$</span> categories</div>
                <div class="stat-value">{{ $totalCategories }}</div>
                <div class="stat-detail">covered</div>
            </div>
            <div class="stat-box">
                <div class="stat-label"><span class="dollar">$</span> ctf_events</div>
                <div class="stat-value">{{ $totalCtfs }}</div>
                <div class="stat-detail">participated</div>
            </div>
        </div>

        <div class="card">
            <p class="card-header"><span class="dollar">$</span> cat stats/latest</p>
            <h1 class="card-title" style="font-size:1rem">Recent activity</h1>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>DATE</th>
                            <th>CHALLENGE</th>
                            <th>CTF</th>
                            <th>CATEGORY</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recent as $w)
                            <tr>
                                <td>{{ $w->created_at->format('Y-m-d') }}</td>
                                <td>{{ $w->title }}</td>
                                <td>{{ $w->ctf->name }}</td>
                                <td>{{ $w->category->name }}</td>
                                <td style="color:#fff">published</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" style="text-align:center;color:#555;padding:2rem">No writeups yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
