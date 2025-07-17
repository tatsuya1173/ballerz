@extends('layouts.app')

@section('title', 'コーチダッシュボード')

@section('content')
<div class="container py-5">
    @if (session('message'))
        <div class="alert alert-success mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="row">
        {{-- メインコンテンツ --}}
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <h4 class="fw-bold mb-0">📋 あなたの登録チーム一覧</h4>
            </div>

            @if ($myTeams->isEmpty())
                <div class="text-center p-5 bg-light rounded shadow-sm">
                    <p class="fs-5 mb-4 text-secondary">現在、登録されたチームはありません。</p>
                    <a href="{{ route('teams.create') }}" class="btn btn-success btn-lg">
                        ＋ チームを新規登録する
                    </a>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4">
                    @foreach ($myTeams as $team)
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0">
                                @php
                                    $imagePath = $team->images->isNotEmpty()
                                        ? asset('storage/' . $team->images->first()->image_path)
                                        : asset('sample_images/sample1.png');
                                @endphp
                                <img src="{{ $imagePath }}" class="card-img-top" alt="チーム画像" style="height: 180px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $team->name }}</h5>
                                    <p class="mb-1 text-muted">📍 {{ $team->prefecture->name }} {{ $team->city }}</p>
                                    <p class="mb-1"><strong>対象:</strong> {{ $team->grade_range }}</p>
                                    <p class="small text-muted mb-2">練習日: {{ implode('・', $team->practice_days) }}</p>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('teams.show', $team->id) }}" class="btn btn-sm btn-outline-secondary">詳細</a>
                                        <a href="{{ route('teams.edit', $team->id) }}" class="btn btn-sm btn-outline-secondary">編集</a>
                                        <a href="{{ route('teams.schedules.index', $team->id) }}" class="btn btn-sm btn-outline-secondary">スケジュール</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- サイドバー --}}
        <div class="col-lg-3">
            <div class="card shadow-sm mb-4">
                <div class="card-body d-grid gap-2">
                    <a href="{{ route('teams.create') }}" class="btn btn-primary btn-block">＋ チームを新規登録</a>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-block">👤 プロフィール編集</a>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold">📨 最新のお問い合わせ</div>
                <ul class="list-group list-group-flush">
                    @forelse ($latestInquiries as $inquiry)
                        <li class="list-group-item">
                            {{ $inquiry->name }} さん（{{ $inquiry->email }}）<br>
                            <span class="text-muted small">{{ Str::limit($inquiry->message, 40) }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">まだお問い合わせはありません。</li>
                    @endforelse
                    @if ($latestInquiries->isNotEmpty())
                        <li class="list-group-item text-muted small">
                            <a href="{{ route('inquiry.index') }}" class="text-decoration-none">もっと見る...</a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="card shadow-sm">
                <div class="card-header fw-bold">💬 最新のチャット</div>
                <ul class="list-group list-group-flush">
                    {{-- 仮表示（本実装ではチャット履歴と連携） --}}
                    <li class="list-group-item">山田さん: 明日の練習は？</li>
                    <li class="list-group-item">佐藤さん: 資料送ってください</li>
                    <li class="list-group-item text-muted small">もっと見る...</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
