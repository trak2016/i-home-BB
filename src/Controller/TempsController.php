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
	
    public $helpers = ['ChartJs.Chartjs' ];

	public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index', 'view', 'chart']);
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
		$flag='0';//
		$this->loadModel('Sensors');
		$sensors = $this->Sensors->find()->select(['id', 'device_id']);
		$ids = $sensors->extract('id')->toArray();
		$sensors = $sensors->extract('device_id')->toArray();
		array_unshift($sensors,'wszystkie');
		array_unshift($ids,'wszystkie');
		
		$this->set('sensors', $sensors);
		
		if($this->request->is('post')){

			$this->request->session()->write('sensor_id',$this->request->data['sensor_id']);
			$this->request->session()->write('date_from',$this->request->data['date_from']); 
			$this->request->session()->write('date_to',$this->request->data['date_to']); 

			if(isset($this->request->data['reset'])&& $this->request->data['reset']!='' ){

				$this->request->session()->write('sensor_id','');
				$this->request->session()->write('date_from','');
				$this->request->session()->write('date_to','');
				$flag='1';
			   }
			}

		$cond_sensor_id = [];
		$cond_date_from = [];
		$cond_date_to = [];
		
		$search = $this->request->session()->read('sensor_id');
		if(isset($search) && $search!='' && $search!='0'){
			$cond_sensor_id = "sensor_id  = " . strip_tags($sensors[$search]);
			$this->request->session()->write('sensor_id', '');
		}
		else{
			$cond_sensor_id = "sensor_id  like '%'";
		}
		
		$search = $this->request->session()->read('date_from');
		if(isset($search)&& $search!=''){
			$cond_date_from = "DATE(Temps.created) >= STR_TO_DATE('$search', '%d-%m-%Y')";
			$this->request->session()->write('date_from', '');
		}
		
		$search = $this->request->session()->read('date_to');
		if(isset($search)&& $search!=''){
			$cond_date_to = "DATE(Temps.created) <= STR_TO_DATE('$search', '%d-%m-%Y')";
			$this->request->session()->write('date_to', '');
		}
		
        $this->paginate = [
            'contain' => ['Sensors'],
			'conditions' => [$cond_sensor_id, $cond_date_from, $cond_date_to]
        ];
        $this->set('temps', $this->paginate($this->Temps));
		
        $this->set('_serialize', ['temps']);
		
		if($flag=='1'){
			$this->redirect(['action' => 'index']);
		}
    }
	
	public function chart()
    {
		$flag='0';
		$this->loadModel('Sensors');
		$sensors = $this->Sensors->find()->select(['device_id'])->extract('device_id')->toArray();
		
		$this->set('sensors', $sensors);
		
		if($this->request->is('post')){

			$this->request->session()->write('sensor_id',$this->request->data['sensor_id']);
			$this->request->session()->write('date_from',$this->request->data['date_from']); 
			$this->request->session()->write('date_to',$this->request->data['date_to']); 

			if(isset($this->request->data['reset'])&& $this->request->data['reset']!='' ){
				
				$this->request->session()->write('sensor_id',$this->request->data['sensor_id']);
				$this->request->session()->write('date_from','');
				$this->request->session()->write('date_to','');
				$flag='1';
			   }
			}
		
		$search = $this->request->session()->read('sensor_id');
		if(isset($search) && $search!=''){
			$cond_sensor_id = strip_tags($sensors[$search]);
			$this->request->session()->write('sensor_id', '');
		}
		else{
			$cond_sensor_id = strip_tags($sensors['0']);
		}
		
		if($flag=='1'){
			$this->redirect(['action' => 'chart']);
		}
		
		$query = $this->Temps->find()->select(['Temps.created', 'temp'])->where(['sensor_id' => $cond_sensor_id]);
		
		$search = $this->request->session()->read('date_from');
		if(isset($search)&& $search!=''){
			$query = $query->where("DATE(Temps.created) >= STR_TO_DATE('$search', '%d-%m-%Y')");
			$this->request->session()->write('date_from', '');
		}
		
		$search = $this->request->session()->read('date_to');
		if(isset($search)&& $search!=''){
			$query = $query->where("DATE(Temps.created) <= STR_TO_DATE('$search', '%d-%m-%Y')");
			$this->request->session()->write('date_to', '');
		}
		
		//$labels = implode ('  ', $query);
		$labels = $query->extract('created')->toArray();
		$values = $query->extract('temp')->toArray();
		
		$this->set('labels', $labels);
		
		$dataChart = [
			'labels' => $labels,
			'datasets' => [
					[ 
						'label' => "My First dataset",
						'fillColor' => "rgba(151,187,205,0.2)",
						'strokeColor' => "rgba(151,187,205,1)",
						'pointColor' => "rgba(151,187,205,1)",
						'pointStrokeColor' => "#fff",
						'pointHighlightFill' => "#fff",
						'pointHighlightStroke' => "rgba(151,187,205,1)",
						'data' => $values
					]
			]
		];
		$this->set('dataChart', $dataChart);
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
