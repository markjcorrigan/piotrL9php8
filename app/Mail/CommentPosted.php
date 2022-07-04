<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\MOdels\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CommentPosted extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Commented was posted on your {$this->comment->commentable->title} blog post";
//        return $this
//            ->attach(storage_path('app/') . $this->comment->user->image->path,
//                [
//                    'as' => 'profile_picture.png',
//                    'mime' => 'image/png'
//               ]
//            )
                $path = $this->comment->user->image->path;
return $this
    ///////I am not getting the images to show up in the email ... But they are attached?
//    ->attachData(
//    Storage::get($path),
//    'profile_picture.'.File::extension($path),
//    [
//        'mime' => Storage::mimetype($path)
//    ])
//             ->attachFromStorage($this->comment->user->image->path, 'profile_picture.png')
//             ->attachFromStorageDisk('public', $this->comment->user->image->path)  //multiple disks
//             ->attachData(Storage::get($this->comment->user->image->path), 'profile_picture_from_data.png', [
//                 'mime' => 'image/png'
//             ])
//http://127.0.0.1:8000/storage/avatars/RYSCqkGrDDK2NBOdtEWyI9PktsPjs8L6P8zbwddo.png  //works as a link in browser

            ->subject($subject)
            ->view('emails.posts.commented');
    }
}
