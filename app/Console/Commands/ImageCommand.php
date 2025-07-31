<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helper\ImageHelper;

class ImageCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:resize {--limit=} {--category=}';

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
     * @return int
     */
    public function handle()
    {
        $limit = $this->option('limit');
        $category = $this->option('category');
        ImageHelper::handle($limit, $category);
        return Command::SUCCESS;
    }
}
