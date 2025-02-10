<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TeamsPermission
{
    /**
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $teamId = session('team_id');
            if ($teamId) {
                setPermissionsTeamId($teamId);
            } else {
                $team = auth()->user()->teams()->first();
                if ($team) {
                    setPermissionsTeamId($team->id);
                    session(['team_id' => $team->id]);
                } else {
                    // Handle the case where the user has no team
                    // Example: Redirect to create team page
                    // return redirect('/create-team');
                    // Or throw an exception
                    throw new \Exception('User has no team');
                }
            }
        }
        return $next($request);
    }
}
