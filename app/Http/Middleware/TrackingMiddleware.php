<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class TrackingMiddleware
{
    public function handle($request, Closure $next)
    {
        $startTime = microtime(true);

        $response = $next($request);

        $year = now()->year;
        $month = now()->format('F');
        $logPath = storage_path('logs/api/' . $year . '/' . $month . '.log');

        $endTime = microtime(true);
        $executionTimeMicroseconds = ($endTime - $startTime);
        $executionTimeSeconds = $executionTimeMicroseconds / 1000000;
        $trackingData = [
            'request' => [
                'method' => $request->method(),
                'url' => $request->url(),
                'parameters' => $request->all(),
            ],
            'response' => [
                'content' => $response->getContent(),
                'status_code' => $response->status(),
            ],
            'execution_time' => $executionTimeSeconds . ' s',
        ];

        Log::channel('api')->info('API Request and Response:', $trackingData);

        if (!file_exists(dirname($logPath))) {
            mkdir(dirname($logPath), 0755, true);
        }

        $logMessage = json_encode($trackingData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . PHP_EOL;

        file_put_contents($logPath, logger($logMessage), FILE_APPEND);
        return $response;
    }
}
