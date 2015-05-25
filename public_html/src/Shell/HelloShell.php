<?php 

namespace App\Shell;

use Cake\Console\Shell;

class HelloShell extends Shell
{
    public function main()
    {
        // Foreach Open Position --> Run Update Script.
        $this->out('Hello world.');
    }
}