<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Result;
use Gate;
use DB;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Route;
class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        if(Auth::user()->lesson_type == "Шинэ жолоочийн сургалт"){
            $questions = Question::where('type', "Шинэ жолоочийн сургалт")->get()->random(20);
      
        }
        else{
            $questions = Question::where('type', "Ангилал ахиулах сургалт")->get()->random(10);
        }
        return view('Test/test')->with('questions', $questions);
    }

    public function indexsub()
    {
        if(Auth::user()->lesson_type == "Шинэ жолоочийн сургалт"){
            $questions = Question::where('type', "Шинэ жолоочийн сургалт")->get();
            $subs = DB::table('questions')
            ->where('type', "Шинэ жолоочийн сургалт")
             ->select('sub')
             ->groupBy('sub')
             ->get();
        }
        else{
            $questions = Question::where('type', "Ангилал ахиулах сургалт")->get();
            $subs = DB::table('questions')
            ->where('type', "Ангилал ахиулах сургалт")
             ->select('sub')
             ->groupBy('sub')
             ->get();
        }
        

       
        $data = [
            'questions'  => $questions,
            'subs' => $subs
        ];
        
        return view('layouts/subtest')->with($data);
    }

    public function showsub($request)
    {
        if(Auth::user()->lesson_type == "Шинэ жолоочийн сургалт"){
            $questions = Question::where('type', "Шинэ жолоочийн сургалт")->where('sub', $request)->get();
            $subs = DB::table('questions')
            ->where('type', "Шинэ жолоочийн сургалт")
             ->select('sub')
             ->groupBy('sub')
             ->get();
        }
        else{
            $questions = Question::where('type', "Ангилал ахиулах сургалт")->where('sub', $request)->get();
            $subs = DB::table('questions')
            ->where('type', "Ангилал ахиулах сургалт")
             ->select('sub')
             ->groupBy('sub')
             ->get();
        }
    
        

       
        $data = [
            'questions'  => $questions,
            'subs' => $subs
        ];

        return view('Test/subtests/show')->with($data);
    }

    public function check(Request $request)
    {

        if(Auth::user()->lesson_type == "Шинэ жолоочийн сургалт"){
            $questions = Question::where('type', "Шинэ жолоочийн сургалт")->where('sub', $request)->get();
            $subs = DB::table('questions')
            ->where('type', "Шинэ жолоочийн сургалт")
             ->select('sub')
             ->groupBy('sub')
             ->get();
        }
        else{
            $questions = Question::where('type', "Ангилал ахиулах сургалт")->where('sub', $request)->get();
            $subs = DB::table('questions')
            ->where('type', "Ангилал ахиулах сургалт")
             ->select('sub')
             ->groupBy('sub')
             ->get();
        }

        

       
        

        $date_end = Carbon::now();
        $point = 0;
        $ques = [];
        $answers = [];
        $length = count($request->responses);
        
        for($i = 0; $i < $length; $i++)
        {
            $ques[$i] = ($request['responses'][$i][' question_id ']);
            $answers[$i] = ($request['responses'][$i][' answer_id ']);
        }
       

        $qes = Question::whereIn('id', $ques)->get();

        for($i = 0; $i < $length; $i++)
        {
            if($qes[$i]['answer'] == $answers[$i])
            {
                $point++;
            }
        }

        $questions = Question::find($ques);
        
        $data = [
            'questions'  => $questions,
            'point'   => $point,
            'answers' => $answers,
            'date_start' => $request['date_start']
        ];

        if(Route::currentRouteName() == 'test.exam.check')
        {
            
        
            $result = Result::create([
                'user_id' =>  Auth::user()->id,
                'point' => $point,  
                'start_time' => $request['date_start'],
                'end_time' => $date_end,
            ]);

            return view('Test/result')->with($data);
        }

        $data1 = [
            'questions'  => $questions,
            'subs' => $subs,
            'point' => $point,  
            'answers' => $answers,
        ];
        return view('Test/subtests/subtest_result')->with($data1);
        
    }

    public function result(Request $request)
    {
        
        return redirect('/home');
    }
}
 