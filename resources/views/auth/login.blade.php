@extends('layouts.app')

@section('title', 'ログイン｜Ballerz')

@section('content')
<div class="container py-5" style="max-width: 480px;">
    <div class="text-center mb-4">
        <h2 class="fw-bold">⚽ ログイン</h2>
        <p class="text-muted">マイページやチーム管理にはログインが必要です</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="card p-4 shadow-sm border-0 bg-white">
        @csrf

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label for="password" class="form-label">パスワード</label>
            <input type="password" id="password" name="password"
                class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Remember me --}}
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">
                次回から自動でログインする
            </label>
        </div>

        {{-- Forgot password --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="small text-decoration-none">
                    パスワードをお忘れですか？
                </a>
            @endif
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary w-100 fw-bold">
            ログインする
        </button>
    </form>

    <div class="text-center mt-4">
        <p class="small text-muted">まだアカウントをお持ちでない方は</p>
        <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-sm">新規登録はこちら</a>
    </div>
</div>
@endsection
