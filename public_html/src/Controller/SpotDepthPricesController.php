<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * SpotDepthPrices Controller
 *
 * @property \App\Model\Table\SpotDepthPricesTable $SpotDepthPrices
 */
class SpotDepthPricesController extends AppController
{
    public function graph($id = null) {
        $difference = "-1 week";
        if(isset($_GET['time']) && $_GET['time'] == "day") {
            $difference = "-1 day";
        }
        if(isset($_GET['time']) && $_GET['time'] == "month") {
            $difference = "-1 month";
        }
        if(isset($_GET['time']) && $_GET['time'] == "year") {
            $difference = "-1 year";
        }
        
        $exchanges = TableRegistry::get('Exchanges')->find('all');
        
        foreach($exchanges as $exchange) {
            $lastResult = $this->SpotDepthPrices->find('all', [
                'conditions' => [
                    'exchange_id' => $exchange->id
                ],
                'order' => ['id' => 'desc'],
            ])->first();    
            
            $labels = array();
                        
            foreach(unserialize($lastResult->bids) as $b) {
                // echo "<pre>" . print_r($b[1], TRUE) . "</pre>";
                $labels[] = $b[1];
            }            
                        
            $exchange_depth['xchg_' . $exchange->name]['bids'] = unserialize($lastResult->bids);
            $exchange_depth['xchg_' . $exchange->name]['asks'] = unserialize($lastResult->asks);
            $exchange_depth['xchg_' . $exchange->name]['labels'] = $labels;
        }
        
        $this->set('graph_data', $exchange_depth);
        
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Exchanges']
        ];
        $this->set('spotDepthPrices', $this->paginate($this->SpotDepthPrices));
        $this->set('_serialize', ['spotDepthPrices']);
    }

    /**
     * View method
     *
     * @param string|null $id Spot Depth Price id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $spotDepthPrice = $this->SpotDepthPrices->get($id, [
            'contain' => ['Exchanges']
        ]);
        $this->set('spotDepthPrice', $spotDepthPrice);
        $this->set('_serialize', ['spotDepthPrice']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $spotDepthPrice = $this->SpotDepthPrices->newEntity();
        if ($this->request->is('post')) {
            $spotDepthPrice = $this->SpotDepthPrices->patchEntity($spotDepthPrice, $this->request->data);
            if ($this->SpotDepthPrices->save($spotDepthPrice)) {
                $this->Flash->success('The spot depth price has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The spot depth price could not be saved. Please, try again.');
            }
        }
        $exchanges = $this->SpotDepthPrices->Exchanges->find('list', ['limit' => 200]);
        $this->set(compact('spotDepthPrice', 'exchanges'));
        $this->set('_serialize', ['spotDepthPrice']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Spot Depth Price id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $spotDepthPrice = $this->SpotDepthPrices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $spotDepthPrice = $this->SpotDepthPrices->patchEntity($spotDepthPrice, $this->request->data);
            if ($this->SpotDepthPrices->save($spotDepthPrice)) {
                $this->Flash->success('The spot depth price has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The spot depth price could not be saved. Please, try again.');
            }
        }
        $exchanges = $this->SpotDepthPrices->Exchanges->find('list', ['limit' => 200]);
        $this->set(compact('spotDepthPrice', 'exchanges'));
        $this->set('_serialize', ['spotDepthPrice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Spot Depth Price id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $spotDepthPrice = $this->SpotDepthPrices->get($id);
        if ($this->SpotDepthPrices->delete($spotDepthPrice)) {
            $this->Flash->success('The spot depth price has been deleted.');
        } else {
            $this->Flash->error('The spot depth price could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
