<div class="form-group">
    <label>Title</label>
    <input type="text" name="title" class="form-control"
           value="{{ old('title', $post->title ?? null) }}"/>
</div>

@error('title')
<div class="alert alert-danger" role="alert">
 {{ $message }}
</div>
@enderror


<div class="form-group">
    <label>Content</label>
    <input type="text" name="content" class="form-control"
           value="{{ old('content', $post->content ?? null) }}"/>
</div>
@error('content')
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@enderror

<div class="form-group">
    <label>Thumbnail</label><br>
    <input type="file" name="thumbnail" class="form-control-file"/>
</div>
<br>

<x-errors></x-errors>





{{--@if($errors->any())--}}
{{--    <div>--}}
{{--        <ul>--}}
{{--            @foreach($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
