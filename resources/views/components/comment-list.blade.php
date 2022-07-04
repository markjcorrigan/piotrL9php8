<h4>Available Comments:</h4>

@forelse ($comments as $comment)
    <p>
        {{ $comment->content }}
    </p>
{{--    <x-updated date="{{ $comment->created_at }}" name="{{ $comment->user->name }}" userId="{{ $comment->user->id }}">--}}

{{--    </x-updated>--}}

{{--    <x-tags >--}}
{{--        @slot('tags', $comment->tags )--}}
{{--    </x-tags>--}}

        <x-updated date="{{ $comment->created_at }}" name="{{ $comment->user->name }}" userId="{{ $comment->user->id }}">
        </x-updated>


@empty
    <p>No comments yet!</p>
@endforelse
