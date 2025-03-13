<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    public function manage(User $currentUser, Video $video): bool
    {

        $teamId = session('team_id');
        return $currentUser->hasPermissionTo('manage videos', $teamId);
    }

}
