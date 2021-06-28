@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        @if ($post->category)
            <h3>Category: {{$post->category->name}}</h3>
        @endif
        
        <div class="mb-5">
            <a href="{{route('admin.posts.edit', $post->id)}}">Edit post</a>
        </div>
        <div>{{ $post->content }}</div>
        <div>
            @if (count($post->tags)>0)
                @foreach($post->tags as $tag)
                    <span class="badge badge-primary">{{$tag->name}}</span>
                @endforeach
            @endif
        </div>
    </div>
@endsection