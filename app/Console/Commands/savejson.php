<?php

namespace App\Console\Commands;

use App\News;
use App\Users;
use Illuminate\Console\Command;

class savejson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $users = Users::$usersData;
        $users[0]['password'] = password_hash($users[0]['password'], PASSWORD_DEFAULT);
        $users[1]['password'] = password_hash($users[1]['password'], PASSWORD_DEFAULT);

        \Storage::disk('local')->put('users.json', json_encode($users,
            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
}
