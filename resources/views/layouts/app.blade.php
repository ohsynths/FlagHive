<!DOCTYPE html>
<html lang="en" class="dark">
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
                    <span style="color:#fff">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit" style="background:none;border:none;font-family:inherit;font-size:inherit;color:#888;cursor:pointer">[logout]</button>
                    </form>
                @else
                    @hasSection('nav-right')
                        @yield('nav-right')
                    @else
                        <a href="{{ route('login') }}">[login]</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    @yield('content')
</body>
</html>
