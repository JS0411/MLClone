<?php

namespace App\Http\Controllers;

use App\Purchase;
use Illuminate\Http\Request;

class PurchaseMessageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function show(Request $request){
        $data = $request->validate([
            'purchase_id' => ['required', 'integer', 'min: 1'],
        ]);
        $messages = Purchase::findOrFail($data['purchase_id'])->purchaseMessages()->get();
        if ($messages->first() != null){
            $this->authorize('view',$messages->first());
        }
        return ($messages);
    }

    public function store(Request $request){
        $data = $request->validate([
            'purchase_id' => ['required', 'integer', 'min: 1'],
            'message' => ['required', 'string', 'min: 1'],
            'mode' => ['required', 'string', 'in:seller,buyer'],
        ]);

        return  (Purchase::find($data['purchase_id'])->purchaseMessages()->create([
            'message' => $data['message'],
            'sender' => $data['mode'],
        ]));
    }
}
