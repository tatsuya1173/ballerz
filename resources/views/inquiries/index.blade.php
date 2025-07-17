@extends('layouts.app')

@section('title', 'お問い合わせ一覧')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">📨 お問い合わせ一覧</h1>

    @if ($inquiries->isEmpty())
        <div class="alert alert-info shadow-sm rounded">
            お問い合わせはまだありません。
        </div>
    @else
        <div class="card shadow-sm rounded mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>チームID</th>
                                <th>名前</th>
                                <th>メール</th>
                                <th>メッセージ</th>
                                <th>ステータス</th>
                                <th>作成日</th>
                                <th>更新日</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inquiries as $inquiry)
                                <tr>
                                    <td>{{ $inquiry->id }}</td>
                                    <td>{{ $inquiry->team_id }}</td>
                                    <td>{{ $inquiry->name }}</td>
                                    <td>
                                        <a href="mailto:{{ $inquiry->email }}" class="text-decoration-none">
                                            <i class="bi bi-envelope"></i> {{ $inquiry->email }}
                                        </a>
                                    </td>
                                    <td>{{ Str::limit($inquiry->message, 50) }}</td>
                                    <td>
                                        <form action="{{ route('inquiries.toggleStatus', $inquiry->id) }}" method="POST" onsubmit="return confirm('ステータスを変更しますか？')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm border-0 p-0 bg-transparent">
                                                @if ($inquiry->status === '未対応')
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="bi bi-exclamation-circle"></i> 未対応
                                                    </span>
                                                @else
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle"></i> 対応済み
                                                    </span>
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                    <td>{{ $inquiry->created_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ $inquiry->updated_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            {{ $inquiries->links() }}
        </div>
    @endif
</div>
@endsection
