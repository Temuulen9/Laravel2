<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\withPagination;
use Auth;
class UserSearch extends Component
{

    use WithPagination;

    public $perPage = 10;
    public $searchname = '';
    public $searchlastname = '';
    public $searchreg = '';
    public $searchtype = '';

    public function render()
    {
        if(Auth::user()->role == "owner")
        {
            $users = User::search($this->searchname, $this->searchlastname, $this->searchreg, $this->searchtype)
            ->simplePaginate($this->perPage);
        }
        else
        {
            $users = User::search_with_branch(Auth::user()->branch,$this->searchname, $this->searchlastname, $this->searchreg, $this->searchtype)
           ->simplePaginate($this->perPage);
        }
 

        return view('livewire.user-search', [
            'users' => $users,
        ]);
    }
}
