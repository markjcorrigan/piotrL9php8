@extends('layouts.app')

@section('title', $post['title'])

@section('content')

    <style>
        .fit-bg {

                background-repeat: no-repeat;
                /*background-size: cover;*/
            background-position: center;
            background-size: contain;
            /*background-size:auto;*/
        }
        /*.fixed-bg {*/
        /*    background-image: url("img_tree.gif");*/
        /*    min-height: 500px;*/
        /*    background-attachment: fixed;*/
        /*    background-position: center;*/
        /*    background-repeat: no-repeat;*/
        /*    background-size: cover;*/
        /*}*/
    </style>
    <div class="row">
        <div class="col-8">


            <div class="container">
                <div class="card">
                    <div class="card-body shadow">
                        <a href="/posts"> <img src="{{ asset("/storage/images/go-back.png") }}" class="" img-fluid"
                            style="width: 4%; height: 4%;" title="Back to Posts List"></a>
                        <p>
                            <imgPost ID: {{ $post->id }}
                        </p>
                        <div class="card p-3" >

                            @if($post->image)
                                <div class="fit-bg"  style="background-image: url('{{ $post->image->url() }}');  min-height: 700px; color: white; text-align: center; background-image:fixed; " >
                                    <h1 style="padding-top: 100px; text-shadow: 1px 2px #000">
                                        @else
                                            <h1>
                                                @endif
                                                {{ $post->title }}
                                                {{--                                                <x-badge :show="true" type="primary">--}}
                                                {{--                                                    New post added!--}}
                                                {{--                                                </x-badge>--}}
                                                @if($post->image)
                                            </h1>
                                </div>
                                @else
                                    </h1>
                            @endif
                        </div>
                        <br>
                        <div class="card p-3"><p> {{ $post->content }}</p>





{{--                            <img src="{{ Storage::url($post->image->path) }} "  class="img-fluid" >  NB this works--}}

                        </div>
                        @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 50)



                        @endif
                        <x-badge :show="true" type="primary">
                            New post added!
                        </x-badge>
                        <br>

                <x-updated :date="$post->created_at" :name="$post->user->name"></x-updated>

                <x-updated :date="$post->updated_at" :name="$post->user->name">Post Updated</x-updated>



                <p class="text-muted">Currently read by: {{ $counter }} </p>
                <hr>
                <x-tags :tags="$post->tags" >
                </x-tags>
                <hr>
                <h4>Comments</h4>
                @include('comments._form')
                @forelse($post->comments as $comment)
                    <p>
                        {{ $comment->content }}
                    </p>


                    <x-updated :date="$comment->created_at" :name="$comment->user->name">Comment Updated</x-updated>
                    <p class="text-muted">
                        added {{ $comment->created_at->diffForHumans() }}
                    </p>

                @empty
                    <p>No comments yet!</p>
                @endforelse
            </div>
            </div>
        </div>
    </div>

    <div class="col-4">
            @include('posts._activity')
        </div>
    </div>
@endsection('content')
