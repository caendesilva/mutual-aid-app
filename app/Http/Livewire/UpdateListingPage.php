<?php

namespace App\Http\Livewire;

use App\Models\Listing;
use Livewire\Component;

class UpdateListingPage extends Component
{
    public Listing $listing;

    public string $type;

    public bool $hasDeleteButton = true;

    public bool $confirmingModelDeletion = false;

    protected $queryString = [
        'confirmingModelDeletion' => ['except' => false],
    ];

    public function mount(Listing $listing)
    {
        $this->listing = $this->listing;
        $this->type = $this->listing->type;
    }

    public function render()
    {
        return view('livewire.update-listing-page');
    }
}
