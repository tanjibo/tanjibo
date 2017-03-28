<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @property integer $id
 * @property string $name 分类名称
 * @property integer $hot 分类热度
 * @property string $image 分类图片
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereHot($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    //
    public function posts(){
        return $this->hasMany(Post::class);
    }


}
