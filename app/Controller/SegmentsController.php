<?php
App::uses('AppController', 'Controller');
/**
 * Segments Controller
 *
 * @property Segment $Segment
 */
class SegmentsController extends AppController {

	public function assign(){
		$this->Segment->assign();
        $this->redirect(array('action' => 'index'));
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Segment->recursive = 0;
        $baselines = $this->Segment->find('list');
		$this->set('segments', $this->paginate());
		$this->set(compact('baselines'));
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Segment->id = $id;
		if (!$this->Segment->exists()) {
			throw new NotFoundException(__('Invalid segment'));
		}
		$this->set('segment', $this->Segment->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
            if ($this->request->data['Segment']['baseline_id'] == 0) {
                $this->request->data['Segment']['baseline_id'] = null;
            }
			$this->Segment->create();
			if ($this->Segment->save($this->request->data)) {
				$this->Session->setFlash(__('The segment has been saved'));
				$this->redirect(array('action' => 'assign'));
			} else {
				$this->Session->setFlash(__('The segment could not be saved. Please, try again.'));
			}
		} else {
            $baselines = $this->Segment->find('list');
            $baselines = array(0 => null) + $baselines;
            $this->set(compact('baselines'));
        }
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Segment->id = $id;
		if (!$this->Segment->exists()) {
			throw new NotFoundException(__('Invalid segment'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->request->data['Segment']['baseline_id'] == 0) {
                $this->request->data['Segment']['baseline_id'] = null;
            }
			if ($this->Segment->save($this->request->data)) {
				$this->Session->setFlash(__('The segment has been saved'));
				$this->redirect(array('action' => 'assign'));
			} else {
				$this->Session->setFlash(__('The segment could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Segment->read(null, $id);
            $baselines = $this->Segment->find('list');
            $baselines = array(0 => null) + $baselines;
            $this->set(compact('baselines'));
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
		$this->Segment->id = $id;
		if (!$this->Segment->exists()) {
			throw new NotFoundException(__('Invalid segment'));
		}
		if ($this->Segment->delete()) {
			$this->Session->setFlash(__('Segment deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Segment was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
