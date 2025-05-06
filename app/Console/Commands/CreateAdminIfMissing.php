<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminIfMissing extends Command
{
    protected $signature = 'admin:ensure';

    protected $description = 'Создаёт администратора, если он не существует';

    public function handle()
    {
        $email = 'admin@example.com';

        if (User::where('email', $email)->exists()) {
            $this->info('✅ Админ уже существует.');
            return;
        }

        $user = User::create([
            'name' => 'Admin',
            'email' => $email,
            'password' => Hash::make('secret123'), // пароль можно изменить
        ]);

        $this->info('🎉 Админ создан: '.$email.' / secret123');
    }
}
