<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoadmapTutorialTasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ロードマップ１のタスク
        $tutorial_id = 1;
        $names = ['HTMLに触れてみよう', 'CSSに触れてみよう', 'ボックスモデルを学ぼう'];

        foreach ($names as $name) {
            DB::table('roadmap_tutorial_tasks')->insert([
                'name' => $name,
                'tutorial_id' => $tutorial_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $tutorial_id++;
        $names = ['Visual Studio Codeをインストールしよう', 'コードを自動保存できるよう設定にしよう', 'ファイルパスを補完できるようにしよう'];

        foreach ($names as $name) {
            DB::table('roadmap_tutorial_tasks')->insert([
                'name' => $name,
                'tutorial_id' => $tutorial_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }


        $tutorial_id++;
        $names = [
            'クライアントとサーバーについて学ぼう',
            'URLの役割について学ぼう',
            'リクエストとレスポンスの流れを掴もう',
            'IPアドレスについて学ぼう',
            'URLとIPアドレスの関係とDNSを理解しよう'
        ];

        foreach ($names as $name) {
            DB::table('roadmap_tutorial_tasks')->insert([
                'name' => $name,
                'tutorial_id' => $tutorial_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }


        //ロードマップ２のタスク
        $tutorial_id++;
        $names = [
            '変数を使ってみよう',
            '条件分岐をしてみよう',
            '繰り返し処理を作ってみよう',
        ];

        foreach ($names as $name) {
            DB::table('roadmap_tutorial_tasks')->insert([
                'name' => $name,
                'tutorial_id' => $tutorial_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }


        $tutorial_id++;
        $names = [
            'クラスを作ってみよう',
            'インスタンスと初期化について学ぼう',
            'インスタンス変数を作ってみよう',
        ];

        foreach ($names as $name) {
            DB::table('roadmap_tutorial_tasks')->insert([
                'name' => $name,
                'tutorial_id' => $tutorial_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $tutorial_id++;
        $names = [
            'ターミナルに触れてみよう',
            'ファイル構造を理解しよう',
            'ファイル・ディレクトリを操作しよう',
        ];

        foreach ($names as $name) {
            DB::table('roadmap_tutorial_tasks')->insert([
                'name' => $name,
                'tutorial_id' => $tutorial_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        //ロードマップ３のタスク
        $tutorial_id++;
        $names = [
            'アジャイル開発の目的について知ろう',
            'アジャイルな計画作りについて知ろう',
            'イテレーションの進め方について知ろう',
        ];

        foreach ($names as $name) {
            DB::table('roadmap_tutorial_tasks')->insert([
                'name' => $name,
                'tutorial_id' => $tutorial_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }


        $tutorial_id++;
        $names = [
            'Webページに必要な要素や機能を決めよう',
            'Webページの構成を決めよう',
            '各ページのレイアウトを決めよう',
            'Figmaを使って画面遷移図を作ってみよう',
        ];

        foreach ($names as $name) {
            DB::table('roadmap_tutorial_tasks')->insert([
                'name' => $name,
                'tutorial_id' => $tutorial_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }


        $tutorial_id++;
        $names = [
            'ファイルを共有してみよう',
            '変更履歴を把握しよう',
            'Gitのセットアップをしよう',
        ];

        foreach ($names as $name) {
            DB::table('roadmap_tutorial_tasks')->insert([
                'name' => $name,
                'tutorial_id' => $tutorial_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
