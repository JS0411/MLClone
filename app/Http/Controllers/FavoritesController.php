<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classified;

class FavoritesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index (){
        $favorites = auth()->user()->favorites->map->only(['id', 'name',
            'price', 'images']);
        return view('users.favorites.index', compact('favorites'));
    }

    public function store ($id) {
        $classified = Classified::findOrFail($id);
        return auth()->user()->favorites()->toggle($classified);
    }
}
