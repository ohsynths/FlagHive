@extends('layouts.app')

@section('title', 'FlagHive - forgot password')

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

    .success-box {
        border: 1px solid #333;
        background-color: #0a0a0a;
        padding: 0.75rem;
        margin-bottom: 1rem;
        color: #fff;
        font-size: 0.8rem;
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
@endsection

@section('content')
    <main>
        <div class="auth-card">
            <p class="auth-header"><span class="dollar">$</span> recover password</p>
            <h1 class="auth-title cursor-blink">Reset your password</h1>

            @if (session('success'))
                <div class="success-box">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="error-box">
                    <div class="error-title">Errors:</div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email">email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <button type="submit" class="btn">[send reset link]</button>
            </form>

            <div class="auth-footer">
                <a href="{{ route('login') }}">[back to login]</a>
            </div>
        </div>
    </main>
@endsection
