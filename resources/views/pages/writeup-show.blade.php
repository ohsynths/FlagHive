@extends('layouts.app')

@section('title', "FlagHive - {$writeup->title}")

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

    .meta-row {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        font-size: 0.75rem;
        color: #555;
        margin-bottom: 1.5rem;
    }

    .meta-row span { white-space: nowrap; }
    .meta-row .badge { color: #888; }

    .markdown-body {
        font-size: 0.875rem;
        line-height: 1.7;
        color: #ccc;
    }

    .markdown-body h1,
    .markdown-body h2,
    .markdown-body h3,
    .markdown-body h4 {
        color: #fff;
        font-weight: 400;
        margin: 1.5em 0 0.5em;
    }

    .markdown-body h1 { font-size: 1.25rem; }
    .markdown-body h2 { font-size: 1.1rem; }
    .markdown-body h3 { font-size: 1rem; }

    .markdown-body p {
        margin-bottom: 0.75em;
    }

    .markdown-body code {
        background: #111;
        color: #fff;
        padding: 0.15em 0.4em;
        font-size: 0.8em;
        font-family: 'Courier New', Courier, monospace;
    }

    .markdown-body pre {
        background: #111;
        border: 1px solid #333;
        padding: 1rem;
        overflow-x: auto;
        margin: 1em 0;
    }

    .markdown-body pre code {
        background: none;
        padding: 0;
    }

    .markdown-body a {
        color: #fff;
        text-decoration: underline;
    }

    .markdown-body blockquote {
        border-left: 3px solid #333;
        padding-left: 1rem;
        color: #888;
        margin: 1em 0;
    }

    .markdown-body ul,
    .markdown-body ol {
        padding-left: 1.5rem;
        margin-bottom: 0.75em;
    }

    .markdown-body li {
        margin-bottom: 0.25em;
    }

    .markdown-body hr {
        border: none;
        border-top: 1px solid #333;
        margin: 1.5em 0;
    }

    .markdown-body table {
        width: 100%;
        border-collapse: collapse;
        margin: 1em 0;
    }

    .markdown-body th,
    .markdown-body td {
        border: 1px solid #333;
        padding: 0.5rem 0.75rem;
        text-align: left;
    }

    .markdown-body th {
        color: #fff;
        font-weight: normal;
    }

    .back-link {
        display: inline-block;
        font-size: 0.75rem;
        color: #888;
        text-decoration: none;
        margin-bottom: 1rem;
    }

    .back-link:hover {
        color: #fff;
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
        <a class="back-link" href="{{ route('writeups') }}">$ cd ..</a>

        <div class="card">
            <p class="card-header"><span class="dollar">$</span> cat writeups/{{ $writeup->slug }}.md</p>
            <h1 class="card-title cursor-blink">{{ $writeup->title }}</h1>

            <div class="meta-row">
                <span class="badge">{{ $writeup->category->name }}</span>
                <span class="badge">{{ $writeup->ctf }}</span>
                <span style="color:#fff">{{ $writeup->user->name }}</span>
                <span>{{ $writeup->created_at->format('Y-m-d') }}</span>
            </div>

            @if ($writeup->description)
                <p style="color:#888;font-size:0.875rem;margin-bottom:1.5rem">{{ $writeup->description }}</p>
            @endif

            <div class="markdown-body">
                {!! $html !!}
            </div>
        </div>
    </main>
@endsection
