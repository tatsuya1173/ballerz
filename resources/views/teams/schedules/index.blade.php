@extends('layouts.app')

@section('title', 'スケジュール管理')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold">{{ $team->name }}｜スケジュール管理</h1>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    {{-- 📅 スケジュール追加フォーム --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-bold bg-light">
            📅 新しいスケジュールを登録
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('teams.schedules.store', $team->id) }}">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">日付</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">開始</label>
                        <input type="time" name="start_time" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">終了</label>
                        <input type="time" name="end_time" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">タイトル</label>
                        <input type="text" name="title" class="form-control" placeholder="例：練習試合" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle me-1"></i> 追加
                        </button>
                    </div>
                </div>
                <div class="mt-3">
                    <label class="form-label">備考（任意）</label>
                    <textarea name="memo" class="form-control" rows="2" placeholder="場所や対戦相手など自由記述OK"></textarea>
                </div>
            </form>
        </div>
    </div>

    {{-- 📋 既存スケジュール一覧 --}}
    <div class="card shadow-sm">
        <div class="card-header fw-bold bg-light">
            📋 登録済みスケジュール一覧
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 140px;">日付</th>
                        <th style="width: 140px;">時間</th>
                        <th>タイトル</th>
                        <th>備考</th>
                        <th style="width: 80px;" class="text-center">削除</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($schedules as $schedule)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($schedule->date)->locale('ja')->isoFormat('YYYY/MM/DD（ddd）') }}</td>
                            <td>
                                @if ($schedule->start_time && $schedule->end_time)
                                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                    〜
                                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                @else
                                    ―
                                @endif
                            </td>
                            <td>{{ $schedule->title }}</td>
                            <td class="small text-muted">{{ $schedule->memo }}</td>
                            <td class="text-center">
                                <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('削除しますか？')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                まだスケジュールが登録されていません
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
