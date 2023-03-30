<?php

namespace Middlewares;

use Src\Request;

class IsroleidtwoMiddleware
{
    public function handle(Request $request)
    {
        if (app()->auth->user()->role_id != 2) {
            app()->route->redirect('/login');
        }
    }
}