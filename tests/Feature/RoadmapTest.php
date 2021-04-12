<?php

namespace Tests\Feature;

use App\Roadmap;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoadmapTest extends TestCase
{
    use RefreshDatabase;

    public function testIsLikedByNull()
    {
        $roadmap = factory(Roadmap::class)->create();

        $result = $roadmap->isLikedBy(null);

        $this->assertFalse($result);
    }

    public function testIsLikedByTheUser()
    {
        $roadmap = factory(Roadmap::class)->create();

        $user = factory(User::class)->create();
        $roadmap->likes()->attach($user);

        $result = $roadmap->isLikedBy($user);

        $this->assertTrue($result);
    }

    public function testIsLikedByAnother()
    {
        $roadmap = factory(Roadmap::class)->create();

        $user = factory(User::class)->create();
        $another = factory(User::class)->create();
        $roadmap->likes()->attach($another);

        $result = $roadmap->isLikedBy($user);

        $this->assertFalse($result);
    }
}
