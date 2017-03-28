<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' =>  $faker->name ,
        'hot' =>  $faker->randomNumber() ,
        'image' =>  $faker->imageUrl(200,200) ,
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'post_id' =>  $faker->randomNumber() ,
        'parent_id' =>  $faker->randomNumber() ,
        'parent_name' =>  $faker->word ,
        'username' =>  $faker->userName ,
        'email' =>  $faker->safeEmail ,
        'blog' =>  $faker->word ,
        'content' =>  $faker->text ,
        'posts_id' =>  function () {
             return factory(App\Post::class)->create()->id;
        } ,
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    $arr=App\Category::pluck('id')->toArray();
    return [
        'category_id' =>$faker->randomElement($arr),
        'title' =>  $faker->word ,
        'slug' =>  $faker->word ,
        'summary' =>  $faker->word ,
        'content' =>  $faker->text ,
        'origin' =>  $faker->text ,
        'comment_count' =>  $faker->randomNumber() ,
        'view_count' =>  $faker->randomNumber() ,
        'favorite_count' =>  $faker->randomNumber() ,
        'published' =>  $faker->boolean ,
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' =>  $faker->name ,
        'hot' =>  $faker->randomNumber() ,
    ];
});

$factory->define(App\Models\Admin::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

