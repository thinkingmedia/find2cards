<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Games Controller
 *
 * @property \App\Model\Table\GamesTable $Games
 */
class GamesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('games', $this->paginate($this->Games));
        $this->set('_serialize', ['games']);
    }

	public function start()
	{
	}

    /**
     * View method
     *
     * @param string|null $id Game id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $game = $this->Games->get($id, [
            'contain' => []
        ]);
        $this->set('game', $game);
        $this->set('_serialize', ['game']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $game = $this->Games->newEntity();
        if ($this->request->is('post')) {
            $game = $this->Games->patchEntity($game, $this->request->data);
            if ($this->Games->save($game)) {
                $this->Flash->success('The game has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The game could not be saved. Please, try again.');
            }
        }
        $this->set(compact('game'));
        $this->set('_serialize', ['game']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Game id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $game = $this->Games->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $game = $this->Games->patchEntity($game, $this->request->data);
            if ($this->Games->save($game)) {
                $this->Flash->success('The game has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The game could not be saved. Please, try again.');
            }
        }
        $this->set(compact('game'));
        $this->set('_serialize', ['game']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Game id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $game = $this->Games->get($id);
        if ($this->Games->delete($game)) {
            $this->Flash->success('The game has been deleted.');
        } else {
            $this->Flash->error('The game could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
