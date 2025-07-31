<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\NotificationQueue;
use App\Models\UserVenueNotification;

class NotificationQueueCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:notification {--type=}';

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
        NotificationQueue::sendPendingNotifications();
    }
}
