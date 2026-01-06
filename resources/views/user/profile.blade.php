@extends('user.layout')

@section('title', 'Profile')

@section('content')

<style>
    .profile-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0px 6px 20px rgba(0,0,0,0.08);
    }

    .avatar-box {
        text-align: center;
    }

    .avatar-img {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;

    border: 4px solid #8e44ad; /* Purple ring */
    padding: 3px;

    box-shadow: 0 6px 15px rgba(142, 68, 173, 0.4); /* Purple glow */
    transition: 0.3s ease;
    margin-bottom: 12px;
}

.avatar-img:hover {
    transform: scale(1.06);
    box-shadow: 0 8px 20px rgba(142, 68, 173, 0.55);
}


    .profile-label {
        font-size: 14px;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 4px;
    }

    .profile-value {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
    }

    .profile-row {
        margin-bottom: 20px;
    }
</style>
{{-- PAGE HEADING --}}
<div class="mb-4">
    <h2 class="fw-bold">My Profile</h2>
    <p class="text-muted">Manage your account details</p>
</div>

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('user.dashboard') }}" class="btn btn-primary" 
       style="background:primary ; border:none; padding:10px 20px; border-radius:8px; font-weight:600;">
        ← Back to Dashboard
    </a>
</div>

{{-- PROFILE CARD --}}
<div class="profile-card">

    <div class="row">

        {{-- LEFT SIDE AVATAR --}}
        <div class="col-md-4 avatar-box">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0d6efd&color=fff&size=120"
                 class="avatar-img">

            <h4 class="fw-bold">{{ Auth::user()->name }}</h4>
            <span class="badge bg-primary text-white">{{ ucfirst(Auth::user()->role) }}</span>
        </div>


        {{-- RIGHT SIDE DETAILS --}}
        <div class="col-md-8">

            <div class="profile-row">
                <div class="profile-label">Full Name</div>
                <div class="profile-value">{{ Auth::user()->name }}</div>
            </div>

            <div class="profile-row">
                <div class="profile-label">Email Address</div>
                <div class="profile-value">{{ Auth::user()->email }}</div>
            </div>

            <div class="profile-row">
                <div class="profile-label">User Role</div>
                <div class="profile-value">{{ ucfirst(Auth::user()->role) }}</div>
            </div>

            <div class="profile-row">
                <div class="profile-label">Member Since</div>
                <div class="profile-value">{{ Auth::user()->created_at->format('d M, Y') }}</div>
            </div>

        </div>

    </div>

</div>

@endsection
