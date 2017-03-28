<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Post
 *
 * @property integer $id
 * @property integer $category_id 外键
 * @property string $title 标题
 * @property string $slug 锚点
 * @property string $summary 概要
 * @property string $content 内容
 * @property string $origin 来源
 * @property integer $comment_count 评论次数
 * @property integer $view_count 浏览次数
 * @property integer $favorite_count 点赞次数
 * @property boolean $published 文章是否发布
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereSummary($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereOrigin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereCommentCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereViewCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereFavoriteCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post wherePublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
