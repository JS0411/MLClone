<?php

namespace App\Http\Controllers;

use App\Question;
use App\Classified;
use App\ClassifiedImages;
use Illuminate\Http\Request;

class ArticleInfoController extends Controller
{ //Returns a collection with the requested classifieds's information for the reader
    public function __construct(){
        $this->middleware('auth');
    }

    public function show($id) {
        $classified = Question::findOrFail($id)->Classified;
        return collect([
            'id' => $classified->id,
            'name' => $classified->name,
            'price' => $classified->price,
            'image' => $classified->images[0]['URI'],
        ]);
    }
}
