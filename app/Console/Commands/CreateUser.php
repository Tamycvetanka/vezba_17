<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class CreateUser extends Command
{
    protected $signature = 'user:create';
    protected $description = 'Create a user';

    public function handle(): int
    {
        $email = $this->ask('Email');
        $name = $this->ask('Username');
        $password = $this->secret('Password');

        $data = ['email' => $email, 'name' => $name, 'password' => $password];

        $validator = Validator::make($data, [
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $err) {
                $this->error($err);
            }
            return self::FAILURE;
        }

        User::create([
            'email' => $email,
            'name' => $name,
            'password' => Hash::make($password),
        ]);

        $this->info("Korisnik kreiran: {$email}");
        return self::SUCCESS;
    }
}
