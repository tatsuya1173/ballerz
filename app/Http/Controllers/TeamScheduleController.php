<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamScheduleController extends Controller
{
    // スケジュール一覧＋追加フォーム
    public function index(Team $team)
    {
        if ($team->user_id !== Auth::id()) {
            abort(403, 'このチームを編集する権限がありません');
        }

        $schedules = $team->schedules()->orderBy('date')->get();

        return view('teams.schedules.index', compact('team', 'schedules'));
    }

    // スケジュール登録処理
    public function store(Request $request, Team $team)
    {
        if ($team->user_id !== Auth::id()) {
            abort(403, 'このチームを編集する権限がありません');
        }

        $request->validate([
            'date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after_or_equal:start_time',
            'title' => 'required|string|max:255',
            'memo' => 'nullable|string|max:1000',
        ]);

        $team->schedules()->create($request->only('date', 'start_time', 'end_time', 'title', 'memo'));

        return redirect()->route('teams.schedules.index', $team->id)->with('message', 'スケジュールを追加しました');
    }

    // 削除処理
    public function destroy(TeamSchedule $schedule)
    {
        if ($schedule->team->user_id !== Auth::id()) {
            abort(403, 'このスケジュールを削除する権限がありません');
        }

        $schedule->delete();
        return back()->with('message', 'スケジュールを削除しました');
    }
}

