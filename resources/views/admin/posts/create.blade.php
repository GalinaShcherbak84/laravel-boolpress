@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Create new post</h1>
        
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
                <form action="{{route('admin.posts.store')}}" method="post">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="title" class="form-label">Title*</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror " name="title" 
                        id="title" value="{{old('title')}}">
                        @error('title')
                            <h4 class="mt-3">{{$message}}</h4>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content*</label>
                        <textarea name="content" id="content"  rows="6" class="form-control @error('content') is-invalid @enderror">{{old('content')}}</textarea>
                        @error('content')
                            <h4 class="mt-3">{{$message}}</h4>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category*</label>
                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            <option value="">-- Select category --</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}"
                                    @if ($category->id == old('category_id'))
                                        selected
                                    @endif>
                                    {{$category->name}} 
                                </option>
                            @endforeach
                        </select>
                        @error('content')
                            <h4 class="mt-3">{{$message}}</h4>
                        @enderror
                    </div>

                    <h4>TAGS</h4>
                    <div class="mb-3">
                        @foreach ($tags as $tag)
                            <span class="d-inline-block mr-3">
                                <input type="checkbox" name="tags[]" id="tag{{$loop->iteration}}" value="{{$tag->id}}"
                                @if (in_array($tag->id, old('tags',[])))
                                    checked
                                @endif >
                                <label for="tag{{$loop->iteration}}">
                                    {{$tag->name}}
                                </label>
                            </span>
                        @endforeach
                        @error('tags')
                            <h4 class="mt-3">{{$message}}</h4>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create post</button>
                </form>
            </div>
        </div>
    </div>
@endsection