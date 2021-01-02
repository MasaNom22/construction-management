<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// この行を追加
use Carbon\Carbon;

class Task extends Model
{
     /**
     * 状態定義
     */
    const STATUS = [
        1 => [ 'label' => '未着手' ],
        2 => [ 'label' => '着手中' ],
        3 => [ 'label' => '完了' ],
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
}
