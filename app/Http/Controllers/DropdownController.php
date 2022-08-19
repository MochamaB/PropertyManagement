<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;

use App\Models\{Country, State, City};
use App\Models\Housecategories;
use App\Models\house;
use App\Models\Lease;
class DropdownController extends Controller
{
    public function index()
    {
        $data = Housecategories::get(["type", "id"]);
        $rent = House::get(["housenumber", "id"]);
        return view('welcome', compact('data','rent'));
    }
    public function fetchState(Request $request)
    {
        $data['houses'] = house::where("housecategoryID",$request->housecategoryID)->get(["housenumber", "id"]);
        return response()->json($data);
    }
    public function fetchRent(Request $request)
    {
        $data['rent'] = Lease::where("houseID",$request->houseID)->get(["actualrent", "id"]);
        return response()->json($data);
    }

}
