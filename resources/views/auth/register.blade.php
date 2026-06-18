<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FlagHive - register</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background-color: #000;
            font-family: 'Courier New', Courier, monospace;
            -webkit-font-smoothing: antialiased;
            display: flex;
            flex-direction: column;
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
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .auth-card {
            border: 1px solid #333;
            background-color: #0a0a0a;
            width: 100%;
            max-width: 400px;
            padding: 2rem;
        }

        .auth-title {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 400;
            margin-bottom: 0.5rem;
        }

        .auth-header {
            color: #888;
            font-size: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .auth-header .dollar { color: #fff; }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            color: #888;
            font-size: 0.8rem;
            margin-bottom: 0.4rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.6rem 0.75rem;
            background: #000;
            border: 1px solid #333;
            color: #fff;
            font-family: inherit;
            font-size: 0.875rem;
            outline: none;
        }

        .form-group input:focus {
            border-color: #fff;
        }

        .error-box {
            border: 1px solid #333;
            background-color: #0a0a0a;
            padding: 0.75rem;
            margin-bottom: 1rem;
            color: #888;
            font-size: 0.8rem;
        }

        .error-box .error-title {
            color: #fff;
            margin-bottom: 0.25rem;
        }

        .btn {
            width: 100%;
            padding: 0.6rem;
            background: none;
            border: 1px solid #fff;
            color: #fff;
            font-family: inherit;
            font-size: 0.875rem;
            cursor: pointer;
            margin-top: 0.5rem;
        }

        .btn:hover {
            background: #fff;
            color: #000;
        }

        .auth-footer {
            color: #888;
            font-size: 0.8rem;
            margin-top: 1rem;
            text-align: center;
        }

        .auth-footer a {
            color: #fff;
            text-decoration: none;
        }

        .auth-footer a:hover {
            text-decoration: underline;
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
        }
        @media (min-width: 1024px) {
            .nav-inner { padding: 1rem 2rem; }
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
</body>
</html>
