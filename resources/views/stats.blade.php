<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FlagHive - stats</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background-color: #000;
            font-family: 'Courier New', Courier, monospace;
            -webkit-font-smoothing: antialiased;
        }

        .nav { border-bottom: 1px solid #333; }

        .nav-inner {
            max-width: 100%;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1rem;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: bold;
            letter-spacing: 0.05em;
            color: #fff;
        }

        .nav-left .dollar { color: #fff; }
        .nav-left .cmd { color: #fff; }
        .nav-left .path { color: #fff; }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            font-size: 0.875rem;
            color: #888;
        }

        .nav-right a {
            color: #888;
            text-decoration: none;
        }

        .nav-right a:hover { color: #fff; }

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

        .table-wrap {
            overflow-x: auto;
        }

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

        table tr:hover td {
            color: #fff;
        }

        .cursor-blink {
            display: inline-block;
            width: 7px;
            height: 1em;
            background-color: #fff;
            vertical-align: middle;
            margin-left: 2px;
            animation: blink 1s step-end infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        @media (min-width: 640px) {
            .nav-inner { padding: 1rem 1.5rem; }
            main { padding: 2rem 1.5rem; }
        }

        @media (min-width: 1024px) {
            .nav-inner { padding: 1rem 2rem; }
            main { padding: 2rem 2rem; }
        }
    </style>
</head>
<body>
    <nav class="nav">
        <div class="nav-inner">
            <a class="nav-left" href="/">
                <span class="dollar">$</span>
                <span class="cmd">cd</span>
                <span class="path">~/flaghive</span>
            </a>
            <div class="nav-right">
                <a href="/writeups">writeups/</a>
                <a href="/stats">stats/</a>
                <a href="{{ route('login') }}">[login]</a>
            </div>
        </div>
    </nav>

    <main>
        <div class="card">
            <p class="card-header"><span class="dollar">$</span> cat stats/overview</p>
            <h1 class="card-title">Statistics<span class="cursor-blink"></span></h1>
            <p class="card-sub">Overview of <span class="highlight">0</span> writeups across <span class="highlight">0</span> challenges</p>
        </div>

        <div class="stat-grid">
            <div class="stat-box">
                <div class="stat-label"><span class="dollar">$</span> total_writeups</div>
                <div class="stat-value">0</div>
                <div class="stat-detail">submissions</div>
            </div>
            <div class="stat-box">
                <div class="stat-label"><span class="dollar">$</span> challenges</div>
                <div class="stat-value">0</div>
                <div class="stat-detail">unique</div>
            </div>
            <div class="stat-box">
                <div class="stat-label"><span class="dollar">$</span> ctf_events</div>
                <div class="stat-value">0</div>
                <div class="stat-detail">participated</div>
            </div>
            <div class="stat-box">
                <div class="stat-label"><span class="dollar">$</span> solve_rate</div>
                <div class="stat-value">0%</div>
                <div class="stat-detail">of attempted</div>
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
                        <tr><td colspan="5" style="text-align:center;color:#555;padding:2rem">No writeups yet</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
