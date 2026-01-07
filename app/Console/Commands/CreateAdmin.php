<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin';

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
        $this->info('Create a new Admin user');
        $this->line('-----------------------');

        // Email
        $email = $this->askValid(
            'Email address',
            'email',
            ['required', 'email', 'unique:users,email']
        );

        // Name
        $name = $this->askValid(
            'Admin name',
            'name',
            ['required', 'string', 'min:3']
        );

        // Password (hidden input)
        $password = $this->secret('Password');
        $confirm  = $this->secret('Confirm Password');

        if ($password !== $confirm) {
            $this->error('Passwords do not match.');
            return Command::FAILURE;
        }

        if (strlen($password) < 8) {
            $this->error('Password must be at least 8 characters.');
            return Command::FAILURE;
        }

        // Create user
        $user = User::create([
            'email'    => $email,
            'name'     => $name,
            'password' => Hash::make($password),
        ]);

        // Assign admin role
        $user->assignRole('admin');

        $this->info('✅ Admin created successfully!');
        $this->line("Email: {$email}");

        return Command::SUCCESS;
    }

    /**
     * Ask and validate input
     */
    protected function askValid(string $question, string $field, array $rules)
    {
        $value = $this->ask($question);

        $validator = Validator::make(
            [$field => $value],
            [$field => $rules]
        );

        if ($validator->fails()) {
            $this->error($validator->errors()->first($field));
            return $this->askValid($question, $field, $rules);
        }

        return $value;
    }
}
