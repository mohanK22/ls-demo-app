<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Post');
        foreach (range(1,20) as $index) {
	        DB::table('posts')->insert([
	            'title' => $faker->sentence,
	            'body' => implode($faker->paragraphs(5)),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
	        ]);
	    }
    }
}
