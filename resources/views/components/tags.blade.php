<p class="text-muted" >Tags:<br>

    @foreach ($tags as $tag)

        <a href="{{ route('posts.tags.index', ['tag' => $tag->id]) }}"  class=" badge bg-success badge-lg " >{{ $tag->name }}</a>

    @endforeach

</p>

{{--<p>--}}

{{--    @foreach ($post->tags as $tag)--}}

{{--        <a href="#" class="badge badge-success badge-lg">{{ $tag->name }}</a>--}}

{{--    @endforeach--}}

{{--</p>--}}
