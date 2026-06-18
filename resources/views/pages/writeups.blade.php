<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FlagHive - writeups</title>
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

        .filter-bar select.sm {
            width: 140px;
        }

        .filter-bar select.md {
            width: 160px;
        }

        .writeup-item {
            border-bottom: 1px solid #222;
            padding: 1rem 0;
        }

        .writeup-item:last-child {
            border-bottom: none;
        }

        .writeup-item .wu-title {
            color: #fff;
            font-size: 1rem;
            text-decoration: none;
            display: block;
            margin-bottom: 0.25rem;
        }

        .writeup-item .wu-title:hover {
            text-decoration: underline;
        }

        .writeup-item .wu-meta {
            font-size: 0.8rem;
            color: #888;
        }

        .writeup-item .wu-meta span {
            margin-right: 1rem;
        }

        .writeup-item .wu-meta .tag {
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
                <a href="{{ route('writeups') }}">writeups/</a>
                <a href="{{ route('stats') }}">stats/</a>
                <a href="{{ route('login') }}">[login]</a>
            </div>
        </div>
    </nav>

    <main>
        <div class="card">
            <p class="card-header"><span class="dollar">$</span> ls -la writeups/</p>
            <h1 class="card-title">Writeups<span class="cursor-blink"></span></h1>
            <p class="card-sub">Total: <span class="highlight" style="color:#fff">0</span> writeups</p>
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

        <div class="card" style="text-align:center;padding:3rem;color:#555">
            No writeups yet
        </div>
    </main>
</body>
</html>
