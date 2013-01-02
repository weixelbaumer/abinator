<?php
App::uses('AppModel', 'Model');
/**
 * Segment Model
 *
 */
class Segment extends AppModel {
	public $recursive = -1;

	public $hasAndBelongsToMany = array(
        'User' => array(
            'className'              => 'User',
            'joinTable'              => 'segments_users',
            'foreignKey'             => 'segment_id',
            'associationForeignKey'  => 'user_id',
            'unique'                 => true
        )
    );

	public $belongsTo = array(
        'Baseline' => array(
            'className'              => 'Segment',
            'foreignKey'             => 'baseline_id',
        )
    );


    //Update all segments
	public function assign(){
		$this->query('TRUNCATE TABLE segments_users');
		$segments = $this->find('all');
		foreach($segments as $segment){
			$query = "
					INSERT INTO segments_users (segment_id, user_id) select %segmentid% as segment_id, ".$this->User->useTable.'.'.$this->User->primaryKey." as user_id from ".$this->User->useTable."
					join
					(%segment%) segment
					on segment.userid = ".$this->User->useTable.'.'.$this->User->primaryKey;
			$query = str_replace('%segment%', $segment['Segment']['segment'], $query);
			$query = str_replace('%segmentid%', $segment['Segment']['id'], $query);
			$this->query($query);
		}
	}

    //Get metrics for all segments
	public function getSegmentMetrics(){
		$segmentMetrics = $this->query("
			select
                max(s.id) as segment_id,
                max(s.baseline_id) as baseline_id,
                max(s.name) as segment_name,
                max(m.id) as metric_id,
                max(m.name) as metric_name,
                count(value) as count,
                avg(value) as avg,
                variance(value) as variance
            from segments s
			join segments_users su on su.segment_id = s.id
			join metrics_users mu on mu.user_id = su.user_id
			join metrics m on m.id = mu.metric_id
			group by segment_id, baseline_id, metric_id
			order by segment_id DESC, metric_id DESC");

		$segments = array();
		foreach($segmentMetrics as $segmentMetric){
			$segmentMetric = $segmentMetric[0];
			$segments[$segmentMetric['segment_id']]['Segment'] = array(
				'id' => $segmentMetric['segment_id'],
				'baseline_id' => $segmentMetric['baseline_id'],
				'name' => $segmentMetric['segment_name'],
				'count' => $segmentMetric['count']
			);
			$segments[$segmentMetric['segment_id']]['Metric'][] = array(
				'id' => $segmentMetric['metric_id'],
				'name' => $segmentMetric['metric_name'],
				'avg' => $segmentMetric['avg'],
				'var' => $segmentMetric['variance']
			);
		}
		
		return $segments;

	}

}
