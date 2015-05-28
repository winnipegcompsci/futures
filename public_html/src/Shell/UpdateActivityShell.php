<?php 

namespace App\Shell;

use Cake\Console\Shell;

class UpdateActivityShell extends Shell
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Exchanges');
    }

    public function main()
    {        
        $this->out(str_pad('UPDATE ACTIVITY SHELL: Starting Update ', 80, "*", STR_PAD_RIGHT));

        $exchanges = $this->Exchanges->find('all');       
        
        foreach($exchanges as $exchange) {
        // Foreach Exchange:
            $this->out("Updating " . $exchange->name . "'s spot ticker data.");
            $exchange->saveSpotTickerData();
            
            $this->out("Updating " . $exchange->name . "'s future ticker data.");
            $exchange->saveFutureTickerData();
                        
            $this->out("Updating " . $exchange->name . "'s spot market depth.");
            $exchange->saveSpotDepthData();
            
            $this->out("Updating " . $exchange->name . "'s future market depth.");
            $exchange->saveFutureDepthData();
                        
            $this->out("Updating " . $exchange->name . "'s recent spot trades.");
            $exchange->saveSpotTradesData();
            
            $this->out("Updating " . $exchange->name . "'s recent future trades.");
            $exchange->saveFutureTradesData();
            
            // $this->out("Updating " . $exchange->name . "'s spot candlestick data");
            // $exchange->saveSpotCandlestickData();
            
            // $this->out("Updating " . $exchange->name . "'s future candlestick data");
            // $exchange->saveFutureCandlestickData();
            
            $this->out("");
        }
        
        $this->out(str_pad('UPDATE ACTIVITY SHELL: Finished Update! ', 80, "*", STR_PAD_RIGHT));
    }
}