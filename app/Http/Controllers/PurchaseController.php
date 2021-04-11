<?php

namespace App\Http\Controllers;

use App\Classified;
use App\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $data = $request->validate([
            'item' => ['required', 'string', 'in:sold,bought'],
        ]);
        $mode = $data['item'];
        //The following code segment is unused in favor of algolia's instantsearch, can be reimplemented if need be.
        /*$purchases = null;
        if ($mode == 'sold'){
            $purchases = $request->user()->sellerProfile->sales;
        } elseif ($mode == 'bought'){
            $purchases = $request->user()->buyerProfile->purchases;
        }*/

        return view('classifieds.purchase.index', compact('mode'));
    }

    public function create(Request $request){
        $data = $request->validate([
            'classified_id' => ['required', 'integer', 'min: 1'],
        ]);
        $classified = Classified::findOrFail($data['classified_id']);
        $this->authorize('create', Purchase::class);
        return view('classifieds.purchase.create', compact('classified'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'classified_id' => ['required', 'integer', 'min: 1'],
        ]);
        $classified = Classified::findOrFail($data['classified_id']);
        $purchase = $request->user()->buyerProfile->purchases()->create([
           'classified_id' => $classified->id,
           'image' => $classified->images[0]['URI'],
           'name' => $classified->name,
           'price' => $classified->price,
        ]);
        $classified->sellerProfile->sales()->attach($purchase);
        $purchase->searchable();
        $classified->flipActive();
        return ([($classified->sellerProfile->user)->
          only(['name','surname','state', 'address']), $purchase->id]);
    }

    public function show(Request $request, $id){
        $data = $request->validate([
            'mode' => ['required', 'string', 'in:sold,bought'],
        ]);
        $purchase = Purchase::findOrFail($id);
        $this->authorize('view', $purchase);
        $mode = $data['mode'];
        $partnerInfo = null;
        if ($mode == 'bought') {
            $partnerInfo =  $purchase->sellerProfiles()->first()->user;
        } elseif ($mode == 'sold') {
            $partnerInfo = $purchase->buyerProfiles()->first()->user;
        }
        return view('classifieds.purchase.show', compact('purchase', 'mode', 'partnerInfo'));
    }
}
