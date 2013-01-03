<?php
App::uses('AppController', 'Controller');
/**
 * Metrics Controller
 *
 * @property Metric $Metric
 */
class MetricsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Metric->recursive = 0;
		$this->set('metrics', $this->paginate());
	}

	public function assign(){
		$this->Metric->assign();
		$this->redirect(array('action' => 'index'));
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Metric->id = $id;
		if (!$this->Metric->exists()) {
			throw new NotFoundException(__('Invalid metric'));
		}
		$this->set('metric', $this->Metric->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Metric->create();
			if ($this->Metric->save($this->request->data)) {
				$this->Session->setFlash(__('The metric has been saved'));
				$this->redirect(array('action' => 'assign'));
			} else {
				$this->Session->setFlash(__('The metric could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Metric->id = $id;
		if (!$this->Metric->exists()) {
			throw new NotFoundException(__('Invalid metric'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Metric->save($this->request->data)) {
				$this->Session->setFlash(__('The metric has been saved'));
				$this->redirect(array('action' => 'assign'));
			} else {
				$this->Session->setFlash(__('The metric could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Metric->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Metric->id = $id;
		if (!$this->Metric->exists()) {
			throw new NotFoundException(__('Invalid metric'));
		}
		if ($this->Metric->delete()) {
			$this->Session->setFlash(__('Metric deleted'));
			$this->redirect(array('action' => 'assign'));
		}
		$this->Session->setFlash(__('Metric was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
