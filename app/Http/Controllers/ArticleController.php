<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\CommentArticle;
use App\Models\LogLike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $article = Article::with(['category', 'user'])->latest()->get();
        // dd($article);
        return view('article', ['articles' => $article]);
    }

    public function formArticle()
    {
        return view('create_article');
    }

    public function createArticle(Request $request)
    {
        $category = Category::find($request->category);
        $user = Auth::user();

        Article::create([
            'category_id' => $category->id,
            'article' => $request->article,
            'user_id' => $user->id,
            'total_likes' => 0
        ]);

        return redirect()->route('article');
    }

    public function updateArticle(Request $request, Article $article)
    {
        $category = Category::find($request->category);

        $article->category_id = $category->id;
        $article->article = $request->article;
        $article->save();

        return redirect()->route('article');
    }

    public function deleteArticle(Request $request, Article $article)
    {
        $user = Auth::user();

        if ($article->user_id == $user->id) {
            $article->delete();
            CommentArticle::where('article_id', $article->id)->delete();
            LogLike::where('item_id', $article->id)->delete();
        }

        return response()->json([
            'code' => 200,
            'info' => 'Berhasil menghapus Article',
        ]);
    }

    public function editArticle(Request $request, Article $article)
    {
        return view('edit_article', ['article' => $article]);
    }

    public function seeArticle(Request $request, Article $article)
    {
        return view('detail_article', ['article' => $article]);
    }

    public function likeArticle(Request $request, Article $article)
    {
        $user = Auth::user();
        $log = LogLike::where('user_id', $user->id)->where('item_type', 'App\Models\Article')->where('item_id', $article->id)->first();

        if ($log != null) {
            $article->total_likes -= 1;
            $article->save();
            $log->delete();

            return response()->json([
                'code' => 200,
                'info' => 'Berhasil tidak menyukai article.'
            ]);
        }

        $article->total_likes += 1;
        $article->save();

        $log = new LogLike();
        $log->user_id = $user->id;
        $log->item_type = 'App\Models\Article';
        $log->item_id = $article->id;

        $article->logLike()->save($log);

        return response()->json([
            'code' => 200,
            'info' => 'Berhasil menyukai article.'
        ]);
    }

    public function sendComment(Request $request, Article $article)
    {
        $user = Auth::user();
        CommentArticle::create([
            'user_id' => $user->id,
            'article_id' => $article->id,
            'comment' => $request->comment,
            'total_likes' => 0,
        ]);

        return redirect()->back();
    }

    public function likeComment(Request $request, Article $article, CommentArticle $comment)
    {
        $user = Auth::user();
        $log = LogLike::where('user_id', $user->id)->where('item_type', 'App\Models\CommentArticle')->where('item_id', $comment->id)->first();

        if ($log != null) {
            $comment->total_likes -= 1;
            $comment->save();
            $log->delete();

            return response()->json([
                'code' => 200,
                'info' => 'Berhasil tidak menyukai comment.'
            ]);
        }

        $comment->total_likes += 1;
        $comment->save();

        $log = new LogLike();
        $log->user_id = $user->id;
        $log->item_type = 'App\Models\CommentArticle';
        $log->item_id = $comment->id;

        $comment->logLike()->save($log);

        return response()->json([
            'code' => 200,
            'info' => 'Berhasil menyukai article.'
        ]);
    }
}
