@extends('layouts.app')

@section('title', 'チーム編集')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 fw-bold">✏️ チームを編集する</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>入力内容に誤りがあります：</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li class="small">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('teams.update', $team->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">チーム名</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ old('name', $team->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="prefecture_id" class="form-label">都道府県</label>
            <select class="form-select" id="prefecture_id" name="prefecture_id" required>
                <option value="">選択してください</option>
                @foreach (\App\Models\Prefecture::all() as $prefecture)
                    <option value="{{ $prefecture->id }}"
                        {{ old('prefecture_id', $team->prefecture_id) == $prefecture->id ? 'selected' : '' }}>
                        {{ $prefecture->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">市区町村</label>
            <input type="text" class="form-control" id="city" name="city"
                   value="{{ old('city', $team->city) }}" required>
        </div>

        <div class="mb-3">
            <label for="grade_range" class="form-label">対象学年</label>
            <select class="form-select" id="grade_range" name="grade_range" required>
                <option value="">選択してください</option>
                <option value="1〜3年" {{ old('grade_range', $team->grade_range) == '1〜3年' ? 'selected' : '' }}>1〜3年</option>
                <option value="4〜6年" {{ old('grade_range', $team->grade_range) == '4〜6年' ? 'selected' : '' }}>4〜6年</option>
                <option value="全学年" {{ old('grade_range', $team->grade_range) == '全学年' ? 'selected' : '' }}>全学年</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">練習日（複数選択可）</label>
            @php $days = ['月', '火', '水', '木', '金', '土', '日']; @endphp
            <div class="d-flex flex-wrap gap-2">
                @foreach ($days as $day)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="practice_days[]" id="day_{{ $day }}" value="{{ $day }}"
                            {{ in_array($day, old('practice_days', $team->practice_days ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="day_{{ $day }}">{{ $day }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-4">
            <label for="introduction" class="form-label">チーム紹介</label>
            <textarea class="form-control" id="introduction" name="introduction" rows="5">{{ old('introduction', $team->introduction) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="team_images" class="form-label">チーム画像（複数選択可）</label>
            <input class="form-control" type="file" id="team_images" name="team_images[]" accept="image/*" multiple>
        </div>

        <button type="submit" class="btn btn-success w-100">更新する</button>
    </form>
</div>
@endsection
