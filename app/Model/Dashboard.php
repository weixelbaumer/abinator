<?php
App::uses('AppModel', 'Model');
/**
 * Dashboard Model
 *
 */
class Dashboard extends AppModel {
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'dashboards';
/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'id';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	public $hasAndBelongsToMany = array(
        'Segment' => array(
            'className'              => 'Segment',
            'joinTable'              => 'dashboards_segments',
            'foreignKey'             => 'segment_id',
            'associationForeignKey'  => 'dashboard_id',
            'unique'                 => true
        )
    );
}
