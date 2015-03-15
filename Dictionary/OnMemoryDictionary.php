<?php
namespace O3Co\Dictionary\Dictionary;

use O3Co\Dictionary\Dictionary;
use O3Co\Dictionary\Term;

/**
 * OnMemoryDictionary 
 * 
 * @uses Dictionary
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class OnMemoryDictionary implements Dictionary, \Countable, \IteratorAggregate 
{
	/**
	 * terms 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $terms;

	/**
	 * indexes 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $indexes;

	/**
	 * indexedBy 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $indexedBy;

	public function __construct(array $terms = array(), $indexedBy = 'id')
	{
		$this->indexes = false;
		$this->indexedBy = $indexedBy;

		foreach($terms as $term) {
			$this->add($term);
		}
	}

	/**
	 * add 
	 * 
	 * @param Term $data 
	 * @access public
	 * @return void
	 */
	public function add(Term $term)
	{
		$this->terms[] = $term;

		$this->indexes = false;

		return $this;
	}

	/**
	 * find 
	 * 
	 * @param mixed $id 
	 * @access public
	 * @return void
	 */
	public function find($id)
	{
		if(!$this->indexes) {
			$this->index($this->indexedBy);
		}
		if(!isset($this->indexes[$id])) {
			return false;
		}
		
		return $this->indexes[$id];
	}

	/**
	 * findBy 
	 * 
	 * @param mixed $field 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function findBy($field, $key)
	{
		foreach($this->terms as $term) {
			if($key === $term->get($field)) {
				return $term;
			}
		}

		return false;
	}

	public function getIndexes()
	{
		return $this->indexes;
	}

	public function index($indexBy)
	{
		$this->indexedBy = $indexBy;
		$this->indexes = array();

		foreach($this->terms as $term) {
			$this->indexes[strtolower($term->get($this->indexedBy))] = $term;
		}

		return $this->indexes;
	}

	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	public function count()
	{
		return count($this->terms);
	}

	/**
	 * getIterator 
	 * 
	 * @access public
	 * @return void
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->terms);
	}
}

