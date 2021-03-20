<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoadmapsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->where('email', 'guest@guest.com')->first();

        $titles = ['Webサイトの仕組みを知る', 'Webアプリケーションの公開', 'チームでのアプリケーション開発'];
        $counter = 0;

        foreach ($titles as $title) {
            DB::table('roadmaps')->insert([
                'title' => $title,
                'body' => "本文",
                'user_id' => $user->id,
                'estimated_time' => $counter + 10,
                'level' => $counter + 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $counter++;
        }
    }
}
