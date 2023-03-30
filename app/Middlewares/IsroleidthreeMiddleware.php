<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class IsroleidthreeMiddleware
{
    public function handle(Request $request)
    {
        if (app()->auth->user()->role_id != 3) {
            app()->route->redirect('/login');
        }
    }
}



