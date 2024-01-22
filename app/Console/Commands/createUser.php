<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Roles;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

class createUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user {name?} {email?} {roleName?} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user';

    public function __construct(private UserService $userService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if(!$name = $this->argument('name')){
            $name = $this->ask('Name');
        }

        if(!$email = $this->argument('email')){
            $email = $this->ask('Email');
        }

        if(!$roleName = $this->argument('roleName')){
            $roleName = 'Role';
        }
        
        if(!$password = $this->argument('password')){
            $password = 'password';
        }

        $role = Roles::findByName($roleName);

        $user = $this->userService->create([
            'name' => $name, 
            'email' => $email, 
            'password' => Hash::make($password),
            'roles' => [$role],
        ]);
        
        $this->info('User created.');
    }
}
