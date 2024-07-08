<?php

namespace App\Http\Services;

use App\Helpers\Helper;
use Exception;
use Illuminate\Support\Facades\File;

class CsvService
{

    public function CreateCsv($name,$contents) {
        $headers = $contents->mapWithKeys(function (array $item, int $key) {
            return array_keys($item);
        })->toArray();

        $path = config('constant.csvpath');
        if(!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $file = fopen($path.$name, 'w');
        fputcsv($file, $headers);

        foreach ($contents as $data) {
            fputcsv($file, $data);
        }

        fclose($file);
        return true;
    }

    public function getCsvContent($csv) {
        $helper = new Helper();
        $headers = [];
        $csvData = collect();
        $fileContents = file($csv->getPathname());
        if(is_array($fileContents) && count($fileContents) > 1 ) {
            foreach($fileContents as $key => $values) {
                $values = explode(',',$values);
                $csvRecords = [];
                if($key == 0 ) {
                    foreach($values as $header) {
                        $headers[] = $helper->removeWhiteSpaces($header);
                    }
                }
                else {
                    foreach($values as $key => $data) {
                        $csvRecords[$headers[$key]] = $helper->removeWhiteSpaces($data);
                    }
                    $csvData = $csvData->push($csvRecords)->sortBy('age');
                }
            }
        }
        else {
            throw new Exception('Empty Csv File!');
        }
        return $csvData->values();
    }

}
