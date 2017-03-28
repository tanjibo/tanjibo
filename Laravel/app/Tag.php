<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Tag
 *
 * @property integer $id
 * @property string $name 标签名称
 * @property integer $hot 标签热度
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereHot($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    public function posts(  )
    {
         return $this->belongsToMany(Post::class)->withTimestamps();
    }
}
