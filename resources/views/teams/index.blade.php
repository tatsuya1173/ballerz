@extends('layouts.app')

@section('title', 'チーム一覧')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 fw-bold">📋 チーム一覧</h1>

    <div class="row">
        <!-- サイドバー（検索条件） -->
<div class="col-md-3">
    <div class="card mb-3 shadow-sm">
        <div class="card-header bg-primary text-white fw-semibold">🔍 検索条件</div>
            <div class="card-body">
                <form method="GET" action="{{ route('teams.index') }}">
                    <h6 class="fw-bold">チーム名</h6>
                    <input type="text" name="name" value="{{ request('name') }}" class="form-control mb-3" placeholder="例: FCバルサ">

                    <h6 class="fw-bold">都道府県</h6>
                    <select name="prefecture_id" class="form-select mb-3">
                        <option value="">選択してください</option>
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}" {{ request('prefecture_id') == $prefecture->id ? 'selected' : '' }}>
                                {{ $prefecture->name }}
                            </option>
                        @endforeach
                    </select>

                    <h6 class="fw-bold">市区町村</h6>
                    <input type="text" name="city" value="{{ request('city') }}" class="form-control mb-3" placeholder="例: 東京都千代田区">

                    <h6 class="fw-bold">対象学年</h6>
                    <select name="grade_range" class="form-select mb-3">
                        <option value="">選択してください</option>
                        <option value="1〜3年" {{ request('grade_range') == '1〜3年' ? 'selected' : '' }}>1〜3年</option>
                        <option value="4〜6年" {{ request('grade_range') == '4〜6年' ? 'selected' : '' }}>4〜6年</option>
                        <option value="全学年" {{ request('grade_range') == '全学年' ? 'selected' : '' }}>全学年</option>
                    </select>

                    <h6 class="fw-bold">練習日</h6>
                    @foreach ($practice_days as $day)
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox" name="practice_days[]" value="{{ $day }}"
                                {{ is_array(request('practice_days')) && in_array($day, request('practice_days')) ? 'checked' : '' }}
                                id="day_{{ $loop->index }}">
                            <label class="form-check-label" for="day_{{ $loop->index }}">{{ $day }}</label>
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary w-100 mt-4">検索する</button>
                    <a href="{{ route('teams.index') }}" class="btn btn-secondary w-100 mt-2">リセット</a>
                </form>
            </div>
        </div>
    </div>


        <!-- メインコンテンツ -->
        <div class="col-md-9">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($teams as $team)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm">
                            <a href="{{ route('teams.show', $team->id) }}">
                                @php
                                    $imagePath = $team->images->isNotEmpty()
                                        ? asset('storage/' . $team->images->first()->image_path)
                                        : asset('sample_images/sample1.png');
                                @endphp
                                <img src="{{ $imagePath }}" class="card-img-top" alt="チーム画像" style="height: 180px; object-fit: cover;">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ $team->name }}</h5>
                                <p class="mb-1 text-muted">📍 {{ $team->prefecture->name }} {{ $team->city }}</p>
                                <p class="mb-1"><strong>対象:</strong> {{ $team->grade_range }}</p>
                                <p class="mb-0 small text-muted">練習日: {{ implode('・', $team->practice_days) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $teams->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
