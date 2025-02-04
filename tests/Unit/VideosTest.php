<?php

namespace Tests\Unit;

use App\Helpers\VideoHelpers;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to check the formatted published_at date.
     */
    public function test_can_get_formatted_published_at_date()
    {
        //crear video per defecte uant el helper
        $video = VideoHelpers::createDefaultVideo();
        $video->save();

        //formatejar el format usant el model
        $formattedDate = $video->formatted_published_at;

        //comprovar que el format es correcte
        $this->assertEquals('25 of December of 2023', $formattedDate);
    }

    /**
     * Test to check the formatted published_at date when not published.
     */
    public function test_can_get_formatted_published_at_date_when_not_published()
    {
        //crear video per defecte uant el helper
        $video = VideoHelpers::createDefaultVideo();
        $video->published_at = null;
        $video->save();

        //formatejar el format usant el model
        $formattedDate = $video->formatted_published_at;

        //comprovar que la data formatejada esta buida
        $this->assertEquals('', $formattedDate);
    }
}


