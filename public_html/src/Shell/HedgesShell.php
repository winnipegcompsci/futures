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
        $hedges = $this->HedgePositions->find('all', [
            'conditions' => ['status' => 1]
        ]);
        
        foreach($hedges as $hedge) {
            // Update Open Hedges with New Data.
            if($hedge->status == 1) {
                if($hedge->update()) {
                    $this->out('Closed and Reopened Hedge #' . $hedge->id);
                } else {
                    $this->out('Holding on to Hedge Position #' . $hedge->id);
                }
            }
        }
    }
}