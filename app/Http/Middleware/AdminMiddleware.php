<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\get;

class AdminMiddleware
{
    private $users;
    public function __construct(User $users)
    {
        $this->users= $users;
    }

    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check())
          return $next($request);
        dd('usuario não logado');  
    }
}
