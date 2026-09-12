@extends('layouts.app')

@section('title', 'Dashboard')

@section('content-class', 'page-dashboard')

@section('content')
    <section class="card">
        <div class="card-body text-center py-5">
            <h4 class="mb-2">Welcome back, {{ auth()->user()->name }}</h4>
            <p class="text-muted mb-3">Have a safe trip today.</p>
            <span class="la-badge la-badge-info" id="locationStatus">Location: checking…</span>
        </div>
    </section>

    <form id="autoLogoutForm" method="POST" action="{{ route('logout') }}" class="d-none">
        @csrf
    </form>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusEl = document.getElementById('locationStatus');

            if (!navigator.geolocation) {
                statusEl.textContent = 'Location: not supported';
                return;
            }

            function sendLocation(position) {
                axios.post('{{ route('driver.location.update') }}', {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                }).then(() => {
                    statusEl.textContent = 'Location: sharing';
                }).catch(() => {
                    statusEl.textContent = 'Location: error sending';
                });
            }

            function handleError(error) {
                if (error.code === error.PERMISSION_DENIED) {
                    statusEl.textContent = 'Location: permission denied — signing out…';
                    document.getElementById('autoLogoutForm').submit();
                    return;
                }

                statusEl.textContent = 'Location: unavailable';
            }

            navigator.geolocation.getCurrentPosition(sendLocation, handleError);
            setInterval(() => navigator.geolocation.getCurrentPosition(sendLocation, handleError), 10000);
        });
    </script>
@endpush
