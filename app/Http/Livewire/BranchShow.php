<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use App\Models\User;
use Livewire\Component;
use Livewire\withPagination;

class BranchShow extends Component
{

    use WithPagination;

    public $branch;
    public $perPage = 10;
    public $searchname = '';
    public $searchlastname = '';
    public $searchreg = '';
    public $searchtype = '';
    public function render()
    {
        $users = User::search_with_branch($this->branch->name,$this->searchname, $this->searchlastname, $this->searchreg, $this->searchtype)
        ->simplePaginate($this->perPage);
        
        return view('livewire.branch-show', [
        'users' => $users,
    ]);
    }
}
