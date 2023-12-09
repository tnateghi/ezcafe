<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function lock($seconds, $key = null)
    {
        // this method prevents race condition attack
        // see https://en.wikipedia.org/wiki/Race_condition for more information

        if ($key == null) {
            $key = request()->route()->getName() . '.' . auth()->id() ?? request()->ip();
        }

        $lock = Cache::lock($key, $seconds);

        if (!$lock->get()) {
            throw ValidationException::withMessages([
                'card' => 'please wait ' . $seconds . ' seconds until next request!'
            ]);
        }
    }
}
