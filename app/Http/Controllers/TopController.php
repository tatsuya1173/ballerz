<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * トップページコントローラー
 */
class TopController extends Controller
{
    public function index()
    {
        $teams = Team::with('prefecture')->latest()->paginate(6);
        return view('top', compact('teams'));
    }
}   