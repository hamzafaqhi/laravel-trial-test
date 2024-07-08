<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\CsvUpload;
use App\Http\Services\CsvService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CsvController extends Controller
{
    public $service;
    public function __construct() {
        $this->service = new CsvService();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CsvUpload $request)
    {
        try {
            $error = false;
            $code = 200;
            $message = 'Csv uploaded Successfully!';
            $helper = new Helper();
            $validated = $request->validated();
            extract($validated);
            $csvData =  $this->service->getCsvContent($csv);
            $name = $csv->getClientOriginalName();
            $this->service->CreateCsv($name,$csvData);
        }
        catch(Exception $e ) {
          $error = true;
          $message = $e->getMessage();
          $code = 400;
          Log::error($e->getMessage());
        }
        return $helper->apiResponse([],$code, $message,$error);

    }

}
