@extends('agent.layout')

@section('title', 'Profile')

@section('content')

<style>
/* =====================================
   CLEAN & PROFESSIONAL PROFILE DESIGN
===================================== */

.profile-wrapper {
    max-width: 900px;
    margin: auto;
}

.profile-header {
    background: #ffffff;
    padding: 25px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    gap: 20px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.06);
}

.profile-header .avatar {
    width: 95px;
    height: 95px;
    border-radius: 50%;
    border: 3px solid #e3e6f0;
    object-fit: cover;
}

.profile-header h3 {
    margin: 0;
    font-size: 24px;
    font-weight: 700;
    color: #334155;
}

.profile-header small {
    color: #6b7280;
    font-size: 14px;
}

.section-card {
    background: #ffffff;
    padding: 25px;
    border-radius: 14px;
    margin-top: 25px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.05);
}

.section-title {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 18px;
    color: #1e3a8a;
}

.form-label {
    font-weight: 600;
    color: #475569;
}

.save-btn {
    background:#0d6efd; /* Main purple */
    color: white;
    padding: 10px 28px;
    border-radius: 8px;
    font-weight: 600;
    border: none;
    transition: 0.3s ease;
    box-shadow: 0 4px 10px rgba(142, 68, 173, 0.3);
}

.save-btn:hover {
    background: #732d91; /* Darker purple */
    box-shadow: 0 6px 14px rgba(142, 68, 173, 0.45);
}

</style>

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('agent.dashboard') }}" class="btn btn-primary" 
       style="background:primary; border:none; padding:10px 20px; border-radius:8px; font-weight:600;">
        ← Back to Dashboard
    </a>
</div>
<div class="profile-wrapper">

    {{-- TOP PROFILE CARD --}}
    <div class="profile-header">

        <img src="{{ $agent->profile_image 
            ? asset('uploads/agents/'.$agent->profile_image)
            : 'https://ui-avatars.com/api/?name='.urlencode($agent->name).'&size=100' }}"
            class="avatar">

        <div>
            <h3>{{ $agent->name }}</h3>
            <small>{{ $agent->email }}</small>
        </div>

    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success mt-3 shadow-sm">{{ session('success') }}</div>
    @endif


    {{-- PERSONAL DETAILS --}}
    <div class="section-card">
        <div class="section-title">Personal Information</div>

        <form method="POST" enctype="multipart/form-data" action="{{ route('agent.profile.update') }}">
            @csrf

            <div class="row g-4">

                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $agent->name) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email', $agent->email) }}">
                </div>

                

</div>

            <div class="mt-4">
                <button class="save-btn">Save Changes</button>
            </div>
        </form>

    </div>


    {{-- PASSWORD SECTION --}}
    <div class="section-card">
        <div class="section-title">Change Password</div>

        <form method="POST" action="{{ route('agent.profile.update') }}">
            @csrf

            <div class="row g-4">

                <div class="col-md-6">
                    <label class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control"
                           placeholder="Enter new password">
                </div>

            </div>

            <div class="mt-4">
                <button class="save-btn">Update Password</button>
            </div>
        </form>

    </div>

</div>

@endsection
