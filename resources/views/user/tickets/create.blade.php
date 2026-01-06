@extends('user.layout')

@section('title', 'Create Ticket')

@section('content')

<style>
    .ticket-card {
        background: #ffffff;
        padding: 25px;
        border-radius: 14px;
        box-shadow: 0 5px 18px rgba(0,0,0,0.08);
    }

    .ticket-title {
        font-size: 24px;
        font-weight: 700;
        color: #23428c;
        margin-bottom: 15px;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 5px;
        color: #244c9c;
    }

    .form-control, .form-select {
        border-radius: 10px;
        height: 48px;
    }

    textarea.form-control {
        height: auto;
        min-height: 130px;
    }

    .submit-btn {
        background: #0d6efd;
        border: none;
        padding: 12px 25px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 10px;
        transition: 0.3s;
    }

    .submit-btn:hover {
        background: #004bca;
    }
</style>


<div class="ticket-card">

    <div class="ticket-title">Create New Ticket</div>
    <p class="text-muted mb-4">Fill in the details and our support team will assist you shortly.</p>

    <form method="POST" action="{{ route('user.tickets.store') }}">
        @csrf

        {{-- Subject --}}
        <div class="mb-3">
            <label class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control" required>
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
 {{-- Category --}}
    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select" required>
            <option value="">Select Category</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

        {{-- Priority --}}
        <div class="mb-3">
            <label class="form-label">Priority</label>
            <select name="priority" class="form-select">
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
                <option value="Critical">Critical</option>
            </select>
        </div>

        
    <button type="submit"
            class="submit-btn mt-2"
            onclick="this.disabled=true; this.innerText='Submitting...'; this.form.submit();">
        Submit Ticket
    </button>
    </form>

</div>

@endsection
