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
            background-color: #0d0d0d;
            font-family: 'Courier New', Courier, monospace;
            -webkit-font-smoothing: antialiased;
        }

        .border-b {
            border-bottom: 1px solid #1e1e1e;
        }

        .border-border {
            border-color: #1e1e1e;
        }

        .nav {
            border-bottom: 1px solid #1e1e1e;
        }

        .nav-inner {
            max-width: 1152px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1rem;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: bold;
            letter-spacing: 0.05em;
            color: #e0e0e0;
        }

        .nav-left .dollar {
            color: #27c93f;
        }

        .nav-left .cmd {
            color: #27c93f;
        }

        .nav-left .path {
            color: #e0e0e0;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            font-size: 0.875rem;
            color: #666;
        }

        .nav-right a, .nav-right button {
            color: #666;
            text-decoration: none;
            background: none;
            border: none;
            font-family: inherit;
            font-size: inherit;
            cursor: pointer;
        }

        .nav-right a:hover, .nav-right button:hover {
            color: #27c93f;
        }

        .mobile-toggle {
            display: none;
            width: 1.75rem;
            height: 1.75rem;
            align-items: center;
            justify-content: center;
            border: 1px solid #1e1e1e;
            background: none;
            cursor: pointer;
            color: #666;
            font-family: inherit;
        }

        main {
            max-width: 1152px;
            margin: 0 auto;
            padding: 1.5rem 1rem;
        }

        .card {
            border: 1px solid #1e1e1e;
            background-color: #111;
            padding: 1.5rem;
            margin-bottom: 3rem;
        }

        .card-header {
            margin-bottom: 0.5rem;
            font-size: 0.75rem;
            color: #666;
        }

        .card-header .dollar {
            color: #27c93f;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 400;
            letter-spacing: -0.025em;
            margin-bottom: 0.75rem;
        }

        .card-title .primary {
            color: #27c93f;
        }

        .card-sub {
            font-size: 0.875rem;
            color: #666;
        }

        .card-sub .user {
            color: #e0e0e0;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #1e1e1e;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 0.875rem;
            font-weight: 400;
            color: #666;
        }

        .section-title .dollar {
            color: #27c93f;
        }

        .section-title .count {
            color: #666;
        }

        .view-all {
            font-size: 0.75rem;
            color: #666;
            text-decoration: none;
        }

        .view-all:hover {
            color: #27c93f;
        }

        .empty-card {
            border: 1px solid #1e1e1e;
            background-color: #111;
            padding: 2rem;
            text-align: center;
        }

        .empty-text {
            font-size: 0.875rem;
            color: #666;
        }

        .cursor-blink {
            display: inline-block;
            width: 7px;
            height: 1em;
            background-color: #27c93f;
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
                padding: 0.75rem 1.5rem;
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
                padding: 0.75rem 2rem;
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
                <a href="/writeups">writeups/</a>
                <a href="/stats">stats/</a>
                <button>[login]</button>
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
                <a class="view-all" href="/writeups">[view all]</a>
            </div>
            <div class="empty-card">
                <p class="empty-text">No writeups yet</p>
            </div>
        </section>
    </main>
</body>
</html>
