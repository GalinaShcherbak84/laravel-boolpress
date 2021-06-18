@extends('layouts.app')

@section('content')
    <div class="container">
       <h1 class="mb-5"> Edit post: <a href="{{route('admin.posts.show', $post->id)}}">{{$post->title}}</a></h1>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error) 
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul> 
                    </div>
                @endif
                <form action="{{route('admin.posts.update', $post->id)}}" method="post">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="title" class="form-label">Title*</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror " name="title" 
                        id="title" value="{{old('title', $post->title)}}">
                        @error('title')
                            <h4 class="mt-3">{{$message}}</h4>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content*</label>
                        <textarea name="content" id="content"  rows="6" class="form-control @error('content') is-invalid @enderror">{{old('content',$post->content)}}</textarea>
                        @error('content')
                            <h4 class="mt-3">{{$message}}</h4>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Edit post</button>
                </form>
            </div>
        </div>
    </div>
@endsection