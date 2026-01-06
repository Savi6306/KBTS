@extends('admin.layout')

@section('title','Profile')

@section('content')

<style>
.profile-card {
    background: #fff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.08);
}

.avatar-box {
    text-align: center;
    margin-bottom: 25px;
}

.avatar-box img {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    border: 4px solid #fff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    object-fit: cover;
}

.label-text {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 13px;
    color: #0d6efd;
}

.save-btn {
    background:#0d6efd;
    color: white;
    padding: 8px 30px;
    border-radius: 8px;
    font-weight: 600;
}
.save-btn:hover {
    opacity: .9;
}
</style>

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary"
       style="background:#0d6efd; border:none; padding:10px 20px; border-radius:8px; font-weight:600;">
        ← Back to Dashboard
    </a>
</div>

<div class="profile-card">

    <h3 class="fw-bold mb-3">Admin Profile</h3>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- AVATAR --}}
    <div class="avatar-box">
        <img src="{{ $admin->avatar ? asset('uploads/admin/'.$admin->avatar) :
            'https://ui-avatars.com/api/?name='.urlencode($admin->name).'&background=0b0f19&color=fff' }}">
        
        <div class="mt-2 text-muted">Profile Image</div>
    </div>

    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">

            {{-- Name --}}
            <div class="col-md-6">
                <label class="label-text">Full Name</label>
                <input type="text" name="name" class="form-control"
                       value="{{ $admin->name }}" required>
            </div>

            {{-- Email --}}
            <div class="col-md-6">
                <label class="label-text">Email Address</label>
                <input type="email" name="email" class="form-control"
                       value="{{ $admin->email }}" required>
            </div>

            {{-- Password --}}
            <div class="col-md-6">
                <label class="label-text">New Password (optional)</label>
                <input type="password" name="password" class="form-control"
                       placeholder="Leave blank to keep old password">
            </div>

        </div>

        <button class="save-btn mt-4">Save Changes</button>

    </form>

</div>

@endsection
