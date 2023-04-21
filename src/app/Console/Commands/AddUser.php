<?php

namespace AnthonyEdmonds\SilverOwl\Console\Commands;

use AnthonyEdmonds\SilverOwl\Models\User;
use Illuminate\Console\Command;

class AddUser extends Command
{
    protected $signature = 'add:user';

    protected $description = 'Adds a User to the system';

    public function handle(): void
    {
        $this->info('This command will add a new User to the system.');
        $this->info('The User will immediately be granted access, with all that entails.');

        do {
            $this->newLine();

            $this->info('Provide a unique username for this User.');
            $username = $this->ask('What is their username?');

            if (empty($username) === true) {
                $this->error('You must provide a username.');
                $username = null;
            } elseif (User::byUsername($username)->exists() === true) {
                $this->error('Another User with that username already exists. You must pick a unique name.');
                $username = null;
            }
        } while ($username === null);

        do {
            $this->newLine();

            $this->info('Provide a password for this User.');
            $this->info('A passphrase of at least 16 characters is required, such as "myverygoodfriend".');
            $this->info('They will be able to reset their password when they sign in.');
            $password = $this->ask('What is their password?');

            if (empty($password) === true) {
                $this->error('You must provide a password.');
                $password = null;
            } elseif (strlen($password) < 16) {
                $this->error('That password is too short. You must use at least 16 characters.');
                $password = null;
            }
        } while ($password === null);

        $user = new User();
        $user->username = $username;
        $user->password = $password;
        $user->save();

        $this->info("User {$user->username} has been created!");
    }
}
