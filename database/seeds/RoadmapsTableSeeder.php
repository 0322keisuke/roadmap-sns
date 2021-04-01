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

        $titles = ['Webページを作ろう', 'Webアプリケーションを形にしよう', 'みんなでアプリケーションを開発しよう'];
        $bodys = ['簡単なオリジナルのWebページの開発をローカル環境で行い、インターネット上に公開するまでを学びます。
        ', '会員制サイトや商品検索ページなどの機能を持つWebアプリケーションを開発するスキルを身に付けましょう', 'チーム開発ではお互いの得意なことで助け合ったり、より大規模な開発に挑戦できたりなど、1人では体験できないことがたくさんあります。チームで開発するために必要なスキルを確認しましょう。'];
        $counter = 0;

        foreach ($titles as $title) {
            DB::table('roadmaps')->insert([
                'title' => $title,
                'body' => $bodys[$counter],
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
