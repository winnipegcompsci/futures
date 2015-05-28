<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SpotTickerPrices Controller
 *
 * @property \App\Model\Table\SpotTickerPricesTable $SpotTickerPrices
 */
class SpotTickerPricesController extends AppController
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
        $this->set('spotTickerPrices', $this->paginate($this->SpotTickerPrices));
        $this->set('_serialize', ['spotTickerPrices']);
    }

    /**
     * View method
     *
     * @param string|null $id Spot Ticker Price id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $spotTickerPrice = $this->SpotTickerPrices->get($id, [
            'contain' => ['Exchanges']
        ]);
        $this->set('spotTickerPrice', $spotTickerPrice);
        $this->set('_serialize', ['spotTickerPrice']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $spotTickerPrice = $this->SpotTickerPrices->newEntity();
        if ($this->request->is('post')) {
            $spotTickerPrice = $this->SpotTickerPrices->patchEntity($spotTickerPrice, $this->request->data);
            if ($this->SpotTickerPrices->save($spotTickerPrice)) {
                $this->Flash->success('The spot ticker price has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The spot ticker price could not be saved. Please, try again.');
            }
        }
        $exchanges = $this->SpotTickerPrices->Exchanges->find('list', ['limit' => 200]);
        $this->set(compact('spotTickerPrice', 'exchanges'));
        $this->set('_serialize', ['spotTickerPrice']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Spot Ticker Price id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $spotTickerPrice = $this->SpotTickerPrices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $spotTickerPrice = $this->SpotTickerPrices->patchEntity($spotTickerPrice, $this->request->data);
            if ($this->SpotTickerPrices->save($spotTickerPrice)) {
                $this->Flash->success('The spot ticker price has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The spot ticker price could not be saved. Please, try again.');
            }
        }
        $exchanges = $this->SpotTickerPrices->Exchanges->find('list', ['limit' => 200]);
        $this->set(compact('spotTickerPrice', 'exchanges'));
        $this->set('_serialize', ['spotTickerPrice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Spot Ticker Price id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $spotTickerPrice = $this->SpotTickerPrices->get($id);
        if ($this->SpotTickerPrices->delete($spotTickerPrice)) {
            $this->Flash->success('The spot ticker price has been deleted.');
        } else {
            $this->Flash->error('The spot ticker price could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
