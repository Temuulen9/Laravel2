<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Livewire\Component;

class QuestionSearch extends Component
{

    public $perPage = 10;
    public $searchsub = '';
    public $searchtype = '';
    public $searchques = '';
    public function render()
    {
        $questions = Question::search($this->searchtype, $this->searchsub, $this->searchques)->simplePaginate($this->perPage);
        
        return view('livewire.question-search', [
            'questions' => $questions,
        ]);
    }
}
