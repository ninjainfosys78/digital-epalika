<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Nwidart\Modules\Facades\Module;

class CheckMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:menu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Menu from the modules';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Checking files...');

        $this->newLine(3);

        $myfile = fopen('config/menus.php', 'wb') or exit('Unable to open file!');
        fwrite($myfile, '<?php return [');

        $modules = Module::toCollection();

        $bar = $this->output->createProgressBar(count($modules));

        $bar->start();
        $this->newLine();

        foreach ($modules as $module) {
            $this->writingIntoFile($module, $myfile);

            $bar->advance();
        }

        $bar->finish();

        fwrite($myfile, '];');
        fclose($myfile);

        $this->newLine(2);

        $this->info('Done👍👍👍');

        return 0;
    }

    /**
     * @param  mixed  $module
     * @param $myfile
     * @return void
     */
    public function writingIntoFile(mixed $module, $myfile): void
    {
        $file = $module->getName().'/Config/menus.txt';
        if (Storage::disk('module')->exists($file)) {
            $data = Storage::disk('module')->get($file);
            fwrite($myfile, $data);

            $this->info('file written from module:'.$module->getName());
        } else {
            $this->info('File does not exists. skipping module');
        }
        $this->newLine();
    }
}
