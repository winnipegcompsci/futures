<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SpotTradePrices Controller
 *
 * @property \App\Model\Table\SpotTradePricesTable $SpotTradePrices
 */
class SpotTradePricesController extends AppController
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
        $this->set('spotTradePrices', $this->paginate($this->SpotTradePrices));
        $this->set('_serialize', ['spotTradePrices']);
    }

    /**
     * View method
     *
     * @param string|null $id Spot Trade Price id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $spotTradePrice = $this->SpotTradePrices->get($id, [
            'contain' => ['Exchanges']
        ]);
        $this->set('spotTradePrice', $spotTradePrice);
        $this->set('_serialize', ['spotTradePrice']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $spotTradePrice = $this->SpotTradePrices->newEntity();
        if ($this->request->is('post')) {
            $spotTradePrice = $this->SpotTradePrices->patchEntity($spotTradePrice, $this->request->data);
            if ($this->SpotTradePrices->save($spotTradePrice)) {
                $this->Flash->success('The spot trade price has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The spot trade price could not be saved. Please, try again.');
            }
        }
        $exchanges = $this->SpotTradePrices->Exchanges->find('list', ['limit' => 200]);
        $this->set(compact('spotTradePrice', 'exchanges'));
        $this->set('_serialize', ['spotTradePrice']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Spot Trade Price id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $spotTradePrice = $this->SpotTradePrices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $spotTradePrice = $this->SpotTradePrices->patchEntity($spotTradePrice, $this->request->data);
            if ($this->SpotTradePrices->save($spotTradePrice)) {
                $this->Flash->success('The spot trade price has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The spot trade price could not be saved. Please, try again.');
            }
        }
        $exchanges = $this->SpotTradePrices->Exchanges->find('list', ['limit' => 200]);
        $this->set(compact('spotTradePrice', 'exchanges'));
        $this->set('_serialize', ['spotTradePrice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Spot Trade Price id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $spotTradePrice = $this->SpotTradePrices->get($id);
        if ($this->SpotTradePrices->delete($spotTradePrice)) {
            $this->Flash->success('The spot trade price has been deleted.');
        } else {
            $this->Flash->error('The spot trade price could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
