<?php
App::uses('AppModel', 'Model');

class User extends AppModel {

	public $useTable = 'users';
    public $primaryKey = 'id';

	public $hasAndBelongsToMany = array(
        'Metric' =>
            array(
                'className'              => 'Metric',
                'joinTable'              => 'metrics_users',
                'foreignKey'             => 'user_id',
                'associationForeignKey'  => 'metric_id',
                'unique'                 => true
            ),
		'Segment' =>
            array(
                'className'              => 'Segment',
                'joinTable'              => 'segments_users',
                'foreignKey'             => 'user_id',
                'associationForeignKey'  => 'segment_id',
                'unique'                 => true
            )
    );

}
