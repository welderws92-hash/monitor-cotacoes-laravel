<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Contracts\View\View;

class AssetController extends Controller
{
    public function index(): View
    {
        $assets = Asset::orderBy('type')
            ->orderBy('name')
            ->get();

        return view('assets.index', compact('assets'));
    }
}
