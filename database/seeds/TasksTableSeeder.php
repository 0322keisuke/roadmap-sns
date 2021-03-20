<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tutorial = DB::table('tutorials')->first();

        $names = ['１章 「n進数」の扱いに慣れる', '２章 ２進数の計算と数値表現', '３章 コンピュータの回路を知る'];

        $counter = 0;

        foreach ($names as $name) {
            DB::table('tasks')->insert([
                'name' => $name,
                'tutorial_id' => $tutorial->id,
                'order' => $counter + 1,
                'status' => $counter + 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $counter++;

            if ($counter == 3) {
                $counter = 0;
            }
        }

        //'HTML/CSS基礎'のタスク作成
        $second_names = ['HTMLに触れてみよう！', 'CSSに触れてみよう！', 'レイアウトを作ろう！'];

        foreach ($second_names as $name) {
            DB::table('tasks')->insert([
                'name' => $name,
                'tutorial_id' => 2,
                'order' => $counter + 1,
                'status' => $counter + 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $counter++;

            if ($counter == 3) {
                $counter = 0;
            }
        }


        //PHP基礎のタスク作成
        $third_names = ['PHPとは？', 'PHPの基礎を学ぼう', '条件分岐'];

        foreach ($third_names as $name) {
            DB::table('tasks')->insert([
                'name' => $name,
                'tutorial_id' => 3,
                'order' => $counter + 1,
                'status' => $counter + 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $counter++;

            if ($counter == 3) {
                $counter = 0;
            }
        }
    }
}
