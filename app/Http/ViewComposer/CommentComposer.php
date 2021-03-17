<?php
namespace App\Http\ViewComposer;
use Illuminate\View\View;
use App\Comment;

class CommentComposer{
    protected $comments;
    public function __construct(Comment $comments)
    {
        $this->comments=$comments;
    }
    public function compose(View $view){
        return $view->with('comments',$this->comments->latest()->limit(5)->get());
    }
}