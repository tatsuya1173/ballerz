<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    public function store(Request $request, $teamId)
    {
        $request->validate([
            'name'    => 'required|string|max:50',
            'email'   => 'required|email|max:100',
            'message' => 'required|string|max:1000',
        ]);

        // チームが存在するか確認（念のため）
        $team = Team::findOrFail($teamId);

        Inquiry::create([
            'team_id' => $team->id,
            'name'    => $request->input('name'),
            'email'   => $request->input('email'),
            'message' => $request->input('message'),
        ]);

        return redirect()
            ->route('teams.show', $teamId)
            ->with('message', 'お問い合わせを送信しました。チームからの返信をお待ちください。');
    }

    public function index()
    {
        $user = Auth::user();

        // ユーザーが管理するチームの ID を取得
        $teamIds = Team::where('user_id', $user->id)->pluck('id');

        // そのチームに属するお問い合わせのみ取得
        $inquiries = Inquiry::with('team')
            ->whereIn('team_id', $teamIds)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('inquiries.index', compact('inquiries'));
    }

    public function toggleStatus(Inquiry $inquiry)
    {
        $user = Auth::user();

        // セキュリティ：そのチームのコーチ以外は変更不可
        if ($inquiry->team->user_id !== $user->id) {
            abort(403, 'この操作は許可されていません');
        }

        // トグル処理
        $inquiry->status = $inquiry->status === '未対応' ? '対応済み' : '未対応';
        $inquiry->save();

        return redirect()->back()->with('status', 'ステータスを更新しました。');
    }
    
}
