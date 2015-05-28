<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FutureTickerPrices Controller
 *
 * @property \App\Model\Table\FutureTickerPricesTable $FutureTickerPrices
 */
class FutureTickerPricesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Exchanges', 'Contracts']
        ];
        $this->set('futureTickerPrices', $this->paginate($this->FutureTickerPrices));
        $this->set('_serialize', ['futureTickerPrices']);
    }

    /**
     * View method
     *
     * @param string|null $id Future Ticker Price id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $futureTickerPrice = $this->FutureTickerPrices->get($id, [
            'contain' => ['Exchanges', 'Contracts']
        ]);
        $this->set('futureTickerPrice', $futureTickerPrice);
        $this->set('_serialize', ['futureTickerPrice']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $futureTickerPrice = $this->FutureTickerPrices->newEntity();
        if ($this->request->is('post')) {
            $futureTickerPrice = $this->FutureTickerPrices->patchEntity($futureTickerPrice, $this->request->data);
            if ($this->FutureTickerPrices->save($futureTickerPrice)) {
                $this->Flash->success('The future ticker price has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The future ticker price could not be saved. Please, try again.');
            }
        }
        $exchanges = $this->FutureTickerPrices->Exchanges->find('list', ['limit' => 200]);
        $contracts = $this->FutureTickerPrices->Contracts->find('list', ['limit' => 200]);
        $this->set(compact('futureTickerPrice', 'exchanges', 'contracts'));
        $this->set('_serialize', ['futureTickerPrice']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Future Ticker Price id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $futureTickerPrice = $this->FutureTickerPrices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $futureTickerPrice = $this->FutureTickerPrices->patchEntity($futureTickerPrice, $this->request->data);
            if ($this->FutureTickerPrices->save($futureTickerPrice)) {
                $this->Flash->success('The future ticker price has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The future ticker price could not be saved. Please, try again.');
            }
        }
        $exchanges = $this->FutureTickerPrices->Exchanges->find('list', ['limit' => 200]);
        $contracts = $this->FutureTickerPrices->Contracts->find('list', ['limit' => 200]);
        $this->set(compact('futureTickerPrice', 'exchanges', 'contracts'));
        $this->set('_serialize', ['futureTickerPrice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Future Ticker Price id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $futureTickerPrice = $this->FutureTickerPrices->get($id);
        if ($this->FutureTickerPrices->delete($futureTickerPrice)) {
            $this->Flash->success('The future ticker price has been deleted.');
        } else {
            $this->Flash->error('The future ticker price could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
