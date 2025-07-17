@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 fw-bold">👤 プロフィール編集</h1>

    <div class="mb-5">
        <div class="card shadow-sm">
            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>
    </div>

    <div class="mb-5">
        <div class="card shadow-sm">
            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>

    <div class="mb-5">
        <div class="card shadow-sm border-danger">
            <div class="card-body">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
