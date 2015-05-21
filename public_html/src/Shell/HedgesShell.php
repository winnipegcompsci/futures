<?php 

namespace App\Shell;

use Cake\Console\Shell;

class HedgesShell extends Shell
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('HedgePositions');
    }

    public function main()
    {
        // Foreach Open Position --> Run Update Script.
        
        $this->out('Updating Hedges.');
        $hedges = $this->HedgePositions->find('all');
        
        foreach($hedges as $hedge) {
            // Update Open Hedges with New Data.
            if($hedge->status == 1) {
                $this->out("Updating Hedge #" . $hedge->id);
                $hedge->update();
            }
        }
    }
}