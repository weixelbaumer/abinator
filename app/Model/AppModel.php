<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

class AppModel extends Model {

	public $actsAs = array('Containable');

    public $cacheDuration = "86400 seconds";

	public $cache = false;

	public function find($conditions = null, $fields = array(), $order = null, $recursive = null) { //overwrite the normal find method
        $name = md5($this->name.serialize(func_get_args()));
        Cache::set(array('duration' => $this->cacheDuration));

        if ($this->cache !== true || ($data = Cache::read($name)) === FALSE) {
            $data = parent::find($conditions, $fields, $order, $recursive);
            Cache::write($name, $data);
        }
        return $data;
    }

	public function query($query) { //overwrite the normal query method
        $name = md5($query);
        Cache::set(array('duration' => $this->cacheDuration));

        if ($this->cache !== true || ($data = Cache::read($name)) === FALSE) {
            $data = parent::query($query);
            Cache::write($name, $data);
        }
        return $data;
    }
}
