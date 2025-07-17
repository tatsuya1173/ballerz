@extends('layouts.app')

@section('title', '新規登録｜Ballerz')

@section('content')
<div class="container py-5" style="max-width: 480px;">
    <div class="text-center mb-4">
        <h2 class="fw-bold">📝 新規登録</h2>
        <p class="text-muted">チーム管理や掲載にはアカウントが必要です</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="card p-4 shadow-sm border-0 bg-white">
        @csrf

        {{-- Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">お名前</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror" required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror" required>
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

        {{-- Confirm Password --}}
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">パスワード（確認）</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror" required>
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-success w-100 fw-bold">
            登録する
        </button>
    </form>

    <div class="text-center mt-4">
        <p class="small text-muted">すでにアカウントをお持ちの方は</p>
        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">ログインはこちら</a>
    </div>
</div>
@endsection
