<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use Intervention\Image\Facades\Image;
use DB;

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    function index()
    {
       
        $questions =  Question::all();
        
         return view('admin.questions.index')->with('questions', $questions);
    }

    function create()
    {
        $questions =  Question::all();
        $subs = Question::select('sub')
             ->groupBy('sub')
             ->get();
             
             
        return view('admin.questions.create')->with('subs', $subs);
    }
    function store(Request $request)
    {
        
       
        $data = request()->validate([
            'sub' => ['required'],
            'image' => ['image'],
            'answer' => ['required']
        ]);
        $imagepath = null;
        if($request->image != null)
        {
            $imagepath = $request->file('image')->store('uploads', 'public');
        }
        
      
        
        $question = Question::create([
            'type' => $request['question_type'],
            'sub' => $request['sub'],
            'question' => $request['question'],
            'image' => $imagepath,
            'option1' => $request['option1'],
            'option2' => $request['option2'],
            'option3' => $request['option3'],
            'option4' => $request['option4'],
            'option5' => $request['option5'],
            'answer' => $request['answer']
        ]);

        return redirect()->route('admin.questions.index');
    }

    public function edit(Question $question)
    {

        return view('admin.questions.edit')->with([
            'question'=> $question,
        ]);
    }

    public function update(Request $request, Question $question)
    {
        $imagepath = null;
        if($request->image != null)
        {
            $imagepath = $request->file('image')->store('uploads', 'public');
        }
        $question->sub = $request->sub;
        $question->question = $request->question;
        $question->image = $imagepath;
        $question->option1 = $request->option1;
        $question->option2 = $request->option2;
        $question->option3 = $request->option3;
        $question->option4 = $request->option4;
        $question->option5 = $request->option5;
        $question->answer = $request->answer;

        if($question->save())
        {
            $request->session()->flash('success', 'Асуултын мэдээлэл шинэчлэгдлээ.');
        }
        else
        {
            $request->session()->flash('error', 'Асуулт шинэчлэхэд алдаа гарлаа.');
        }

        return redirect()->route('admin.questions.index');
    }

    function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('admin.questions.index');
    }
}
