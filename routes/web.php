<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::get('/hot-reload-stream', function () {
    return response()->stream(function () {
        $lastModified = now()->timestamp;

        while (true) {
            clearstatcache();

            $pathsToWatch = [
                resource_path('views'),
                app_path('Http/Livewire'),
            ];

            $latestMtime = $lastModified;

            foreach ($pathsToWatch as $path) {
                if (!is_dir($path)) continue;
                $files = File::allFiles($path);
                foreach ($files as $file) {
                    $mtime = $file->getMTime();
                    if ($mtime > $latestMtime) {
                        $latestMtime = $mtime;
                    }
                }
            }

            if ($latestMtime > $lastModified) {
                echo "data: reload\n\n";
                ob_flush();
                flush();
                $lastModified = $latestMtime;
            }

            usleep(200000);
        }
    }, 200, [
        'Content-Type' => 'text/event-stream',
        'Cache-Control' => 'no-cache',
        'Connection' => 'keep-alive',
    ]);
});
