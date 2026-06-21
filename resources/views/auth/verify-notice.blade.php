@extends('layouts.app')

@section('title', 'FlagHive - verify email')

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
        max-width: 500px;
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

    .info-text {
        font-size: 0.875rem;
        color: #888;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .btn {
        display: inline-block;
        padding: 0.6rem 1.2rem;
        background: none;
        border: 1px solid #fff;
        color: #fff;
        font-family: inherit;
        font-size: 0.875rem;
        cursor: pointer;
        text-decoration: none;
        margin-right: 0.75rem;
    }

    .btn:hover {
        background: #fff;
        color: #000;
    }

    .btn-link {
        background: none;
        border: none;
        font-family: inherit;
        font-size: 0.8rem;
        color: #888;
        cursor: pointer;
        text-decoration: underline;
    }

    .btn-link:hover {
        color: #fff;
    }

    .success {
        color: #fff;
        font-size: 0.8rem;
        margin-top: 1rem;
    }

    .error-box {
        border: 1px solid #333;
        background-color: #0a0a0a;
        padding: 0.75rem;
        margin-bottom: 1rem;
        color: #888;
        font-size: 0.8rem;
    }

    .error-box .error-title { color: #fff; margin-bottom: 0.25rem; }
@endsection

@section('content')
    <main>
        <div class="auth-card">
            <p class="auth-header"><span class="dollar">$</span> verify</p>
            <h1 class="auth-title cursor-blink">Verify your email</h1>

            @if (session('resent'))
                <div class="success">A fresh verification link has been sent to your email.</div>
            @endif

            <div class="info-text">
                Thanks for signing up! Before you can create writeups or access your profile,
                please verify your email address by clicking the link we just sent you.
            </div>

            <div class="info-text" style="font-size:0.8rem;color:#555">
                Didn't receive the email?
            </div>

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-link">[click here to resend]</button>
            </form>

            <div style="margin-top:2rem">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-link">[logout]</button>
                </form>
            </div>
        </div>
    </main>
@endsection
