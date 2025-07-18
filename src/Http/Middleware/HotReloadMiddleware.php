<?php

namespace dedsec\LaravelHotReload\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HotReloadMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (method_exists($response, 'getContent') &&
            strpos($response->headers->get('Content-Type'), 'text/html') !== false) {
            $content = $response->getContent();
            $injectScript = '<script src="' . asset('dedsec/laravel-hot-reload/hot-reload.js') . '"></script></body>';
            $content = str_replace('</body>', $injectScript, $content);
            $response->setContent($content);
        }

        return $response;
    }
}
