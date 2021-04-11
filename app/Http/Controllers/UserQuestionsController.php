<?php

namespace App\Http\Controllers;

use App\Classified;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class UserQuestionsController extends Controller
{ //Creates a collection with the unanswered user questions for the seller.
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $data = $request->validate([
            'mode' => ['required', 'string', 'in:received,asked'],
        ]);
        $mode = $data['mode'];
        if ($mode == 'received'){
            //If the user wants the questions that he's received
            //We fetch the classifieds that are active with question counts greater than 0.
            $classifieds = (auth()->user()->classifieds()->where([['question_count','>',0],['active',true]]))->get();
            $questions = new Collection();
            foreach ($classifieds as $classified){
                $classifiedQuestions =  $classified->questionsCount(); //This function returns the number of unanswered questions
                if (!is_null($classifiedQuestions)){
                    $questions = $questions->concat($classifiedQuestions);
                }
            }
        } elseif ($mode == 'asked'){
            //If he asks for the questions that he's made
            //We fetch the questions within the user relationship.
            $questions = auth()->user()->questions->pluck('id');
        }
        return view('users.questions.index', compact('questions', 'mode'));
    }
}
