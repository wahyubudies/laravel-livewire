<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class LiveTable extends Component
{    
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $sortField = 'name';
    public $sortAsc = true;
    public $search = '';

    public function sortBy($field)
    {
        if($this->sortField === $field)
            $this->sortAsc = !$this->sortAsc;
        else
            $this->sortAsc = true;
        
        $this->sortField = $field;        
    }
    public function render()
    {
        $users = User::search($this->search)
                        ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                        ->paginate(10);
        return view('livewire.live-table', [ 'users' => $users ]);
    }
}
