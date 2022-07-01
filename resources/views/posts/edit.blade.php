@extends('layouts.app')

@section('title', 'Update the post')

@section('content')
    <form method="POST"
          action="{{ route('posts.update', ['post' => $post->id]) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')



        @include('posts._form')

        <button type="submit" class="btn btn-primary btn-block">Update!</button>
    </form>
@endsection

