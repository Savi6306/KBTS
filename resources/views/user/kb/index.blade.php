@extends('user.layout')

@section('title', 'Knowledge Base')

@section('content')

<style>
    .helpdesk-search {
        background: #f5f8ff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        margin-bottom: 25px;
    }

    .helpdesk-search input {
        height: 48px;
        border-radius: 30px;
        padding-left: 50px;
    }

    .helpdesk-icon {
        position: absolute;
        top: 50%;
        left: 18px;
        transform: translateY(-50%);
        font-size: 20px;
        color: #6c757d;
    }

    .kb-category-tabs {
        display: flex;
        gap: 12px;
        overflow-x: auto;
        padding-bottom: 4px;
        margin-bottom: 25px;
    }

    .kb-category-tab {
        padding: 10px 18px;
        background: #eef3ff;
        border-radius: 25px;
        font-weight: 600;
        color: #244c9c;
        cursor: pointer;
        white-space: nowrap;
        transition: 0.3s;
    }

    .kb-category-tab:hover {
        background: #dce6ff;
    }

    .kb-category-tab.active {
        background: #0d6efd;
        color: #fff;
    }

    .kb-item {
        border-radius: 10px;
        margin-bottom: 10px;
        background: #ffffff;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        cursor: pointer;
        transition: 0.2s;
    }

    .kb-item:hover {
        background: #f0f5ff;
    }

    .kb-title {
        padding: 15px;
        font-weight: 600;
        font-size: 18px;
        color: #244c9c;
    }

    .kb-content {
        display: none;
        padding: 15px;
        color: #555;
        border-top: 1px solid #e5e8f0;
        font-size: 15px;
    }

    .popular-title {
        font-size: 20px;
        font-weight: 700;
        margin-top: 10px;
        margin-bottom: 12px;
        color: #23428c;
    }

</style>
<div class="text-end mb-3">
    <a href="{{ route('user.dashboard') }}" class="btn btn-primary px-4">
        ← Back to Dashboard
    </a>
</div>
@include('chatbot.widget')
<h2 class="fw-bold">Helpdesk Knowledge Base</h2>
<p class="text-muted mb-3">Find answers to frequently asked questions</p>

<div class="helpdesk-search position-relative">
    <i class="bi bi-search helpdesk-icon"></i>

    <form method="GET">
        <input type="text" name="q" class="form-control"
            value="{{ $q ?? '' }}" placeholder="Search for answers...">
    </form>
</div>

{{-- CATEGORY TABS --}}
<div class="kb-category-tabs">

    {{-- FIXED --}}
    <a href="{{ route('user.kb.index') }}"
       class="kb-category-tab {{ !$category_id ? 'active' : '' }}">
        All
    </a>

    @foreach($categories as $cat)
        <a href="{{ route('user.kb.index', ['category' => $cat->id]) }}"
            class="kb-category-tab {{ ($category_id == $cat->id) ? 'active' : '' }}">
            {{ $cat->name }}
        </a>
    @endforeach
</div>

<div class="row">

    <div class="col-md-8">

        @forelse($articles as $article)

            <div class="kb-item" onclick="toggleKB({{ $article->id }})">

                <div class="kb-title">
                    {{ $article->title }}
                </div>

                <div class="kb-content" id="kb-{{ $article->id }}">
                    {!! Str::limit(strip_tags($article->content), 600) !!} <br>
                    <a href="{{ route('user.kb.show', $article->slug) }}" 
                    class="text-primary fw-bold mt-2 d-block">
                        Read Full Article →
                    </a>
                </div>

            </div>

        @empty
        <p class="text-muted">No articles found.</p>
        @endforelse

        <div class="mt-3">{{ $articles->withQueryString()->links() }}</div>

    </div>

    <div class="col-md-4">

        <div class="popular-title">Popular Articles</div>

        @foreach($popular as $p)
            <a href="{{ route('user.kb.show', $p->slug) }}" class="d-block mb-2">
                • {{ $p->title }}
            </a>
        @endforeach

    </div>

</div>

@endsection

@section('scripts')
<script>
    function toggleKB(id) {
        let box = document.getElementById("kb-" + id);

        document.querySelectorAll(".kb-content").forEach(content => {
            if (content.id !== "kb-" + id) content.style.display = "none";
        });

        box.style.display = (box.style.display === "block") ? "none" : "block";
    }
</script>
@endsection
