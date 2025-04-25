<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Str;

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
     * Cached Data
     *
     */
    protected function cachedData()
    {
        return Cache::remember('data', 180, function () {
            return $this->fetchData();
        });
    }

    /**
     * Search data
     */
    public function search(Request $request)
    {
        $data = $this->cachedData();
        $keyword = $request->input('q');

        return $data->filter(function ($item) use ($keyword) {
            return Str::contains(Str::lower($item['NAMA']), Str::lower($keyword)) || Str::contains(Str::lower($item['NIM']), Str::lower($keyword)) || Str::contains(Str::lower($item['YMD']), Str::lower($keyword));
        })
            ->values();
    }

    /**
     * Search data by NAMA
     *
     */
    public function searchByName(Request $request)
    {
        $data = $this->cachedData();
        $keyword = $request->input('q');

        return $data->where('NAMA', $keyword)->values();
    }

    /**
     * Search data by NIM
     *
     */
    public function searchByNim(Request $request)
    {
        $data = $this->cachedData();
        $keyword = $request->input('q');

        return $data->where('NIM', $keyword)->values();
    }

    /**
     * Search data by YMD
     *
     */
    public function searchByYmd(Request $request)
    {
        $data = $this->cachedData();
        $keyword = $request->input('q');

        return $data->where('YMD', $keyword)->values();
    }
}
