<section>
    <header>
        <h2 class="text-lg fw-bold text-dark">
            プロフィール情報
        </h2>

        <p class="mt-1 text-muted small">
            あなたの名前やメールアドレスなどの基本情報を更新できます。
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">名前</label>
            <input id="name" name="name" type="text" class="form-control"
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input id="email" name="email" type="email" class="form-control"
                   value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-2 small">
                    メールアドレスが未確認です。
                    <button form="send-verification" class="btn btn-link btn-sm p-0 align-baseline">
                        確認メールを再送信する
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <div class="text-success mt-1">
                            確認リンクを送信しました。
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">保存する</button>

            @if (session('status') === 'profile-updated')
                <span class="text-success small">保存しました</span>
            @endif
        </div>
    </form>
</section>
