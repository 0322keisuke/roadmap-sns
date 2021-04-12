<?php

namespace Tests\Feature;

use App\Roadmap;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoadmapDatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function testRoadmapDatabase()
    {
        factory(Roadmap::class)->create([
            'title' => 'タイトル',
            'body' => '本文',
            'estimated_time' => 5,
            'level' => '1'
        ]);
        factory(Roadmap::class, 10)->create();

        $this->assertDatabaseHas('roadmaps', [
            'title' => 'タイトル',
            'body' => '本文',
            'estimated_time' => 5,
            'level' => '1'
        ]);
    }
}
