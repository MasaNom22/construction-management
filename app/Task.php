<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'content', 'due_day', 'status'];
    /**
     * 状態定義
     */
    const STATUS = [
        1 => ['label' => '未着手'],
        2 => ['label' => '着手中'],
        3 => ['label' => '完了'],
    ];

    /**
     * 状態のラベル
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        // 状態値
        $status = $this->attributes['status'];

        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];
    }

    /**
     * 整形した期限日
     * @return string
     */
    public function getFormattedDueDayAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_day'])
            ->format('Y/m/d');
    }
    //Tagと多対多の関係
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tasks_tags');
    }

    public function scopeTaskShow($query, $id) {
        return $query->where('upload_image_id', $id);
    }

    public function scopeSearchKeyword($query, $keyword) {
        return $query->where('title', 'like', '%' . $keyword . '%');
    }
    public function scopeSearchStatus($query, $status) {
        return $query->where('status', $status);
    }
}
