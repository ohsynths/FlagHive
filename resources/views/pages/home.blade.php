<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FlagHive</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background-color: #000;
            font-family: 'Courier New', Courier, monospace;
            -webkit-font-smoothing: antialiased;
        }

        .nav {
            border-bottom: 1px solid #333;
        }

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

        .nav-left .dollar {
            color: #fff;
        }

        .nav-left .cmd {
            color: #fff;
        }

        .nav-left .path {
            color: #fff;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            font-size: 0.875rem;
            color: #888;
        }

        .nav-right a, .nav-right button {
            color: #888;
            text-decoration: none;
            background: none;
            border: none;
            font-family: inherit;
            font-size: inherit;
            cursor: pointer;
        }

        .nav-right a:hover, .nav-right button:hover {
            color: #fff;
        }

        .mobile-toggle {
            display: none;
            width: 1.75rem;
            height: 1.75rem;
            align-items: center;
            justify-content: center;
            border: 1px solid #333;
            background: none;
            cursor: pointer;
            color: #888;
            font-family: inherit;
        }

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

        .card-header .dollar {
            color: #fff;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 400;
            letter-spacing: -0.025em;
            margin-bottom: 0.75rem;
            color: #fff;
        }

        .card-title .primary {
            color: #fff;
        }

        .card-sub {
            font-size: 0.875rem;
            color: #888;
        }

        .card-sub .user {
            color: #fff;
        }

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

        .section-title .dollar {
            color: #fff;
        }

        .section-title .count {
            color: #888;
        }

        .view-all {
            font-size: 0.75rem;
            color: #888;
            text-decoration: none;
        }

        .view-all:hover {
            color: #fff;
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
            .nav-inner {
                padding: 1rem 1.5rem;
            }
            .card {
                padding: 1.5rem;
            }
            main {
                padding: 2rem 1.5rem;
            }
        }

        @media (min-width: 1024px) {
            .nav-inner {
                padding: 1rem 2rem;
            }
            main {
                padding: 2rem 2rem;
            }
        }

        @media (max-width: 639px) {
            .nav-right {
                display: none;
            }
            .mobile-toggle {
                display: flex;
            }
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
                <span class="cursor-blink"></span>
            </a>
            <button class="mobile-toggle" aria-label="Toggle menu">=</button>
            <div class="nav-right">
                <a href="{{ route('writeups') }}">writeups/</a>
                <a href="{{ route('stats') }}">stats/</a>
                <a href="{{ route('login') }}">[login]</a>
            </div>
        </div>
    </nav>

    <main>
        <div class="card">
            <p class="card-header"><span class="dollar">$</span> cat writeups/README</p>
            <h1 class="card-title">
                <span class="primary">~/flaghive</span>
                <span class="cursor-blink"></span>
            </h1>
            <p class="card-sub">
                <span class="user">ohsynthz</span>@root:~/flaghive
            </p>
        </div>

        <section>
            <div class="section-header">
                <h2 class="section-title">
                    <span class="dollar">$</span> ls -la writeups/ | tail -<span class="count">0</span>
                </h2>
                <a class="view-all" href="{{ route('writeups') }}">[view all]</a>
            </div>
            <div class="empty-card">
                <p class="empty-text">No writeups yet</p>
            </div>
        </section>
    </main>
</body>
</html>
