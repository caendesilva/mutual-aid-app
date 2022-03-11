<?php

namespace App\Http\Livewire;

use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListingIndex extends Component
{
    use WithPagination;

    /**
     * The buttons to show in the header
     * @var array
     */
    public array $buttons = ['offer', 'request'];

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
     * Prepare the component
     */
    public function mount()
    {
        // Set the buttons to show in the header
        if (Auth::check()) {
            $user = Auth::user();
            $pin = $user->hasRole('pin');
            $map = $user->hasRole('map');
            if ($pin && !$map) {
                $this->buttons = ['request'];
            } else if (!$pin && $map) {
                $this->buttons = ['offer'];
            } else {
                # do nothing (keep default of both buttons)
            }
        }
    }
    
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

        if (isset($this->filters['types'])) {
            switch ($this->filters['types']) {
                case 'offers':
                    # Show only offers
                    $query->where('type', 'offer');
                    break;

                case 'requests':
                    # Show only requests
                    $query->where('type', 'request');
                    break;

                default:
                    # Do nothing
                    break;
            }
        }
            

        $listings = $query->paginate(12);
            
        return view('listing.listing-index', [
            'listings' => $listings
        ]);
    }
}