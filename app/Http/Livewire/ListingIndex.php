<?php

namespace App\Http\Livewire;

use App\Models\Listing;
use Livewire\Component;
use Livewire\WithPagination;

class ListingIndex extends Component
{
    use WithPagination;

    /**
     * The search query
     * @var string
     */
    public string $search = '';
    
    /**
     * The active filters
     * @var array
     */
    public array $filters = [];

    /**
     * Reset the pagination position when search is updated
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Reset the pagination position when filters are updated
     */
    public function updatingFilters()
    {
        $this->resetPage();
    }


    /**
     * Return the view with the filtered models.
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $query = Listing::where('subject', 'like', "%$this->search%");

        if ($this->filters['exclude_religious_providers'] ?? false) {
            $query->whereNull('metadata->is_religious');
        }

         
            

        $listings = $query->paginate(12);
            
        return view('listing.listing-index', [
            'listings' => $listings
        ]);
    }
}