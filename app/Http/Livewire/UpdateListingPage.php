<?php

namespace App\Http\Livewire;

use App\Models\Listing;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UpdateListingPage extends Component
{
    use AuthorizesRequests;

    public Listing $listing;

    public string $type;

    public bool $confirmingModelDeletion = false;
    public bool $confirmingMarkedAsSolved = false;

    protected $queryString = [
        'confirmingModelDeletion' => ['except' => false],
        'confirmingMarkedAsSolved' => ['except' => false],
    ];

    public function mount(Listing $listing)
    {
        $this->listing = $listing;
        $this->type = $this->listing->type;
    }

    public function markAsSolved()
    {
        $this->authorize('update', $this->listing);
        $this->listing->refresh();
        if ($this->listing->metadata === null) {
            $this->listing->metadata = (object) [];
        }
        $metadata = $this->listing->metadata;
        $metadata->is_resolved = true;
        $this->listing->metadata = $metadata;
        $this->listing->closed_at = now();
        $this->listing->save();

        request()->session()->flash('flash.banner', 'Listing marked as solved successfully.');
        request()->session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('listings.show', $this->listing);
    }

    public function render()
    {
        return view('livewire.update-listing-page');
    }
}
