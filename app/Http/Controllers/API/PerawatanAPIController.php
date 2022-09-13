<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;

class PerawatanAPIController extends Controller
{
    public function confirmPerawatan($historyId)
    {
        $history = History::where('id', $historyId)->first();

        if ($history->status == 1) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'message' => 'Perawatan already confirmed'
            ]);
        }

        if ($history == null) {
            return response()->json([
                'success' => false,
                'code' => 404,
                'message' => 'History not found'
            ]);
        }

        $history->status = 1;
        if ($history->save()) {
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Success confirm perawatan'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'code' => 400,
                'message' => 'Failed confirm perawatan'
            ]);
        }
    }
}
