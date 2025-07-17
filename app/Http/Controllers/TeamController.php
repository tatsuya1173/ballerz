<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $query = Team::query()->with('images', 'prefecture');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('prefecture_id')) {
            $query->where('prefecture_id', $request->prefecture_id);
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('grade_range')) {
            $query->where('grade_range', $request->grade_range);
        }

        if ($request->filled('practice_days')) {
            $query->whereJsonContains('practice_days', $request->practice_days);
        }

        $teams = $query->paginate(9)->withQueryString();

        return view('teams.index', [
            'teams' => $teams,
            'prefectures' => Prefecture::all(),
            'practice_days' => ['月', '火', '水', '木', '金', '土', '日'],
        ]);
    }


    public function show($id)
    {
        $team = Team::with(['prefecture', 'images'])->findOrFail($id);
        return view('teams.show', compact('team'));
    }

    public function create()
    {
        if (Auth::check()) {
            return view('teams.create');
        } else {
            return redirect()->route('teams.index');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prefecture_id' => 'required|exists:prefectures,id',
            'grade_range' => 'required|string|max:255',
            'practice_days' => 'required|array',
        ]);

        $team = new Team($request->all());
        $team->user_id = Auth::id(); // 所有者をセット
        $team->save();

        return redirect()->route('teams.show', $team->id);
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);

        if ($team->user_id !== Auth::id()) {
            abort(403, 'このチームを編集する権限がありません');
        }

        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        if ($team->user_id !== Auth::id()) {
            abort(403, 'このチームを更新する権限がありません');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'prefecture_id' => 'required|exists:prefectures,id',
            'grade_range' => 'required|string|max:255',
            'practice_days' => 'required|array',
        ]);

        $team->update($request->all());
        return redirect()->route('teams.show', $team->id);
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);

        if ($team->user_id !== Auth::id()) {
            abort(403, 'このチームを削除する権限がありません');
        }

        $team->delete();
        return redirect()->route('teams.index');
    }

    
}