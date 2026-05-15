<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = \App\Models\User::all();

        $this->info('Total users: ' . $users->count());

        foreach ($users as $user) {
            $this->line("ID: {$user->id}, Name: {$user->name}, Email: {$user->email}, Cedula: {$user->cedula}");
        }

        // Check current authenticated user
        if (auth()->check()) {
            $this->info('Current authenticated user:');
            $this->line("ID: " . auth()->id() . ", Name: " . auth()->user()->name);
        } else {
            $this->error('No user authenticated');
        }
    }
}
