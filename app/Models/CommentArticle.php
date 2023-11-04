<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class CommentArticle extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'user_id',
        'article_id',
        'comment',
        'total_likes',
    ];

    protected $append = [
        'is_mine', 'is_like'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function logLike()
    {
        return $this->morphOne(LogLike::class, 'item');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Uuid::generate(4);
        });
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
}
