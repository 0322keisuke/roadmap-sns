<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoadmapTutorialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->where('email', 'guest@guest.com')->first();


        //ロードマップ１の教材作成
        $titles = ['レイアウトを作れるようになろう', '快適にコーディングするために開発環境を整えよう', 'Webの仕組みを知ろう'];

        foreach ($titles as $title) {
            DB::table('roadmap_tutorials')->insert([
                'title' => $title,
                'user_id' => $user->id,
                'roadmap_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }


        //ロードマップ２の教材作成
        $titles = ['サーバーで動くプログラムを作ろう', 'コードを整理し、機能の追加や変更をしやすくしよう', 'コンピュータの操作を効率的にできるようになろう'];


        foreach ($titles as $title) {
            DB::table('roadmap_tutorials')->insert([
                'title' => $title,
                'user_id' => $user->id,
                'roadmap_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }


        //ロードマップ３の教材作成
        $titles = ['実際の開発現場をイメージできるようになろう', 'どんなものをどうやって作るのかを考えよう', 'バージョン管理システムを使ってチームでコードを共有しよう'];


        foreach ($titles as $title) {
            DB::table('roadmap_tutorials')->insert([
                'title' => $title,
                'user_id' => $user->id,
                'roadmap_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
