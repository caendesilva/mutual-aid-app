<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;

class AddRoleToUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:add {user} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a role to the user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::findOrFail($this->argument('user'));
        $role = Role::findOrFail($this->argument('role'));
        try {
            $user->roles()->attach($role);
            $this->info("Added role $role->name to $user->name.");
        } catch (\Throwable $th) {
            $this->error("Something went wrong adding $role->name to $user->name.");
            $this->line($th->getMessage());
            return 1;
        }
        return 0;
    }
}
