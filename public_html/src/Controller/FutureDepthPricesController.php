<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FutureDepthPrices Controller
 *
 * @property \App\Model\Table\FutureDepthPricesTable $FutureDepthPrices
 */
class FutureDepthPricesController extends AppController
{

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
        $this->set('futureDepthPrices', $this->paginate($this->FutureDepthPrices));
        $this->set('_serialize', ['futureDepthPrices']);
    }

    /**
     * View method
     *
     * @param string|null $id Future Depth Price id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $futureDepthPrice = $this->FutureDepthPrices->get($id, [
            'contain' => ['Exchanges']
        ]);
        $this->set('futureDepthPrice', $futureDepthPrice);
        $this->set('_serialize', ['futureDepthPrice']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $futureDepthPrice = $this->FutureDepthPrices->newEntity();
        if ($this->request->is('post')) {
            $futureDepthPrice = $this->FutureDepthPrices->patchEntity($futureDepthPrice, $this->request->data);
            if ($this->FutureDepthPrices->save($futureDepthPrice)) {
                $this->Flash->success('The future depth price has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The future depth price could not be saved. Please, try again.');
            }
        }
        $exchanges = $this->FutureDepthPrices->Exchanges->find('list', ['limit' => 200]);
        $this->set(compact('futureDepthPrice', 'exchanges'));
        $this->set('_serialize', ['futureDepthPrice']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Future Depth Price id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $futureDepthPrice = $this->FutureDepthPrices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $futureDepthPrice = $this->FutureDepthPrices->patchEntity($futureDepthPrice, $this->request->data);
            if ($this->FutureDepthPrices->save($futureDepthPrice)) {
                $this->Flash->success('The future depth price has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The future depth price could not be saved. Please, try again.');
            }
        }
        $exchanges = $this->FutureDepthPrices->Exchanges->find('list', ['limit' => 200]);
        $this->set(compact('futureDepthPrice', 'exchanges'));
        $this->set('_serialize', ['futureDepthPrice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Future Depth Price id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $futureDepthPrice = $this->FutureDepthPrices->get($id);
        if ($this->FutureDepthPrices->delete($futureDepthPrice)) {
            $this->Flash->success('The future depth price has been deleted.');
        } else {
            $this->Flash->error('The future depth price could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
