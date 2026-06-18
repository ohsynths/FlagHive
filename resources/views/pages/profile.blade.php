@extends('layouts.app')

@section('title', 'FlagHive - profile')

@section('styles')
    main {
        max-width: 100%;
        margin: 0 auto;
        padding: 1.5rem 1rem;
    }

    .card {
        border: 1px solid #333;
        background-color: #0a0a0a;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .card-header {
        margin-bottom: 0.5rem;
        font-size: 0.75rem;
        color: #888;
    }

    .card-header .dollar { color: #fff; }

    .card-title {
        font-size: 1.5rem;
        font-weight: 400;
        letter-spacing: -0.025em;
        margin-bottom: 0.75rem;
        color: #fff;
    }

    .info-grid {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 0.5rem 1.5rem;
        font-size: 0.875rem;
    }

    .info-grid .label {
        color: #555;
    }

    .info-grid .value {
        color: #fff;
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 1rem;
    }

    .avatar {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        border: 1px solid #333;
        object-fit: cover;
        flex-shrink: 0;
    }

    .avatar-placeholder {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        border: 1px solid #333;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #555;
        flex-shrink: 0;
    }

    .avatar-form {
        margin-top: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .avatar-form input[type="file"] {
        font-family: inherit;
        font-size: 0.75rem;
        color: #888;
    }

    .avatar-form button {
        background: none;
        border: 1px solid #333;
        color: #888;
        padding: 0.35rem 0.75rem;
        font-family: inherit;
        font-size: 0.75rem;
        cursor: pointer;
    }

    .avatar-form button:hover {
        border-color: #fff;
        color: #fff;
    }

    .success {
        font-size: 0.75rem;
        color: #fff;
        margin-top: 0.5rem;
    }

    .writeup-row {
        border: 1px solid #333;
        border-bottom: none;
        padding: 0.75rem 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        font-size: 0.875rem;
    }

    .writeup-row:last-child {
        border-bottom: 1px solid #333;
    }

    .writeup-row:hover {
        background-color: #0a0a0a;
    }

    .writeup-row a {
        color: #fff;
        text-decoration: none;
    }

    .writeup-row a:hover {
        text-decoration: underline;
    }

    .writeup-row .meta {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.75rem;
        color: #555;
    }

    .writeup-row .meta .badge {
        color: #888;
    }

    .empty-card {
        border: 1px solid #333;
        background-color: #0a0a0a;
        padding: 2rem;
        text-align: center;
    }

    .empty-card p {
        font-size: 0.875rem;
        color: #888;
    }

    @media (min-width: 640px) {
        main { padding: 2rem 1.5rem; }
    }

    @media (min-width: 1024px) {
        main { padding: 2rem 2rem; }
    }
@endsection

@section('content')
    <main>
        <div class="card">
            <p class="card-header"><span class="dollar">$</span> cat profile/{{ $user->name }}</p>
            <div class="profile-header">
                @if ($user->avatar_url)
                    <img src="{{ $user->avatar_url }}" alt="avatar" class="avatar">
                @else
                    <div class="avatar-placeholder">?</div>
                @endif
                <div>
                    <h1 class="card-title" style="margin-bottom:0">{{ $user->name }}</h1>
                </div>
            </div>
            <div class="info-grid">
                <span class="label">email:</span>
                <span class="value">{{ $user->email }}</span>
                <span class="label">member since:</span>
                <span class="value">{{ $user->created_at->format('Y-m-d') }}</span>
                <span class="label">writeups:</span>
                <span class="value">{{ $writeups->total() }}</span>
            </div>
            <form class="avatar-form" method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data">
                @csrf
                <input type="file" name="avatar" accept="image/png,image/jpeg,image/gif" required>
                <button type="submit">upload</button>
            </form>
            @if (session('success'))
                <p class="success">{{ session('success') }}</p>
            @endif
            @error('avatar')
                <p class="success" style="color:#888">{{ $message }}</p>
            @enderror
        </div>

        @forelse ($writeups as $w)
            <div class="writeup-row">
                <a href="#">{{ $w->title }}</a>
                <div class="meta">
                    <span class="badge">{{ $w->category->name }}</span>
                    <span class="badge">{{ $w->ctf->name }}</span>
                    <span>{{ $w->created_at->format('Y-m-d') }}</span>
                </div>
            </div>
        @empty
            <div class="empty-card">
                <p>No writeups yet</p>
            </div>
        @endforelse
    </main>
@endsection
