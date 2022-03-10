<?php

namespace App\Http\Livewire;

use App\Models\Offer;
use Livewire\Component;
use Livewire\WithPagination;

class SmartPostsIndex extends Component
{
    use WithPagination;

    public $search = '';
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
 
    public function render()
    {
        $offers = Offer::where('subject', 'like', "%$this->search%")
                    ->orWhere('resources', 'like', "%$this->search%")
                    ->paginate(12);
        return view('livewire.smart-posts-index', [
            'modelName' => 'offer',
            'models' => $offers,
        ]);
    }
}
