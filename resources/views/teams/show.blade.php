@extends('layouts.app')

@section('title', $team->name . '｜チーム詳細')

@section('content')
<div class="container py-5">
    @if (Auth::check())
        <a href="{{ route('teams.edit', $team->id) }}" class="btn btn-primary mb-4">チームを編集する</a>
    @endif

    {{-- メインレイアウト：左＝画像 / 右＝紹介 --}}
    <div class="row g-4 mb-5 align-items-start">
        {{-- 左：カルーセル --}}
        <div class="col-12 col-lg-6">
            <div id="teamCarousel" class="carousel slide shadow-sm rounded" data-bs-ride="carousel">
                <div class="carousel-inner" style="max-height: 500px; overflow: hidden;">
                    @if ($team->images->isNotEmpty())
                        @foreach ($team->images as $i => $img)
                            <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                <img
                                    src="{{ asset('storage/' . $img->image_path) }}"
                                    class="d-block w-100"
                                    style="object-fit: cover; height: 500px;"
                                    alt="{{ $img->caption ?? 'チーム画像' }}"
                                >
                                @if ($img->caption)
                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded py-2 px-3">
                                        <p class="mb-0 text-white small">{{ $img->caption }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        @for ($i = 1; $i <= 3; $i++)
                            <div class="carousel-item {{ $i === 1 ? 'active' : '' }}">
                                <img
                                    src="{{ asset('sample_images/sample' . $i . '.png') }}"
                                    class="d-block w-100"
                                    style="object-fit: cover; height: 500px;"
                                    alt="サンプル画像{{ $i }}"
                                >
                            </div>
                        @endfor
                    @endif
                </div>

                @if ($team->images->count() > 1 || $team->images->isEmpty())
                    <button class="carousel-control-prev" type="button" data-bs-target="#teamCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">前へ</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#teamCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">次へ</span>
                    </button>
                @endif
            </div>
        </div>

        {{-- 右：チーム紹介 --}}
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h2 class="card-title">{{ $team->name }}</h2>
                    <p class="text-muted mb-2">📍 {{ $team->prefecture->name }} {{ $team->city }}</p>
                    <p><strong>対象学年:</strong> {{ $team->grade_range }}</p>
                    <p><strong>練習日:</strong> {{ implode('・', $team->practice_days) }}</p>
                    <hr>
                    <p class="mt-3">{{ $team->introduction }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- その他の画像 --}}
    @if ($team->images->count() > 1)
        <h5 class="mb-3">📷 その他の画像</h5>
        <div class="row g-3">
            @foreach ($team->images->slice(1) as $img)
                <div class="col-6 col-md-3">
                    <div class="border rounded overflow-hidden">
                        <img src="{{ asset('storage/' . $img->image_path) }}" class="img-fluid" alt="チーム画像">
                        @if ($img->caption)
                            <div class="p-2 bg-light small text-muted">{{ $img->caption }}</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- 📩 お問い合わせフォーム --}}
    <div class="card shadow-sm mt-5">
        <div class="card-body">
            <h5 class="card-title mb-4">📩 チームへのお問い合わせ</h5>

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <form action="{{ route('inquiries.store', $team->id) }}" method="POST">
                @csrf
                <p class="text-muted small mb-3">※チーム関係者以外の第三者へはお問い合わせ内容は公開されません</p>
                <div class="mb-3">
                    <label for="name" class="form-label">お名前</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">メールアドレス</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">お問い合わせ内容</label>
                    <textarea name="message" rows="5" class="form-control" required>{{ old('message') }}</textarea>
                    @error('message')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">送信する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
