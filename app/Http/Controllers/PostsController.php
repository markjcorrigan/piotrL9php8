<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\User;
use App\Http\Requests\StorePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use App\Models\Image;



class PostsController extends Controller
{
//    private $posts = [
//        1 => [
//            'title' => 'Intro to Laravel',
//            'content' => 'This is a short intro to Laravel',
//            'is_new' => true,
//            'has_comments' => true
//        ],
//        2 => [
//            'title' => 'Intro to PHP',
//            'content' => 'This is a short intro to PHP',
//            'is_new' => false
//        ],
//        3 => [
//            'title' => 'Intro to Golang',
//            'content' => 'This is a short intro to Golang',
//            'is_new' => false
//        ]
//    ];



    public function __construct()
    {
        $this->middleware('auth')
            ->only(['create', 'store', 'edit', 'update', 'destroy']);


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view(

            'posts.index',

            [

                'posts' =>    BlogPost::latestWithRelations()->get(),

            ]

        );
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        // $this->authorize('posts.create');
        return view('posts.create');
    }
//    public function create()
//    {
////        $this->authorize('posts.create');  //Lecture 137 10:27
//        $this->authorize($post);
//        return view('posts.create');
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = $request->user()->id;
        $blogPost = BlogPost::create($validatedData);

//        $hasFile = $request->hasFile('thumbnail');
//        dump($hasFile);

//        if ($hasFile) {
//            $file = $request->file('thumbnail');
//            dump($file);
//            dump($file->getClientMimeType());
//            dump($file->getClientOriginalExtension());
//
//            dump($file->store('thumbails'));  //this is a shortcut to use below line
//            dump(Storage::disk('public')->putFile('thumbails', $file));
//
//            $name1 = $file->storeAs('public/images', $blogPost->id . '.'. $file->guessExtension());
//            $name2 = Storage::disk('local')->putFileAs('public/images', $file, $blogPost->id . '.' . $file->guessExtension());
//
//            //dump(Storage::url($name1));
//
//            dump(Storage::url($name1));
//            dump(Storage::disk('local')->URL($name2));
//
//        }
//        die;

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('public/thumbnail');
            $blogPost->image()->save(
                Image::make(['path' => $path])
                ////NB this url works on local http://127.0.0.1:8000/storage/thumbnail/TMiCDEHSMyUJm4y6xFMlLeUfCBWpCSKxbK2v0qSC.png
            );
        }
        $request->session()->flash('status', 'Blog post was created!');

        return redirect()->route('posts.show', ['post' => $blogPost->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        // return view('posts.show', [
        //     'post' => BlogPost::with(['comments' => function ($query) {
        //         return $query->latest();
        //     }])->findOrFail($id),
        // ]);



//        $blogPost = Cache::remember("blog-post-{$id}", 60, function() use($id) {
//            return BlogPost::with('comments')->findOrFail($id);
//        });
        $blogPost = Cache::tags(['blog-post'])->remember("blog-post-{$id}", 60, function() use($id) {

            return BlogPost::with('comments', 'tags', 'user', 'comments.user')
//                ->with('tags')
//                ->with('user')
//                ->with('comments.user')  //nested relationship
                ->findOrFail($id);

        });

        $sessionId = session()->getId();  //session function helper helps us get the session id.
        $counterKey = "blog-post-{$id}-counter";  //cache key  - unique key name
        $usersKey = "blog-post-{$id}-users";  //cache key  -  fetch and store info about users that visited the page.

        $users = Cache::get($usersKey, []);  // we will read directly from the cache the usersKey
        $usersUpdate = [];  //  empty array.  Install all the users that need to stay on the list.  not expired.
        $diffrence = 0;  // use this variable to update the list of people
        $now = now();  // we will store current time - new instance of the carbon object

        foreach ($users as $session => $lastVisit) {  // iterate over the users
            if ($now->diffInMinutes($lastVisit) >= 1) {  // if diff from now and last minute is = > 1 minute we will decrease diff var
                $diffrence--;
            } else {
                $usersUpdate[$session] = $lastVisit;  // or we will add to the userUpdate
            }
        }

        if(
            !array_key_exists($sessionId, $users)  // check if current user wasn't on user array
            || $now->diffInMinutes($users[$sessionId]) >= 1
        ) {
            $diffrence++;  // if user was not then fresh user.  Or current user was on the list but he was removed.
        }

        $usersUpdate[$sessionId] = $now;
        Cache::forever($usersKey, $usersUpdate);

        if (!Cache::has($counterKey)) {
            Cache::forever($counterKey, 1);
        } else {
            Cache::increment($counterKey, $diffrence);
        }

        $counter = Cache::get($counterKey);

        return view('posts.show', [
            'post' => $blogPost,
            'counter' => $counter,
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

//        if (Gate::denies('update-post', $post )) {
//            abort(403, "You cannot edit another's post");
//        }

//        $this->authorize('posts-update', $post);
        $this->authorize($post);


        return view('posts.edit', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(StorePost $request, $id)
    {

        $post = BlogPost::findOrFail($id);
        //    if(Gate::denies('update-post',$post)){
        //        abort(403,"You can't edit this blog post");
        //    }
        //$this->authorize('update-post',$post);
//        $this->authorize('update', $post);
//        $this->authorize('posts.update', $post);
        $this->authorize($post);

        $validated = $request->validated();

        $post->fill($validated);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('public/thumbnail');

            if ($post->image) {
                Storage::delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();
            } else {
                $post->image()->save(
                    Image::make(['path' => $path])
                );
            }
        }
        $post->save();

        $request->session()->flash('status','Blog Post was Updated');
        return redirect()->route("posts.show",['post'=>$post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        // if (Gate::denies('delete-post', $post)) {
        //     abort(403, "You can't delete this blog post!");
        // }
        $this->authorize($post);

        $post->delete();

        // BlogPost::destroy($id);

        $request->session()->flash('status', 'Blog post was deleted!');

        return redirect()->route('posts.index');
    }
}
