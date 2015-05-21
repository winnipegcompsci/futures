<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HedgePositions Controller
 *
 * @property \App\Model\Table\HedgePositionsTable $HedgePositions
 */
class HedgePositionsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        if(isset($_GET['status']) && $_GET['status'] == 'all') {
            error_log('Displaying All Positions');
            $this->paginate = [
                'contain' => ['Exchanges']
            ];
            $this->set('hedgePositions', $this->paginate($this->HedgePositions));
            $this->set('_serialize', ['hedgePositions']);
            
        } else {
            error_log('Displaying Open Positions');
            $this->paginate = [
                'contain' => ['Exchanges']
            ];
            $this->set('hedgePositions', $this->paginate($this->HedgePositions->find('all', [
                'conditions' => ['status' => 1]
            ])));
            $this->set('_serialize', ['hedgePositions']);

        }
    
        // $this->paginate = [
            // 'contain' => ['Exchanges']
        // ];
        // $this->set('hedgePositions', $this->paginate($this->HedgePositions));
        // $this->set('_serialize', ['hedgePositions']);
    }

    /**
     * View method
     *
     * @param string|null $id Hedge Position id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hedgePosition = $this->HedgePositions->get($id, [
            'contain' => ['Exchanges']
        ]);
        $this->set('hedgePosition', $hedgePosition);
        $this->set('_serialize', ['hedgePosition']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hedgePosition = $this->HedgePositions->newEntity();
        if ($this->request->is('post')) {
            $hedgePosition = $this->HedgePositions->patchEntity($hedgePosition, $this->request->data);
            if ($this->HedgePositions->save($hedgePosition)) {
                $this->Flash->success('The hedge position has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The hedge position could not be saved. Please, try again.');
            }
        }
        $exchanges = $this->HedgePositions->Exchanges->find('list', ['limit' => 200]);
        $this->set(compact('hedgePosition', 'exchanges'));
        $this->set('_serialize', ['hedgePosition']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Hedge Position id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hedgePosition = $this->HedgePositions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hedgePosition = $this->HedgePositions->patchEntity($hedgePosition, $this->request->data);
            if ($this->HedgePositions->save($hedgePosition)) {
                $this->Flash->success('The hedge position has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The hedge position could not be saved. Please, try again.');
            }
        }
        $exchanges = $this->HedgePositions->Exchanges->find('list', ['limit' => 200]);
        $this->set(compact('hedgePosition', 'exchanges'));
        $this->set('_serialize', ['hedgePosition']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Hedge Position id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hedgePosition = $this->HedgePositions->get($id);
        if ($this->HedgePositions->delete($hedgePosition)) {
            $this->Flash->success('The hedge position has been deleted.');
        } else {
            $this->Flash->error('The hedge position could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
    
    
    public function update($id = null) {
        $hedgePosition = $this->HedgePositions->get($id, [
            'contain' => ['Exchanges']
        ]);
        
        $openingPrice = $hedgePosition->lastprice;
        $currentPrice = $hedgePosition->getCurrentPrice($hedgePosition->exchange->name);
               
        $minBound = $hedgePosition->lastprice - ($hedgePosition->lastprice * $hedgePosition->ssp);
        $maxBound = $hedgePosition->lastprice + ($hedgePosition->lastprice * $hedgePosition->ssp);
        
        error_log("Updating...");
        error_log("Last Price: " . $openingPrice);
        error_log("Min Bound: " . $minBound);
        error_log("Current Price: " . $currentPrice);
        error_log("Max Bound: " . $maxBound);
        
        
        // Recalculate Stops.
        if($hedgePosition->bias == "LONG") {
            if($currentPrice < $minBound) {            
                // Close Position and Reopen at Current Price.
                $output = "<br /><strong>Closing Long Position at " . $hedgePosition->lastprice . " and re-opening at " . $currentPrice . "</strong>";
            
                $unrealizedPL = (($currentPrice - $hedgePosition->lastprice) * $hedgePosition->amount) / $currentPrice;
                
               
                // Update Old Hedge Position
                $hedgePosition->balance += $unrealizedPL;            
                $hedgePosition->timeopened = date("Y-m-d H:i:s");
                $hedgePosition->status = 0;
                $this->HedgePositions->save($hedgePosition);
                
                $newPosition = $this->HedgePositions->newEntity();
                
                $newPosition->exchange_id = $hedgePosition->exchange_id;
                $newPosition->bias = $hedgePosition->bias;
                $newPosition->amount = $hedgePosition->amount;
                $newPosition->ssp = $hedgePosition->ssp;
                $newPosition->leverage = $hedgePosition->leverage;
                $newPosition->balance = $hedgePosition->amount;
                $newPosition->lastprice = $currentPrice;
                $newPosition->timeopened = date("Y-m-d H:i:s");
                $newPosition->recalculation = $hedgePosition->recalculation;                
                
                if ($this->HedgePositions->save($newPosition)) {
                    $this->Flash->success("Old Position Closed, New Position Created");
                } else {
                    $this->Flash->error("Error: The hedge could not be Saved!");
                }
 
            } else {
                // else hold onto position
                $this->Flash->success("Holding on to Position");
            }
            
        }
        
        if ($hedgePosition->bias == "SHORT") {
            if($currentPrice > $maxBound) {
                // Close Position and Reopen at Current Price.
                    
                $unrealizedPL = (($hedgePosition->lastprice - $currentPrice) * $hedgePosition->amount) / $currentPrice;
                
                $hedgePosition->balance += $unrealizedPL;
                $hedgePosition->timeopened = date("Y-m-d H:i:s");
                $hedgePosition->status = 0;
                $this->HedgePositions->save($hedgePosition);
                
                $newPosition = $this->HedgePositions->newEntity();
                
                $newPosition->exchange_id = $hedgePosition->exchange_id;
                $newPosition->bias = $hedgePosition->bias;
                $newPosition->amount = $hedgePosition->amount;
                $newPosition->ssp = $hedgePosition->ssp;
                $newPosition->leverage = $hedgePosition->leverage;
                $newPosition->balance = $hedgePosition->amount;
                $newPosition->lastprice = $currentPrice;
                $newPosition->timeopened = date("Y-m-d H:i:s");
                $newPosition->recalculation = $hedgePosition->recalculation;   
                
                
                if ($this->HedgePositions->save($newPosition)) {
                    $this->Flash->success("Old Position Closed, New Position Created");
                } else {
                    $this->Flash->error("Error: The hedge could not be Saved!");
                }
            } else {
                // else hold onto position.
                $this->Flash->success("Holding on to Position");
            }
            
        }
        
        return $this->redirect(['controller' => 'HedgePositions', 'action' => 'index']);
    }
}
