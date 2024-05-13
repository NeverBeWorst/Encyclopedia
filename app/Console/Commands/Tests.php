<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;

class Tests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DoAdmin {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give admin role';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::all()->firstWhere('login',  $this->argument('name'));

        if ($user) {
            $user->update(['role' => 'admin']);
        }

        /*if ( $this->argument('user')) {
            $user = User::all()->firstWhere('login', $this->argument('user'));
        }
        else {
            $name = $this->ask('Как тебя зовут?');
            $user = User::all()->firstWhere('login', $name);
        }

        if ($this->confirm('Хотите продолжить?')) {
            $user_name =  $user->login;
            $user->update(['role' => 'admin']);
            $this->line("Теперь у вас есть права админестратора. Поздравляю, {$user_name}!");
        }*/
    }
}
