<?php

namespace App\Http\Controllers;

use App\Classified;
use App\SellerProfile;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Laravel\Scout\Searchable;

class ClassifiedsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'carouselIndex', 'show', 'searchable');
    }

    public function index(Request $request)
    {
        $data = $request->validate([
            'query' => ['string'],
        ]);
        $query = $data['query'];
        return view('classifieds.index', compact('query'));
    }

    public function carouselIndex()
    {
        return Classified::latest()->take(8)->
        where('active', 1)->get(['id', 'name', 'price', 'images']);
    }

    public function show(Classified $classified)
    {
        $favorited = (auth()->user()) ? auth()->user()->favorites->contains($classified->id) : false;
        return view('classifieds.show', compact('classified', 'favorited'));
    }

    public function create()
    {
        return view ('classifieds.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
           'classified.name' => ['required', 'string', 'max: 130'],
           'classified.description' => ['required', 'string'],
           'classified.price' => ['required', 'integer', 'min: 1'],
           'classified.usage' => ['required', 'string'],
           'classified.category' => ['required', 'string'],
           'images' => ['required', 'array', 'min: 1', 'max: 6'],
           'images.*.URI' => ['required', 'min: 1', 'string'],
        ]);
        //The following line grabs the user's seller profile, since theres only one, and creates through it.
        $classified = auth()->user()->sellerProfile->classifieds()->create([
            'name' => $data['classified']['name'],
            'description' => $data['classified']['description'],
            'price' => $data['classified']['price'],
            'usage' => $data['classified']['usage'],
            'category' => $data['classified']['category'],
            'images' => $data['images'],
        ]);

        return ($classified->id);
    }

    public function edit($id){
        $classified = Classified::findOrFail($id);
        $this->authorize('update', $classified);
        return view('users.classifieds.edit', compact('classified'));
    }

    public function update(Request $request){
        if ($request->mode == 'edit'){ //This mode replaces info in classifieds after user asks for an edit
            $request->validate([
                'classified.id' => ['required', 'integer', 'min: 1'],
                'classified.name' => ['required', 'string', 'max: 130'],
                'classified.description' => ['required', 'string'],
                'classified.price' => ['required', 'integer', 'min: 1'],
                'classified.usage' => ['required', 'string', 'max:5'],
                'classified.category' => ['required', 'string'],
                'classified.images' => ['required', 'array', 'min: 1', 'max: 6'],
                'classified.images.*.URI' => ['required', 'min: 1', 'string'],
            ]);
            $classified = Classified::findOrFail($request->classified['id']);
            $this->authorize('update', $classified);
            $classified->update($request->classified);
        } else { //This mode flips the classified between active and paused
            $request->validate([
                'id' => ['required', 'integer', 'min: 1'],
            ]);
            $classified = Classified::findOrFail($request->id);
            $this->authorize('update', $classified);
            return $classified->flipActive();
        }
    }

    public function destroy($id){
        $request = new Request([
            'id' => $id,
        ]);

        $request->validate([
            'id' => ['required', 'integer', 'min: 1'],
        ]);
        $classified = Classified::findOrFail($request->id);
        $this->authorize('delete', $classified);
        return $classified->delete();
    }

}
