<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Sensors Controller
 *
 * @property \App\Model\Table\SensorsTable $Sensors
 */
class SensorsController extends AppController
{
	
	// public function isAuthorized($user)
	// {
		// if (in_array($this->request->action, ['add', 'edit'] ) ) {
			// $this->Flash->error(__('Nie masz dostępu do tego miejsca'));
			// return false;
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
        $this->set('sensors', $this->paginate($this->Sensors));
        $this->set('_serialize', ['sensors']);
    }

    /**
     * View method
     *
     * @param string|null $id Sensor id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sensor = $this->Sensors->get($id, [
            'contain' => ['Temps']
        ]);
        $this->set('sensor', $sensor);
        $this->set('_serialize', ['sensor']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sensor = $this->Sensors->newEntity();
        if ($this->request->is('post')) {
            $sensor = $this->Sensors->patchEntity($sensor, $this->request->data);
            if ($this->Sensors->save($sensor)) {
                $this->Flash->success(__('Czujnik został dodany'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Błąd podczas dodawania nowego czujnika.'));
            }
        }
        $this->set(compact('sensor'));
        $this->set('_serialize', ['sensor']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sensor id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sensor = $this->Sensors->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sensor = $this->Sensors->patchEntity($sensor, $this->request->data);
            if ($this->Sensors->save($sensor)) {
                $this->Flash->success(__('Zmiany zostały zapisane'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Błąd podczas edycji danych'));
            }
        }
        $this->set(compact('sensor'));
        $this->set('_serialize', ['sensor']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sensor id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sensor = $this->Sensors->get($id);
        if ($this->Sensors->delete($sensor)) {
            $this->Flash->success(__('Czujnik został usunięty'));
        } else {
            $this->Flash->error(__('Błąd podczas usuwania czujnika'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
