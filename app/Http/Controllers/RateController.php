<?php

namespace App\Http\Controllers;

use App\Models\Regions;
use App\Models\Cities;
use App\Models\Rates;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function fetchRates()
        {
            $regions = Regions::with('cities.rates')->get(); //cities and rates - table names
            return response()->json($regions);
        }
    public function fetchRegion($id)
        {
            $region = Regions::with('cities.rates')->find($id);
            return response()->json($region);
        }
    
    public function createRates(Request $request)
        {
            $validated = $request->validate([
                'region' => 'required|string',
                'cities' => 'required|array',
                'cities.*.city' => 'required|string',
                'cities.*.rate' => 'required|integer',
            ]);

            // Create the region
            $region = Regions::create(['region' => $validated['region']]); // 'region' column is required here 

            // Loop through each city and create it along with its rate
            foreach ($validated['cities'] as $cityData) {
                $city = $region->cities()->create(['city' => $cityData['city']]); //cities() function name in Regions model
                $city->rates()->create(['rate' => $cityData['rate']]); //rates() function name in Cities model
            }

            // Load and return the created region with its cities and rates
            return response()->json($region->load('cities.rates'), 201);
        }

}
