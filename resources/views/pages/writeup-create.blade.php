@extends('layouts.app')

@section('title', 'FlagHive - new writeup')

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
        margin-bottom: 1rem;
        font-size: 0.75rem;
        color: #888;
    }

    .card-header .dollar { color: #fff; }

    .card-title {
        font-size: 1.5rem;
        font-weight: 400;
        letter-spacing: -0.025em;
        margin-bottom: 1.5rem;
        color: #fff;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        display: block;
        font-size: 0.75rem;
        color: #888;
        margin-bottom: 0.35rem;
    }

    .form-group label .dollar { color: #fff; }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        background: #000;
        border: 1px solid #333;
        color: #fff;
        padding: 0.6rem 0.75rem;
        font-family: inherit;
        font-size: 0.875rem;
        outline: none;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #fff;
    }

    .form-group textarea {
        min-height: 400px;
        resize: vertical;
        line-height: 1.6;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .form-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .form-actions button {
        background: none;
        border: 1px solid #fff;
        color: #fff;
        padding: 0.5rem 1.25rem;
        font-family: inherit;
        font-size: 0.875rem;
        cursor: pointer;
    }

    .form-actions button:hover {
        background: #fff;
        color: #000;
    }

    .form-actions a {
        font-size: 0.875rem;
        color: #888;
        text-decoration: none;
    }

    .form-actions a:hover {
        color: #fff;
    }

    .file-upload {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
        margin-top: 0.5rem;
    }

    .file-upload input[type="file"] {
        font-family: inherit;
        font-size: 0.75rem;
        color: #888;
        width: auto;
    }

    .file-upload label {
        font-size: 0.75rem;
        color: #555;
        padding-top: 0.15rem;
    }

    .error {
        font-size: 0.75rem;
        color: #888;
        margin-top: 0.25rem;
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
            <p class="card-header"><span class="dollar">$</span> touch writeups/new</p>
            <h1 class="card-title cursor-blink">New writeup</h1>

            <form method="POST" action="{{ route('writeups.store') }}">
                @csrf

                <div class="form-group">
                    <label><span class="dollar">$</span> title</label>
                    <input type="text" name="title" value="{{ old('title') }}" required>
                    @error('title') <p class="error">{{ $message }}</p> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="dollar">$</span> category</label>
                        <select name="category_id" required>
                            <option value="">[select]</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label><span class="dollar">$</span> ctf</label>
                        <input type="text" name="ctf" value="{{ old('ctf') }}" required>
                        @error('ctf') <p class="error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label><span class="dollar">$</span> description</label>
                    <input type="text" name="description" value="{{ old('description') }}">
                    @error('description') <p class="error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label><span class="dollar">$</span> content (markdown)</label>
                    <div class="file-upload">
                        <label>or upload .md:</label>
                        <input type="file" accept=".md,text/markdown" onchange="readFile(this)">
                    </div>
                    <textarea name="content" id="content" required>{{ old('content') }}</textarea>
                    @error('content') <p class="error">{{ $message }}</p> @enderror
                </div>

                <script>
                function readFile(input) {
                    const file = input.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('content').value = e.target.result;
                    };
                    reader.readAsText(file);
                }
                </script>

                <div class="form-actions">
                    <button type="submit">publish</button>
                    <a href="{{ route('writeups') }}">cancel</a>
                </div>
            </form>
        </div>
    </main>
@endsection
