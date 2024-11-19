<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddApiKeyToRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->shouldExcludeRoute($request)) {
            $apiKey = config('services.bind_rest_api.api_key');

            $request->headers->set('X-API-Key', $apiKey);
            $request->headers->set('Accept', "application/json");
        }

        return $next($request);
    }

    protected function shouldExcludeRoute($request)
    {
        // Vérifiez si une route est actuellement résolue
        if (!$request->route()) {
            return true; // Exclure par défaut si aucune route n'est résolue
        }

        // Liste des noms de route que vous souhaitez exclure
        $excludedRoutes = [
            'login',
            'logout',
            'home',
            'link',
            'dns'
        ];

        return in_array($request->route()->getName(), $excludedRoutes);
    }
}
