<?php

namespace Tests\Unit;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Helpers\VideoHelpers;

class HelpersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_create_default_videos()
    {
        // Call the function that creates the default video
        $video = VideoHelpers::createDefaultVideo();

        // Verify that the video was created correctly
        $this->assertInstanceOf(Video::class, $video);
        $this->assertNotEmpty($video->title);
        $this->assertNotEmpty($video->url);
    }
}


