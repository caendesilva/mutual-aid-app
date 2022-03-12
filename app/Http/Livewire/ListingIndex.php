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
     * The filter options
     */
    public bool $filterExcludeReligiousProviders = false;
    public bool $filterIncludeClosedListings = false;
    public bool $filterRequestsOnly = false;
    public bool $filterOffersOnly = false;

    /**
     * The property model for the type filter selector input element
     * @var string
     */
    public string $typeSelector = '';

    protected $queryString = [
        'filterExcludeReligiousProviders' => ['except' => false],
        'filterIncludeClosedListings' => ['except' => false],
        'filterRequestsOnly' => ['except' => false],
        'filterOffersOnly' => ['except' => false],
    ];

    /**
     * The search query
     * @var string
     */
    public string $search = '';

    /**
     * The amount of listings to show per page
     * @var int
     */
    public int $perPage = 12;

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
            } elseif (!$pin && $map) {
                $this->buttons = ['offer'];
            } else {
                # do nothing (keep default of both buttons)
            }
        }
    }
    
    /**
     * Set the filters depending on the selected value
     */
    public function updatedTypeSelector()
    {
        if ($this->typeSelector == 'requests') {
            $this->filterRequestsOnly = true;
            $this->filterOffersOnly = false;
        } elseif ($this->typeSelector == 'offers') {
            $this->filterRequestsOnly = false;
            $this->filterOffersOnly = true;
        } else {
            $this->filterRequestsOnly = false;
            $this->filterOffersOnly = false;
        }

        $this->resetPage();
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
    public function updated($name)
    {
        if (substr($name,0 , 6) === 'filter') {
            $this->resetPage();
        }
    }

    /**
     * Clear the current search filters
     */
    public function clearFilters()
    {
        $this->search = '';
        $this->filterExcludeReligiousProviders = false;
        $this->filterIncludeClosedListings = false;
        $this->filterRequestsOnly = false;
        $this->filterOffersOnly = false;
        
        $this->resetPage();
    }


    /**
     * Load more posts by increasing the $perPage property
     */
    public function loadMore()
    {
        $this->perPage += 12;
    }

    /**
     * Return the view with the filtered models.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $query = Listing::where('subject', 'like', "%$this->search%")->orderByDesc('created_at');

        if ($this->filterExcludeReligiousProviders) {
            $query->whereNull('metadata->is_religious');
        }

        if (!$this->filterIncludeClosedListings) {
            $query->whereNull('closed_at');
        }
        
        if ($this->filterRequestsOnly) {
            $query->where('type', 'request');
        }

        if ($this->filterOffersOnly) {
            $query->where('type', 'offer');
        }

        $listings = $query->paginate($this->perPage);
            
        return view('listing.listing-index', [
            'listings' => $listings
        ]);
    }
}
