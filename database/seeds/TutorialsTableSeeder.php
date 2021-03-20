<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TutorialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->where('email', 'guest@guest.com')->first();

        $titles = ['コンピュータサイエンス基礎', 'HTML/CSS基礎', 'PHP基礎'];
        $counter = 0;

        foreach ($titles as $title) {
            DB::table('tutorials')->insert([
                'title' => $title,
                'user_id' => $user->id,
                'order' => $counter + 1,
                'status' => $counter + 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $counter++;
        }
    }
}
