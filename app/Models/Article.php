<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class Article extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'category_id',
        'user_id',
        'article',
        'total_likes',
    ];

    protected $append = [
        'is_mine', 'is_like'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany(CommentArticle::class, 'article_id')->latest();
    }

    public function logLike()
    {
        return $this->morphMany(LogLike::class, 'item');
    }

    public function getIsMineAttribute()
    {
        $user = Auth::user();
        if ($this->user_id == $user->id) {
            return true;
        }
        return false;
    }

    public function getIsLikeAttribute()
    {
        $logs = $this->logLike()->get();
        $array = [];
        $user = Auth::user();
        // dd($logs);

        foreach ($logs as $log) {
            array_push($array, $log->user_id);
        }

        if (in_array($user->id, $array)) {
            return true;
        }
        return false;
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Uuid::generate(4);
        });
    }
}
