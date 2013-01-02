<?php
App::uses('AppController', 'Controller');
/**
 * Dashboards Controller
 *
 * @property Dashboard $Dashboard
 */
class DashboardsController extends AppController {
	public $components = array('Stats');
	public $baseline = 'Baseline';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Dashboard->recursive = 0;
		$this->set('dashboards', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id) {
		$dashboard = $this->Dashboard->read(null, $id);
		$segment_ids = array();
		foreach($dashboard['Segment'] as $segment){
			 array_push($segment_ids, $segment['id']);
		}

		$segmentMetrics = $this->Dashboard->Segment->getSegmentMetrics();
		$all = $segmentMetrics;

		foreach($segmentMetrics as $k => &$segmentMetric){
			//Sort out segments without baselines or not in this dashboard
			if($segmentMetric['Segment']['baseline_id'] == null || !in_array($segmentMetric['Segment']['id'], $segment_ids)){
				unset($segmentMetrics[$k]);
				continue;
			}

            $segmentMetric['Baseline'] = $all[$segmentMetric['Segment']['baseline_id']];

			foreach($segmentMetric['Metric'] as $k => &$metric){
				$baseline_metric = $segmentMetric['Baseline']['Metric'][$k];
				$metric['pvalue'] = $this->Stats->twoSampleTTest($metric['avg'], $baseline_metric['avg'], $metric['var'], $baseline_metric['var'], $segmentMetric['Segment']['count'], $segmentMetric['Baseline']['Segment']['count']);
				
			}
		}

		$this->set(compact('dashboard','segmentMetrics'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Dashboard->create();
			if ($this->Dashboard->save($this->request->data)) {
				$this->Session->setFlash(__('The dashboard has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dashboard could not be saved. Please, try again.'));
			}
		}
		$segments = $this->Dashboard->Segment->find('list', array(
			'conditions' => array(
				array("NOT" => array(
						"baseline_id" => null
					)
				)
			)
		));
		$this->set(compact('segments'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Dashboard->id = $id;
		if (!$this->Dashboard->exists()) {
			throw new NotFoundException(__('Invalid dashboard'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Dashboard->save($this->request->data)) {
				$this->Session->setFlash(__('The dashboard has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dashboard could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Dashboard->read(null, $id);
		}
		$segments = $this->Dashboard->Segment->find('list', array(
			'conditions' => array(
				array("NOT" => array(
						"baseline_id" => null
					)
				)
			)
		));
		$this->set(compact('segments'));
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
		$this->Dashboard->id = $id;
		if (!$this->Dashboard->exists()) {
			throw new NotFoundException(__('Invalid dashboard'));
		}
		if ($this->Dashboard->delete()) {
			$this->Session->setFlash(__('Dashboard deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Dashboard was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
