@extends('layouts.app')

@section('title', 'FlagHive - email verified')

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
        margin-bottom: 1rem;
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
    }

    .btn:hover {
        background: #fff;
        color: #000;
    }
@endsection

@section('content')
    <main>
        <div class="auth-card">
            <p class="auth-header"><span class="dollar">$</span> verify</p>
            <h1 class="auth-title cursor-blink">Email verified</h1>

            <div class="info-text">
                Your email has been verified successfully. You now have full access to FlagHive.
            </div>

            <a href="{{ route('home') }}" class="btn">[enter]</a>
        </div>
    </main>
@endsection
