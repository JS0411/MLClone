<?php

namespace App\Http\Controllers;

use App\Question;
use App\Classified;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;


class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    public function index(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'min: 1'],
            'id_setting' => ['required', 'string', 'in:classified,question'],
        ]);

        if ($data['id_setting'] == 'classified'){ //This is received from the Questions component
            return (Classified::findOrFail($data['id'])->questions);
        } elseif ($data['id_setting'] == 'question') { //Whilist this one is received from the replies component
            return (Question::whereIn('id',$data['id'])->get());
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
           'classified_id' => ['required', 'integer', 'min: 1'],
           'buyer_question' => ['required','string', 'min:6'],
        ]);

        Classified::findOrFail($data['classified_id'])->increment('question_count', 1);
        $question = new Question();
        $question->buyer_question = $data['buyer_question'];
        $question->classified_id = $data['classified_id'];
        $question->user()->associate(auth()->user());
        $question->save();

        return $question;
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'seller_reply' => ['required','string', 'min:6'],
        ]);
        $question = Question::findOrFail($id);
        $question->seller_reply = $data['seller_reply'];
        $question->classified()->decrement('question_count',1);
        $question->save();
    }

}
