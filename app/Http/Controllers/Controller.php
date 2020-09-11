<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /*
     * this does the thing, but why it does the thing nobody knows
     */
    public function myOtherMysteryMethod(array $metrics): array
    {
        foreach ($metrics as &$element) {
            $element += random_int(1, 150);
        }

        return $metrics;
    }
}
