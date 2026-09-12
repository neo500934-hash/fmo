@extends('layouts.app')

@section('title', 'Edit User')

@section('content-class', 'page-dashboard')

@section('content')
    <section class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <h5 class="card-title mb-1">Edit User</h5>
                <p class="text-muted small mb-0">Update this user's account</p>
            </div>
            <a href="{{ route('users.index') }}" class="btn btn-danger btn-sm"><i class="bi bi-chevron-left me-1"></i>Cancel</a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PUT')

                @include('users._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </section>
@endsection
