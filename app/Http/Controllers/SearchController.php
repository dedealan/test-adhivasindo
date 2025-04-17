<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    protected $url = "https://bit.ly/48ejMhW";

    /**
     * Fetch data from URL
     *
     */
    protected function fetchData()
    {
        $response = Http::withoutVerifying()->get($this->url);
        $rawData = $response->json()['DATA'];

        $rows = explode("\n", trim($rawData));
        $headers = explode('|', array_shift($rows));

        $data = collect($rows)->map(function ($row) use ($headers) {
            $values = explode('|', $row);
            return array_combine($headers, $values);
        });

        return $data;
    }

    /**
     * Search data by NAMA
     *
     */
    public function searchByName(Request $request)
    {
        $data = $this->fetchData();
        $keyword = $request->input('search');

        return $data->where('NAMA', $keyword)->values();
    }

    /**
     * Search data by NIM
     *
     */
    public function searchByNim(Request $request)
    {
        $data = $this->fetchData();
        $keyword = $request->input('search');

        return $data->where('NIM', $keyword)->values();
    }

    /**
     * Search data by YMD
     *
     */
    public function searchByYmd(Request $request)
    {
        $data = $this->fetchData();
        $keyword = $request->input('search');

        return $data->where('YMD', $keyword)->values();
    }
}
