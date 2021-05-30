<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email every   hour';

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
        $details=['process'=>'2 houre','details'=>'hourly report for app'];
        
        Mail::to('derk@bric.solutions')->send(new \App\Mail\CrudMail($details));
        $this->info('sending email every  hour');
        // \Log::info("Cron is working fine!");
    }
}
