<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FlagHive</title>
    <script>
        (function() {
            var t = localStorage.getItem('theme');
            if (t) {
                document.documentElement.className = t;
            } else {
                document.documentElement.className =
                    window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }
        })();
    </script>
    <style>
        :root {
            --bg: #f5f5f5;
            --card-bg: #fff;
            --border: #ddd;
            --text: #222;
            --muted: #999;
            --accent: #000;
        }

        .dark {
            --bg: #000;
            --card-bg: #0a0a0a;
            --border: #333;
            --text: #fff;
            --muted: #888;
            --accent: #fff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background-color: var(--bg);
            color: var(--muted);
            font-family: 'Courier New', Courier, monospace;
            -webkit-font-smoothing: antialiased;
        }

        .nav {
            border-bottom: 1px solid var(--border);
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
            color: var(--text);
        }

        .nav-left .dollar { color: var(--accent); }
        .nav-left .cmd { color: var(--accent); }
        .nav-left .path { color: var(--text); }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            font-size: 0.875rem;
            color: var(--muted);
        }

        .nav-right a, .nav-right button {
            color: var(--muted);
            text-decoration: none;
            background: none;
            border: none;
            font-family: inherit;
            font-size: inherit;
            cursor: pointer;
        }

        .nav-right a:hover, .nav-right button:hover {
            color: var(--accent);
        }

        .theme-toggle {
            background: none;
            border: 1px solid var(--border);
            font-family: inherit;
            font-size: 0.75rem;
            color: var(--muted);
            cursor: pointer;
            padding: 2px 6px;
        }

        .theme-toggle:hover {
            color: var(--accent);
            border-color: var(--accent);
        }

        .mobile-toggle {
            display: none;
            width: 1.75rem;
            height: 1.75rem;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            background: none;
            cursor: pointer;
            color: var(--muted);
            font-family: inherit;
        }

        main {
            max-width: 100%;
            margin: 0 auto;
            padding: 1.5rem 1rem;
        }

        .card {
            border: 1px solid var(--border);
            background-color: var(--card-bg);
            padding: 1.5rem;
            margin-bottom: 3rem;
        }

        .card-header {
            margin-bottom: 0.5rem;
            font-size: 0.75rem;
            color: var(--muted);
        }

        .card-header .dollar { color: var(--accent); }

        .card-title {
            font-size: 1.5rem;
            font-weight: 400;
            letter-spacing: -0.025em;
            margin-bottom: 0.75rem;
            color: var(--text);
        }

        .card-title .primary { color: var(--accent); }

        .card-sub {
            font-size: 0.875rem;
            color: var(--muted);
        }

        .card-sub .user { color: var(--text); }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 0.875rem;
            font-weight: 400;
            color: var(--muted);
        }

        .section-title .dollar { color: var(--accent); }
        .section-title .count { color: var(--muted); }

        .view-all {
            font-size: 0.75rem;
            color: var(--muted);
            text-decoration: none;
        }

        .view-all:hover { color: var(--accent); }

        .empty-card {
            border: 1px solid var(--border);
            background-color: var(--card-bg);
            padding: 2rem;
            text-align: center;
        }

        .empty-text {
            font-size: 0.875rem;
            color: var(--muted);
        }

        .cursor-blink {
            display: inline-block;
            width: 7px;
            height: 1em;
            background-color: var(--accent);
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
            .card { padding: 1.5rem; }
            main { padding: 2rem 1.5rem; }
        }

        @media (min-width: 1024px) {
            .nav-inner { padding: 1rem 2rem; }
            main { padding: 2rem 2rem; }
        }

        @media (max-width: 639px) {
            .nav-right { display: none; }
            .mobile-toggle { display: flex; }
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
                <button class="theme-toggle" onclick="toggleTheme()">[theme]</button>
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
                <a class="view-all" href="/writeups">[view all]</a>
            </div>
            <div class="empty-card">
                <p class="empty-text">No writeups yet</p>
            </div>
        </section>
    </main>

    <script>
        function toggleTheme() {
            var html = document.documentElement;
            html.className = html.className === 'dark' ? 'light' : 'dark';
            localStorage.setItem('theme', html.className);
        }
    </script>
</body>
</html>
