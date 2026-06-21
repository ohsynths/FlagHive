@extends('layouts.app')

@section('title', 'FlagHive - reset password')

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
            <p class="auth-header"><span class="dollar">$</span> reset password</p>
            <h1 class="auth-title cursor-blink">Set new password</h1>

            @if ($errors->any())
                <div class="error-box">
                    <div class="error-title">Errors:</div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="email">email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group" style="font-size:0.75rem;color:#555;margin-bottom:0.75rem">
                    password must contain uppercase, lowercase, digit, and special character (min 8 chars)
                </div>

                <div class="form-group">
                    <label for="password">new password</label>
                    <div class="password-wrapper">
                        <input id="password" type="password" name="password" required>
                        <button type="button" class="eye-toggle" onclick="togglePass(this)">[show]</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">confirm password</label>
                    <div class="password-wrapper">
                        <input id="password_confirmation" type="password" name="password_confirmation" required>
                        <button type="button" class="eye-toggle" onclick="togglePass(this)">[show]</button>
                    </div>
                </div>

                <button type="submit" class="btn">[reset password]</button>
            </form>

            <div class="auth-footer">
                <a href="{{ route('login') }}">[back to login]</a>
            </div>
        </div>
    </main>
@endsection
