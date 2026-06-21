@extends('layouts.app')

@section('title', 'FlagHive - login')

@section('styles')
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

    .form-group { margin-bottom: 1rem; }

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

    .form-group input:focus { border-color: #fff; }

    .error-box {
        border: 1px solid #333;
        background-color: #0a0a0a;
        padding: 0.75rem;
        margin-bottom: 1rem;
        color: #888;
        font-size: 0.8rem;
    }

    .error-box .error-title { color: #fff; margin-bottom: 0.25rem; }

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

    .auth-footer a:hover { text-decoration: underline; }

    .password-wrapper {
        position: relative;
        display: flex;
        align-items: stretch;
    }

    .password-wrapper input {
        flex: 1;
        min-width: 0;
        border-right: none;
    }

    .eye-toggle {
        background: #000;
        border: 1px solid #333;
        border-left: none;
        color: #888;
        font-family: inherit;
        font-size: 0.7rem;
        padding: 0 0.6rem;
        cursor: pointer;
        white-space: nowrap;
    }

    .eye-toggle:hover {
        color: #fff;
        border-color: #fff;
    }
@endsection

@section('content')
    <main>
        <div class="auth-card">
            <p class="auth-header"><span class="dollar">$</span> login</p>
            <h1 class="auth-title cursor-blink">Authentication required</h1>

            @if ($errors->any())
            <div class="error-box">
                <div class="error-title">Errors:</div>
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">password</label>
                    <div class="password-wrapper">
                        <input id="password" type="password" name="password" required>
                        <button type="button" class="eye-toggle" onclick="togglePass(this)">[show]</button>
                    </div>
                </div>

                <button type="submit" class="btn">[authenticate]</button>
            </form>

            <div class="auth-footer" style="margin-top:0.5rem">
                <a href="{{ route('password.request') }}">[forgot password?]</a>
            </div>

            <div class="auth-footer">
                No account? <a href="{{ route('register') }}">register</a>
            </div>
        </div>
    </main>

    <script>
        function togglePass(btn) {
            const input = btn.parentElement.querySelector('input');
            const isPass = input.type === 'password';
            input.type = isPass ? 'text' : 'password';
            btn.textContent = isPass ? '[hide]' : '[show]';
        }
    </script>
@endsection
