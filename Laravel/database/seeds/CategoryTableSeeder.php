<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
        foreach (range( 1, 10 ) as $key => $value) {
            $data[] = [ 'name' => 'tag' . $faker->randomNumber(),
                'hot'=>$faker->randomNumber(),
                'create_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'update_at'=>\Carbon\Carbon::now()->toDateTimeString()
            ];
        }
    }
}
