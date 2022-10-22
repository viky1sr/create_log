<?php

namespace App\Repository;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LogRepository implements LogInterface
{
    public function get(string $url,array $params = [])
    {
        return Storage::get($url);
    }

    public function store(string $url, array $data)
    {
        $data_old = !empty($data[0]) ? $data[0]['data_old'] : [];
        unset($data[0]);
        array_push($data_old,$data);
        Log::channel('backup_log')->info($url,$data);
        return Storage::disk('local')->put($url,json_encode($data_old));
    }
}
