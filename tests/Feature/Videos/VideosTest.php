<?php

namespace Tests\Feature\Videos;

use App\Helpers\VideoHelpers;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if users can view existing videos.
     */
    #[test] public function test_users_can_view_videos()
    {
        //Crear un vídeo
        $video = VideoHelpers::createDefaultVideo();

        //Fer una sol·licitud GET a la URL
        $response = $this->get(url('/videos/' . $video->id));

        //Comprovar que la resposta és exitosa
        $response->assertStatus(200);

        //Comprovar que el títol del vídeo és visible a la resposta
        $response->assertSee($video->title);
    }

    /**
     * Prova si els usuaris no poden veure vídeos inexistents.
     */
    #[test] public function test_users_cannot_view_not_existing_videos()
    {
        //Fer una sol·licitud GET a una URL de vídeo inexistent
        $response = $this->get(url('/videos/999'));

        //Comprovar que la resposta és un 404 no trobat
        $response->assertStatus(404);
    }
}

