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
        $insertToLog = [
          'request' => $data['request'],
          'response' => $data['response'],
          'data' => $data['data']
        ];
        $insertToStorage = [
            'response' => $data['response'],
            'data' => $data['data'],
            'date_time' => $data['date_time'],
        ];
        $data_old = !empty($data[0]) ? $data[0]['data_old'] : [];
        array_push($data_old,$insertToStorage);
        Log::channel('backup_log')->info($url,$insertToLog);
        return Storage::disk('local')->put($url,json_encode($data_old));
    }
}
