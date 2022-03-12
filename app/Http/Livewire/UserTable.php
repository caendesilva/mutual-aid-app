<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;

class UserTable extends DataTableComponent
{
    use AuthorizesRequests;

    public function mount()
    {
        $this->authorize('manageUsers');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Phone", "phone")
                ->sortable(),
            Column::make("Area", "area")
                ->sortable(),
            Column::make("Location", "location")
                ->sortable(),
            // Column::make("Created at", "created_at")
                // ->sortable(),
            // Column::make("Updated at", "updated_at")
                // ->sortable(),
            Column::make('Roles', 'roleList'),
        ];
    }

    public function query(): Builder
    {
        return User::with('roles');
    }
}
