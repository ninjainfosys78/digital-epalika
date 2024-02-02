<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ClearExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:excel {--a|all : clear all excel} {--d|date=* : clear excel from date in AD}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Excel';


    public function handle()
    {
        $all = $this->option('all');
        $date = $this->option('date');

        //        get all directory in folder storage/app/public/excel
        $directories = collect(Storage::disk('public')->directories('excel'))
            ->map(function ($directory) {
                return basename($directory);
            });

        //        check if date is not empty

        if (!empty($date)) {
            foreach ($date as $d) {
                //               change format of date to Ymd
                $d = date('Ymd', strtotime($d));
                if ($directories->contains($d)) {
                    Storage::disk('public')->deleteDirectory('excel/' . $d);

                    $this->info('Excel file from ' . date('Y-m-d', strtotime($d)) . ' has been deleted');
                }
            }
        } else {
            //            delete all directory if all option is true else delete all directory except today
            if ($all) {
                $directories->each(function ($directory) {
                    Storage::disk('public')->deleteDirectory('excel/' . $directory);
                });
                $this->info('All excel file has been deleted');
            } else {
                $directories->each(function ($directory) {
                    if ($directory != date('Ymd')) {
                        Storage::disk('public')->deleteDirectory('excel/' . $directory);
                    }
                });
                $this->info('All excel file except today has been deleted');
            }
        }
    }
}
