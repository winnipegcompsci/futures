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
            $this->paginate = [
                'contain' => ['Exchanges'],
                'limit' => '100',
                'order' => ['HedgePositions.timeopened' => 'desc']
            ];
            $this->set('hedgePositions', $this->paginate($this->HedgePositions));
            $this->set('_serialize', ['hedgePositions']);
            
        } else {
            $this->paginate = [
                'contain' => ['Exchanges'],
            ];
            $this->set('hedgePositions', 
                $this->paginate(
                    $this->HedgePositions->find('all', [
                        'conditions' => ['status' => 1],
                        'recursive' => 0
                    ])
                )
            );
            $this->set('_serialize', ['hedgePositions']);

        }

        // debug($this->paginate(), TRUE); 
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
        $exchanges = $this->HedgePositions->Exchanges->find('list', ['limit' => 200, 'recursive' => 0]);
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
    
    public function forceUpdate($id = null) {
        $hedgePosition = $this->HedgePositions->get($id, [
            'contain' => ['Exchanges'],
            'recursive' => 0,
        ]);
        
        $hedgePosition->forceUpdate($id);   // Call Update Function.
                
        return $this->redirect(['action' => 'index']);
    }
    
    public function update($id = null) {
        $hedgePosition = $this->HedgePositions->get($id, [
            'contain' => ['Exchanges'],
            'recursive' => 0,
        ]);
        
        $hedgePosition->update();   // Call Update Function.
        
        
        return $this->redirect(['action' => 'index']);
    }
}
