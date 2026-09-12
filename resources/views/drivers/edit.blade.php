@extends('layouts.app')

@section('title', 'Edit Driver')

@section('content-class', 'page-dashboard')

@section('content')
    <section class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <h5 class="card-title mb-1">Edit Driver</h5>
                <p class="text-muted small mb-0">Update this driver's profile</p>
            </div>
            <a href="{{ route('drivers.index') }}" class="btn btn-danger btn-sm"><i class="bi bi-chevron-left me-1"></i>Cancel</a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('drivers.update', $driver) }}">
                @csrf
                @method('PUT')

                @include('drivers._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update Driver</button>
                </div>
            </form>
        </div>
    </section>
@endsection
