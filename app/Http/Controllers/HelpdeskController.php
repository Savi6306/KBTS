<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KbArticle;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class HelpdeskController extends Controller
{
    // 🔹 1. AI Chatbot Backend
 public function ask(Request $req)
{
    $q = strtolower($req->message);

    // 🔍 Deep KB Search (Improved Search)
    $foundKB = KbArticle::select('title','slug','content')
        ->whereRaw("LOWER(title) LIKE ?", ["%$q%"])
        ->orWhereRaw("LOWER(content) LIKE ?", ["%$q%"])
        ->orderByRaw("
            CASE 
                WHEN LOWER(title) LIKE ? THEN 1
                WHEN LOWER(content) LIKE ? THEN 2
                ELSE 3
            END
        ", ["%$q%", "%$q%"])
        ->first();

    if ($foundKB) {
        return response()->json([
            'reply' => 
                "Here's what I found:\n\n" .
                "📘 *" . $foundKB->title . "*\n\n" .
                substr(strip_tags($foundKB->content), 0, 200) . "..." . "\n\n" .
                "👉 Read full article: " . route('user.kb.show', $foundKB->slug)
        ]);
    }

    // 🎟 Ticket Search
    if (Auth::check()) {
        $myTicket = Ticket::where('user_id', Auth::id())
            ->where('subject', 'LIKE', "%$q%")
            ->first();

        if ($myTicket) {
            return response()->json([
                'reply' => "Your ticket status is: *{$myTicket->status}*"
            ]);
        }
    }

    // ❌ Default reply
    return response()->json([
        'reply' => "Sorry, I couldn't find anything related to your question."
    ]);
}

    // 🔹 2. FAQ — Load from DB
    public function faqs()
    {
        $faqs = KbArticle::select('title', 'slug')
                ->orderBy('views','DESC')
                ->limit(10)
                ->get();

        return response()->json($faqs);
    }

    // 🔹 3. KB Search
    public function searchKB(Request $req)
    {
        $q = $req->q;

        $results = KbArticle::where('title','LIKE',"%$q%")
                            ->orWhere('content','LIKE',"%$q%")
                            ->limit(20)
                            ->get();

        return response()->json($results);
    }
}
