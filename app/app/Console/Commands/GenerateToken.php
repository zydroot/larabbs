<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Auth;

class GenerateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shijifc:generate-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '快速为用户生成 Token';

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
        $userId = $this->ask("请输入用户ID");
        $user = User::find($userId);

        if(!$user){
            return $this->error("用户不存在");
        }

        // 一年后过期
        $ttl = 60*24*365;
        $this->info(Auth::guard('api')->setTTL($ttl)->fromUser($user));
    }
}
