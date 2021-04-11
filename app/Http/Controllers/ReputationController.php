<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\User;
use App\Reputation;
use Illuminate\Http\Request;


class ReputationController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index');
    }

    public function index(Request $request, $id){
        $user = User::findOrFail($id);
        $user = $user->username;
        return view('users.reputation.index', compact('id', 'user'));
    }

    public function create(Request $request, $id) {
        $data = $request->validate([
            'mode' => ['required', 'string', 'in:bought,sold']
        ]);
        $purchase = Purchase::findOrFail($id);
        $this->authorize('create', [Reputation::class,$purchase]);
        $target = $data['mode'];
        return view('users.reputation.create', compact('target', 'purchase'));
    }

    public function store(Request $request) {
        $data = $request->validate([
           'purchase_id' => ['required', 'integer', 'min:1'],
           'target' => ['required', 'string', 'in:Seller,Buyer'],
           'description' => ['required', 'string', 'max: 256'],
           'rating' => ['required', 'string', 'in:Positive,Negative,Neutral']
        ]);

        $purchase = Purchase::findOrFail($data['purchase_id']);
        if ($data['target'] == 'Seller') { //Retrives the target user for the reputation
            $target = $purchase->sellerProfiles->first();
            $purchase->setBuyerFlag($data['rating']);
        } else {
            $target = $purchase->buyerProfiles->first();
            $purchase->setSellerFlag($data['rating']);
        }
        $purchase->save();

        $target->reputations()->create([
           'user_id' => $target->user->id,
           'rating' => $data['rating'],
           'description' => $data['description'],
           'rater_name' => auth()->user()->username,
           'rater_id' => auth()->user()->id,
           'classified_name' => $purchase->name,
           'classified_id' => $purchase->classified_id,
           'image' => $purchase->image,
        ]);

        return redirect()->route('purchase.show', ['id' => $data['purchase_id'] ,'mode' => $data['target'] == 'Seller' ? 'bought' : 'sold']);
    }
}
