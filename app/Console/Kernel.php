<?php
namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        Commands\Lookup\ProductInventory::class,
        Commands\Lookup\BeerLookup::class,
        Commands\Lookup\WineLookup::class,
        Commands\Lookup\LiquorLookup::class,
        Commands\Lookup\BeerDescriptionLookup::class,
        Commands\Lookup\UpdateProductAttributes::class,
        Commands\EmailQueueCommand::class,
        Commands\ImportVenueImport::class,
        Commands\CategoryFix::class,
        Commands\LongProcess::class,
        Commands\SlugCommand::class,
        Commands\ProductFormatCommand::class,
        Commands\ImageCommand::class,
        Commands\GoogleMerchantCommand::class,
        Commands\TwilioQueueCommand::class,
        Commands\MailChimpCommand::class,
        Commands\Social\EmailAnalytics::class,
        Commands\Social\FBAnalytics::class,
        Commands\Social\FbReAuthorize::class,
        Commands\VenueCodeCommand::class,
        Commands\Social\Schedule\Twitter::class,
        Commands\Social\Schedule\Instagram::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
