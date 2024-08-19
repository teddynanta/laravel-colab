<?php

namespace App\Http\Controllers;

use App\Models\ApiData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        // $bearerToken = 'c0aea50c9b00c32180221fff071048cd'; // Replace with your actual token
        // $apiUrl = 'https://sipd.go.id/ewalidata/serv/get_dssd?kodepemda={1637}'; // Replace with your API endpoint

        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $bearerToken
        // ])->get($apiUrl, [
        //     'page' => $request->query('page', 1),
        //     'per_page' => 20
        // ]);

        // $data = $response->json();

        // // Optional: Store data in the model for further processing
        // // ApiData::create($data);

        // return view('api_data', compact('data'));

        $apiUrl = 'https://sipd.go.id/ewalidata/serv/get_dssd?kodepemda={1637}';
        $perPage = 20; // Adjust as needed
        $bearerToken = 'c0aea50c9b00c32180221fff071048cd'; // Replace with your actual token

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $bearerToken
        ])->get($apiUrl);

        $data = $response->json(); // Assuming data is in a 'data' key
        $currentPage = $request->query('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $items = array_slice($data, $offset, $perPage);

        $paginatedData = new LengthAwarePaginator(
            $items,
            count($data),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('api_data', compact('paginatedData'));
        // return response()->json([
        //     'data' => $paginatedData->items(),
        //     'links' => [
        //         'first' => $paginatedData->url(1),
        //         'last' => $paginatedData->url($paginatedData->lastPage()),
        //         'prev' => $paginatedData->previousPageUrl(),
        //         'next' => $paginatedData->nextPageUrl(),
        //     ],
        //     'meta' => [
        //         'current_page' => $paginatedData->currentPage(),
        //         'per_page' => $paginatedData->perPage(),
        //         'total' => $paginatedData->total(),
        //         'last_page' => $paginatedData->lastPage(),
        //     ]
        // ]);
    }
}
