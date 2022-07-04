@extends('layouts.app')
@section('title', 'Blog Posts')
@section('content')
    <div class="row">
        <div class="col-8  ">
            <div class="card p-2 ">
                @forelse ($posts as $post)
                    <div class="card mb-4 shadow ">
                        <h3 class="card-header bg-white  ">
                            @if($post->trashed())
                                <del>
                                    @endif
                                    <a class="{{ $post->trashed() ? 'text-muted' : '' }}"
                                       href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>

                                    @if($post->trashed())
                                </del>
                            @endif
                        </h3>

                        <div class="card-body ">




                                <div class="overlay-right d-flex justify-content-left">
                                    @auth
                                    @can('update', $post)
                                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                       class="btn btn-primary">
                                        Edit
                                    </a>
                                @endcan
                                    @endauth

                                {{-- @cannot('delete', $post)
                                    <p>You can't delete this post</p>
                                @endcannot --}}
                                @auth

                                @if(!$post->trashed())
                                    @can('delete', $post)
                                        &nbsp;
                                        <form method="POST" class="fm-inline"
                                              action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Delete!" class="btn btn-primary"/>
                                        </form>
                                    @endcan
                                @endif
                                @endauth
                            </div>

                    </div>


                        <div class="card-footer bg-white text-muted p-2">
                            @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 50)

                               <x-badge :show="true" type="primary">
                                    New post added!
                                </x-badge>

                            @endif
{{--
                                <x-updated :date="$post->created_at" :name="$post->user->name">
                                    @slot( 'userId', $post->user->id )
                                </x-updated>

{{--                            <x-tags :tags="$post->tags" >--}}
{{--                            </x-tags>--}}

                                <x-tags >
                                    @slot('tags', $post->tags )
                                </x-tags>
                                @if($post->comments_count)
                                    <p>{{ $post->comments_count }} comments</p>
                                @else
                                    <p>No comments yet!</p>
                                @endif
                        </div>

                    </div>
                @empty
                    <p>No blog posts yet!</p>
                @endforelse
            </div>
        </div>

        <div class="col-4">


            @include('posts._activity')
         </div>
    </div>
@endsection('content')




