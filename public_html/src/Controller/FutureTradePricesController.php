<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FutureTradePrices Controller
 *
 * @property \App\Model\Table\FutureTradePricesTable $FutureTradePrices
 */
class FutureTradePricesController extends AppController
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
        $this->set('futureTradePrices', $this->paginate($this->FutureTradePrices));
        $this->set('_serialize', ['futureTradePrices']);
    }

    /**
     * View method
     *
     * @param string|null $id Future Trade Price id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $futureTradePrice = $this->FutureTradePrices->get($id, [
            'contain' => ['Exchanges']
        ]);
        $this->set('futureTradePrice', $futureTradePrice);
        $this->set('_serialize', ['futureTradePrice']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $futureTradePrice = $this->FutureTradePrices->newEntity();
        if ($this->request->is('post')) {
            $futureTradePrice = $this->FutureTradePrices->patchEntity($futureTradePrice, $this->request->data);
            if ($this->FutureTradePrices->save($futureTradePrice)) {
                $this->Flash->success('The future trade price has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The future trade price could not be saved. Please, try again.');
            }
        }
        $exchanges = $this->FutureTradePrices->Exchanges->find('list', ['limit' => 200]);
        $this->set(compact('futureTradePrice', 'exchanges'));
        $this->set('_serialize', ['futureTradePrice']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Future Trade Price id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $futureTradePrice = $this->FutureTradePrices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $futureTradePrice = $this->FutureTradePrices->patchEntity($futureTradePrice, $this->request->data);
            if ($this->FutureTradePrices->save($futureTradePrice)) {
                $this->Flash->success('The future trade price has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The future trade price could not be saved. Please, try again.');
            }
        }
        $exchanges = $this->FutureTradePrices->Exchanges->find('list', ['limit' => 200]);
        $this->set(compact('futureTradePrice', 'exchanges'));
        $this->set('_serialize', ['futureTradePrice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Future Trade Price id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $futureTradePrice = $this->FutureTradePrices->get($id);
        if ($this->FutureTradePrices->delete($futureTradePrice)) {
            $this->Flash->success('The future trade price has been deleted.');
        } else {
            $this->Flash->error('The future trade price could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
