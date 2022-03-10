<?php

namespace App\Http\Livewire;

use App\Models\Listing;
use Livewire\Component;
use Livewire\WithPagination;

class ListingIndex extends Component
{
    use WithPagination;

    public $search = '';
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $listings = Listing::where('subject', 'like', "%$this->search%")
            ->orWhere('resources', 'like', "%$this->search%")
            ->paginate(12);
        return view('listing.listing-index', [
            'listings' => $listings
        ]);
    }
}