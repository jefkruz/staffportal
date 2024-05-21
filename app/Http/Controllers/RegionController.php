<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    //
    public function index()
    {
        $data['page_title'] = 'Regions';
        $data['regions_menu'] = true;
        $data['regions'] = Region::all();
        return view('backend.regions.index', $data);
    }
}
