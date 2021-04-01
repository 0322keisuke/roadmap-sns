<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //親テーブルから先に作成するよう、実行順番に注意する。
        $this->call(UsersTableSeeder::class);
        $this->call(RoadmapsTableSeeder::class);
        $this->call(RoadmapTutorialsTableSeeder::class);
        $this->call(RoadmapTutorialTasksTableSeeder::class);
        $this->call(TutorialsTableSeeder::class);
        $this->call(TasksTableSeeder::class);
    }
}
