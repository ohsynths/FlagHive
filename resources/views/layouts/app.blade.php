<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'FlagHive')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background-color: #000;
            font-family: 'Courier New', Courier, monospace;
            -webkit-font-smoothing: antialiased;
        }

        .nav { border-bottom: 1px solid #333; }

        .dollar { color: #fff; }
        .cmd { color: #fff; }
        .path { color: #fff; }

        .nav-inner {
            max-width: 100%;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
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

        .nav-right a.nav-user {
            color: #fff;
        }

        .nav-right a:hover,
        .nav-right form button:hover {
            color: #fff;
        }

        .nav-right form button {
            background: none;
            border: none;
            font-family: inherit;
            font-size: inherit;
            color: #888;
            cursor: pointer;
        }

        .cursor-blink::after {
            content: '';
            border-right: 7px solid #fff;
            animation: blink 1s step-end infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        @media (min-width: 640px) {
            .nav-inner { padding: 1rem 1.5rem; }
        }

        @media (min-width: 1024px) {
            .nav-inner { padding: 1rem 2rem; }
        }

        @yield('styles')
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/styles/github-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/highlight.min.js"></script>
</head>
<body>
    <nav class="nav">
        <div class="nav-inner">
            <a class="nav-left" href="/">
                <span class="dollar">$</span>
                <span class="cmd">cd</span>
                <span class="path cursor-blink">~/flaghive</span>
            </a>
            <div class="nav-right">
                <a href="{{ route('writeups') }}">writeups/</a>
                <a href="{{ route('stats') }}">stats/</a>
                @auth
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}">[admin]</a>
                    @endif
                    <a href="{{ route('writeups.create') }}">[new]</a>
                    <a href="{{ route('profile') }}" class="nav-user">{{ auth()->user()->name }}</a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit">[logout]</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">[login]</a>
                @endauth
            </div>
        </div>
    </nav>

    @yield('content')
</body>
</html>
