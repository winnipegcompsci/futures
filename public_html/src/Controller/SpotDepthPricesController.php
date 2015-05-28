<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SpotDepthPrices Controller
 *
 * @property \App\Model\Table\SpotDepthPricesTable $SpotDepthPrices
 */
class SpotDepthPricesController extends AppController
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
