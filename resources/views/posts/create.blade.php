{{--@extends('layouts.app')--}}

{{--@section('title', 'Create the post')--}}

{{--@section('content')--}}
{{--<form action="{{ route('posts.store') }}" method="POST">--}}
{{--    @csrf--}}
{{--    @include('posts.partials.form')--}}
{{--    <div><input type="submit" value="Create" class="btn btn-primary btn-block"></div>--}}
{{--</form>--}}
{{--@endsection--}}

@extends('layouts.app')

@section('title', 'Create the post')

@section('content')
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf

        @include('posts._form')

        <button type="submit" class="btn btn-primary btn-block">Create!</button>
    </form>


@endsection


{{--
@extends('layouts.app')

@section('title', 'Create the post')

@section('content')
    <form action="{{  route('posts.store') }}" method="POST" >
        @csrf

        <div><input type="text" name="title" value="{{ old('title') }}"></div>
        @error('title')
        <div> {{ $message }}</div>
        @enderror
        <div><textarea name="content" >{{ old('content') }}</textarea></div>

        @if($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{  $error  }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div><input type="submit" value="Create"></div>

    </form>

@endsection
--}}
