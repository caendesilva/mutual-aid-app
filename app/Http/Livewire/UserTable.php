<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;

class UserTable extends DataTableComponent
{
    use AuthorizesRequests;

    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

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
            BooleanColumn::make('Verified', 'email_verified_at'),
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
