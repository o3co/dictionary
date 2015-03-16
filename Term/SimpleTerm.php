<?php
namespace O3Co\Dictionary\Term;

use O3Co\Dictionary\Term;

/**
 * SimpleTerm 
 * 
 * @uses Term 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SimpleTerm implements Term 
{
	private $data;

	/**
	 * __construct 
	 * 
	 * @param array $data 
	 * @access public
	 * @return void
	 */
	public function __construct(array $data = array())
	{
		$this->data    = array();
		
		foreach($data as $key => $value) {
			$this->set($key, $value);
		}
	}

	public function has($field)
	{
		return isset($this->data[$field]);
	}

	/**
	 * set 
	 * 
	 * @param mixed $field 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($field, $value)
	{
		$this->data[$this->formatField($field)] = $value;
	}

	/**
	 * get
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function get($field)
	{
		return $this->data[$this->formatField($field)];
	}

	/**
	 * formatField 
	 * 
	 * @param mixed $key 
	 * @access protected
	 * @return void
	 */
	protected function formatField($key)
	{
		// fixme: 
		//return Util::snakize($key);
		return $key;
	}

	/**
	 * __get 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function __get($field)
	{
		return $this->get($field);
	}

	/**
	 * __call 
	 * 
	 * @param mixed $method 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function __call($method, array $args = array())
	{
		if(0 === strpos('get', $method)) {
			$field = substr($method, 3);

			return $this->get($field);
		}

		throw new \Exception(sprintf('Method "%s::%s" dose not exsists', get_class($this), $method));
	}
}

