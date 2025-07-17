<section class="mt-5">
    <header>
        <h2 class="text-lg fw-bold text-danger">アカウント削除</h2>
        <p class="text-muted small mt-1">
            アカウントを削除すると、すべてのデータが完全に削除されます。削除する前に必要な情報をダウンロードしてください。
        </p>
    </header>

    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('本当にアカウントを削除しますか？この操作は取り消せません。')">
        @csrf
        @method('delete')

        <div class="mb-3 mt-4">
            <label for="delete_password" class="form-label">確認のためにパスワードを入力してください</label>
            <input id="delete_password" name="password" type="password" class="form-control w-50" placeholder="パスワードを入力">
            @if ($errors->userDeletion->has('password'))
                <div class="text-danger small mt-1">
                    {{ $errors->userDeletion->first('password') }}
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-outline-danger">
            アカウントを削除する
        </button>
    </form>
</section>
