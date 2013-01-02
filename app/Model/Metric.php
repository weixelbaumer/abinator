<?php
App::uses('AppModel', 'Model');
/**
 * Experiment Model
 *
 * @property experimentuser $experimentuser
 */
class Metric extends AppModel {

	public $recursive = -1;

	public $order = "Metric.name";

	public $hasAndBelongsToMany = array(
        'User' =>
            array(
                'className'              => 'User',
                'joinTable'              => 'metrics_users',
                'foreignKey'             => 'metric_id',
                'associationForeignKey'  => 'user_id',
                'unique'                 => true
            )
    );

    //Update metrics for all users
	public function assign(){
		$this->query('TRUNCATE TABLE metrics_users');
		$metrics = $this->find('all');
		foreach($metrics as $metric){
			$metric_id = $metric['Metric']['id'];
            $allUserIds = 'SELECT '.$this->User->primaryKey.' as userid FROM '.$this->User->useTable;
			$definition = str_replace('%segment%', $allUserIds, $metric['Metric']['metric']);
			$query = "
					INSERT INTO metrics_users (metric_id, user_id, value)
					select metric_id as metric_id, ll.userid as user_id, metric as value from
					(select $metric_id as metric_id) mm
					join
					($definition) ll
					on 1=1
					WHERE metric IS NOT NULL
					";
			$this->query($query);
		}
	}

}
