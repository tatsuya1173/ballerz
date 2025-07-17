<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Ballerz｜小学生サッカーチームマッチング</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background: linear-gradient(135deg, #0d6efd, #6ea8fe);
            color: white;
            padding: 4rem 1rem;
            border-radius: 0.5rem;
            text-align: center;
        }
        .team-card-img {
            height: 180px;
            object-fit: cover;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            width: 100%;
        }
        footer {
            background-color: #f8f9fa;
            padding: 2rem 0;
            border-top: 1px solid #ddd;
            margin-top: 4rem;
        }
        .section-title {
            font-size: 1.5rem;
            margin-top: 3rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-4">
    <!-- ヒーロー -->
    <div class="hero mb-5 shadow-sm">
        <h1 class="display-4 fw-bold">⚽ Ballerz</h1>
        <p class="lead">全国の小学生サッカーチームを探して、つながろう！</p>
        <p>保護者と指導者をつなぐ、新しいチーム探しのプラットフォームです。</p>
        <a href="{{ route('teams.index') }}" class="btn btn-light btn-lg mt-3">チームを探す</a>
    </div>

    <!-- 特徴セクション -->
    <div class="row text-center mb-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">📍 地域で探せる</h5>
                    <p class="card-text text-muted">都道府県・市区町村ごとにサッカーチームを検索できます。</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">� チーム情報が充実</h5>
                    <p class="card-text text-muted">練習日、対象学年、紹介文など詳細に掲載。</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">👨‍🏫 コーチも掲載OK</h5>
                    <p class="card-text text-muted">自チームを登録し、写真とともに魅力をアピール可能！</p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <!-- チーム一覧 -->
    <h2 id="teams" class="section-title">直近に登録されたチーム</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($teams as $team)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    @php
                        $imagePath = $team->images->isNotEmpty()
                            ? asset('storage/' . $team->images->first()->image_path)
                            : asset('sample_images/sample1.png');
                    @endphp
                    <img src="{{ $imagePath }}" alt="チーム画像" class="team-card-img">

                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $team->name }}</h5>
                        <p class="mb-1 text-muted">
                            📍 {{ $team->prefecture->name }} {{ $team->city }}
                        </p>
                        <span class="badge bg-info text-dark mb-1">対象: {{ $team->grade_range }}</span>
                        <div class="mb-2">
                            <span class="badge bg-secondary">
                                練習日:
                                {{ implode('・', is_array($team->practice_days) ? $team->practice_days : json_decode($team->practice_days, true)) }}
                            </span>
                        </div>
                        <p class="card-text small text-muted">{{ Str::limit($team->introduction, 60) }}</p>
                        <a href="{{ route('teams.show', $team->id) }}" class="btn btn-outline-primary btn-sm mt-2">詳細を見る</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- <div class="mt-5 d-flex justify-content-center">
        {{ $teams->links() }}
    </div> -->
</div>

<!-- フッター -->
<footer>
    <div class="container text-center text-muted small">
        <p>Ballerz は全国の小学生サッカーチームと保護者をつなぐマッチングプラットフォームです。</p>
        <p class="mb-0">&copy; {{ date('Y') }} Ballerz. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
