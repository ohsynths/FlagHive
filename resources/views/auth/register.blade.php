<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FlagHive - register</title>
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

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background-color: var(--bg);
            font-family: 'Courier New', Courier, monospace;
            -webkit-font-smoothing: antialiased;
            display: flex;
            flex-direction: column;
        }

        .nav { border-bottom: 1px solid var(--border); }

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

        .nav-right a {
            color: var(--muted);
            text-decoration: none;
        }

        .nav-right a:hover { color: var(--accent); }

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

        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .auth-card {
            border: 1px solid var(--border);
            background-color: var(--card-bg);
            width: 100%;
            max-width: 400px;
            padding: 2rem;
        }

        .auth-title {
            color: var(--text);
            font-size: 1.2rem;
            font-weight: 400;
            margin-bottom: 0.5rem;
        }

        .auth-header {
            color: var(--muted);
            font-size: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .auth-header .dollar { color: var(--accent); }

        .form-group { margin-bottom: 1rem; }

        .form-group label {
            display: block;
            color: var(--muted);
            font-size: 0.8rem;
            margin-bottom: 0.4rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.6rem 0.75rem;
            background: var(--bg);
            border: 1px solid var(--border);
            color: var(--text);
            font-family: inherit;
            font-size: 0.875rem;
            outline: none;
        }

        .form-group input:focus { border-color: var(--accent); }

        .error-box {
            border: 1px solid var(--border);
            background-color: var(--card-bg);
            padding: 0.75rem;
            margin-bottom: 1rem;
            color: var(--muted);
            font-size: 0.8rem;
        }

        .error-box .error-title { color: var(--text); margin-bottom: 0.25rem; }

        .btn {
            width: 100%;
            padding: 0.6rem;
            background: none;
            border: 1px solid var(--accent);
            color: var(--accent);
            font-family: inherit;
            font-size: 0.875rem;
            cursor: pointer;
            margin-top: 0.5rem;
        }

        .btn:hover {
            background: var(--accent);
            color: var(--bg);
        }

        .auth-footer {
            color: var(--muted);
            font-size: 0.8rem;
            margin-top: 1rem;
            text-align: center;
        }

        .auth-footer a {
            color: var(--text);
            text-decoration: none;
        }

        .auth-footer a:hover { text-decoration: underline; }

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

        @media (min-width: 640px) { .nav-inner { padding: 1rem 1.5rem; } }
        @media (min-width: 1024px) { .nav-inner { padding: 1rem 2rem; } }
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
                <button class="theme-toggle" onclick="toggleTheme()">[theme]</button>
                <a href="{{ route('login') }}">[login]</a>
            </div>
        </div>
    </nav>

    <main>
        <div class="auth-card">
            <p class="auth-header"><span class="dollar">$</span> register</p>
            <h1 class="auth-title">Create account<span class="cursor-blink"></span></h1>

            @if ($errors->any())
            <div class="error-box">
                <div class="error-title">Errors:</div>
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">username</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="email">email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">password</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">confirm password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn">[create account]</button>
            </form>

            <div class="auth-footer">
                Already have an account? <a href="{{ route('login') }}">login</a>
            </div>
        </div>
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
