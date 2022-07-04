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
{{--                                <div class="fit-bg"  style="background-image: url('{{ $post->image->url() }}');  min-height: 700px; color: white; text-align: center; background-image:fixed; " >--}}
                                    <div class="fit-bg"  style="background-image: url('{{ $post->image->url() }}');  min-height: 700px; color: white; text-align: center; background-image:fixed; " >
                                    <h1 style="padding-top: 20px; text-shadow: 1px 2px #000; background: rgba(0, 0, 0, 0.1)">
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
                        <br><x-badge :show="true" type="primary">
                            New post added!
                        </x-badge>
                        <br>

                <x-updated :date="$post->created_at" :name="$post->user->name"></x-updated>

                <x-updated :date="$post->updated_at" :name="$post->user->name">Post Updated</x-updated>



                <p class="text-muted">Currently read by {{ $counter }} people </p>
                <hr>
                        <h4>Tags:</h4>
                <x-tags :tags="$post->tags" >
                </x-tags>
                <hr>
                <h4>Add Comments:</h4>
                        <x-commentForm :route=" route('posts.comments.store', ['post' => $post->id]) ">
                        </x-commentForm>

                        <x-commentList :comments=" $post->comments ">
                        </x-commentList>




            </div>
            </div>
        </div>
    </div>

    <div class="col-4">
            @include('posts._activity')
        </div>
    </div>
@endsection('content')
