<?php

namespace App\Services;

use App\Repository\LogInterface;
use App\Repository\LogRepository;
use Carbon\Carbon;

class LogService implements LogInterface
{
    private LogRepository $logRepo;
    private Carbon $date;

    public function __construct(
        LogRepository $logRepo,
        Carbon $date
    ){
        $this->logRepo = $logRepo;
        $this->date = $date;
    }

    public function get(string $url,array $params)
    {
        $getYMd = getDateYMd($this->date::parse($params['date']));
        $isDate = $this->date::parse($params['date'])->format('Y-m-d');
        $isPath = $url.'/'.$getYMd['year'].'/'.$getYMd['month'].'/'.$getYMd['day'].'/'.$isDate.'.log';
        $data =  $this->logRepo->get($isPath,$params);
        $decode = json_decode($data);
        return collect($decode)->map(function($item) use($params){
            if(isset($params['nomor_aplikasi']) && isset($params['nomor_rekening']) ){
                if($params['nomor_aplikasi'] == $item->data->nomor_aplikasi && $params['nomor_rekening'] == $item->data->nomor_rekening){
                    return $item;
                }
            } else {
                if( isset($params['nomor_aplikasi']) && $params['nomor_aplikasi'] == $item->data->nomor_aplikasi){
                    return $item;
                }
                if( isset($params['nomor_rekening']) && $params['nomor_rekening'] == $item->data->nomor_rekening){
                    return $item;
                }
            }
        })->reject(function ($item) {
            return empty($item);
        });
    }

    public function store(string $url, array $data)
    {
        $dateNow = $this->date::now()->format('Y-m-d');
        $getYMd = getDateYMd($dateNow);
        $isPath = $url.'/'.$getYMd['year'].'/'.$getYMd['month'].'/'.$getYMd['day'].'/'.$dateNow.'.log';
        $checkData = json_decode($this->logRepo->get($isPath));
        if($checkData != null){
            array_push($data,['data_old' => $checkData]);
        }
        return $this->logRepo->store($isPath,$data);
    }
}
