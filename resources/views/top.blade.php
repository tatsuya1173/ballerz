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
            padding: 3rem 1rem;
            border-radius: 0.5rem;
            text-align: center;
        }
        .team-image-placeholder {
            background-color: #f0f0f0;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #888;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="hero mb-5 shadow-sm">
        <h1 class="display-5 fw-bold">⚽ Ballerz</h1>
        <p class="lead">全国の小学生サッカーチームを見つけて、つながろう！</p>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($teams as $team)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="team-image-placeholder">
                        <span>📷 画像なし</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $team->name }}</h5>
                        <p class="mb-1 text-muted">
                            📍 {{ $team->prefecture->name }} {{ $team->city }}
                        </p>
                        <span class="badge bg-info text-dark mb-1">対象: {{ $team->grade_range }}</span>
                        <div class="mb-2">
                            <span class="badge bg-secondary">
                                練習日: {{ implode('・', $team->practice_days) }}
                            </span>
                        </div>
                        <p class="card-text small text-muted">{{ Str::limit($team->introduction, 60) }}</p>
                        <a href="#" class="btn btn-outline-primary btn-sm w-100 mt-auto">詳細を見る</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $teams->links() }}
    </div>
</div>

</body>
</html>
