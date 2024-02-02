<?php

namespace Modules\ExecutiveMeeting\Console;

use Illuminate\Console\Command;

class SendMeetingMessage extends Command
{
    protected $name = 'meeting:message';

    protected $description = 'Send Meeting Message to specified group';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        //
    }
}
