@extends('user.layout')

@section('title', $article->title)

@section('content')

<style>
    .kb-article-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 5px 18px rgba(0,0,0,0.08);
    }

    .kb-article-title {
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 10px;
        color: #23428c;
    }

    .related-box {
        margin-top: 30px;
        padding: 20px;
        border-radius: 10px;
        background: #f1f4ff;
    }
</style>

@include('chatbot.widget')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('user.kb.index') }}" 
       class="btn btn-primary px-4 fw-bold">
        ← Back to Knowledge Base
    </a>
</div>
<div class="kb-article-card">

    <div class="kb-article-title">{{ $article->title }}</div>

    <div class="text-muted mb-3">
        Updated: {{ $article->updated_at->format('d M, Y') }}
    </div>

    <div class="content">{!! $article->content !!}</div>


    <hr>

    {{-- HELPFUL? --}}
    <p class="fw-bold mb-1">Was this article helpful?</p>

    <button class="btn btn-success btn-sm me-2" onclick="rateArticle({{ $article->id }}, 'like')">
        👍 Yes
    </button>

    <button class="btn btn-danger btn-sm" onclick="rateArticle({{ $article->id }}, 'dislike')">
        👎 No
    </button>

    <p class="text-muted mt-2" id="ratingMessage"></p>


    {{-- RELATED ARTICLES --}}
    <div class="related-box mt-4">
        <h5 class="fw-bold mb-2">Related Articles</h5>

        @foreach($related as $rel)
            <a class="d-block mb-1" href="{{ route('user.kb.show', $rel->slug) }}">
                → {{ $rel->title }}
            </a>
        @endforeach
    </div>
</div>


<script>
    function rateArticle(id, type) {
        fetch("{{ url('/user/kb/rate') }}/" + id, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ type: type })
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('ratingMessage').innerHTML =
                `Thanks for your feedback! 👍 (${data.likes} likes, ${data.dislikes} dislikes)`;
        });
    }
</script>

@endsection
