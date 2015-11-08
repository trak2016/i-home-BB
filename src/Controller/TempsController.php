<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Temps Controller
 *
 * @property \App\Model\Table\TempsTable $Temps
 */
class TempsController extends AppController
{
	
	public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index', 'view']);
    }
	
	// public function isAuthorized($user)
	// {
		// if (in_array($this->request->action, ['index'] ) ) {
			// return true;
		// }

		// return parent::isAuthorized($user);
	// }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Sensors']
        ];
        $this->set('temps', $this->paginate($this->Temps));
        $this->set('_serialize', ['temps']);
    }

    /**
     * View method
     *
     * @param string|null $id Temp id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $temp = $this->Temps->get($id, [
            'contain' => ['Sensors']
        ]);
        $this->set('temp', $temp);
        $this->set('_serialize', ['temp']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $temp = $this->Temps->newEntity();
        if ($this->request->is('post')) {
            $temp = $this->Temps->patchEntity($temp, $this->request->data);
            if ($this->Temps->save($temp)) {
                $this->Flash->success(__('The temp has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The temp could not be saved. Please, try again.'));
            }
        }
        $sensors = $this->Temps->Sensors->find('list', ['limit' => 200]);
        $this->set(compact('temp', 'sensors'));
        $this->set('_serialize', ['temp']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Temp id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $temp = $this->Temps->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $temp = $this->Temps->patchEntity($temp, $this->request->data);
            if ($this->Temps->save($temp)) {
                $this->Flash->success(__('The temp has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The temp could not be saved. Please, try again.'));
            }
        }
        $sensors = $this->Temps->Sensors->find('list', ['limit' => 200]);
        $this->set(compact('temp', 'sensors'));
        $this->set('_serialize', ['temp']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Temp id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $temp = $this->Temps->get($id);
        if ($this->Temps->delete($temp)) {
            $this->Flash->success(__('Temperatura została usunięta'));
        } else {
            $this->Flash->error(__('Błąd podczas usuwania czujnika'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
