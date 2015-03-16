<?php
namespace O3Co\Dictionary\Dictionary;

use O3Co\Dictionary\Dictionary;
use O3Co\Dictionary\Term;
use O3Co\Dictionary\Indexer;
use O3Co\Dictionary\Indexer\ArrayIndexer;

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
	 * indexer
	 * 
	 * @var mixed
	 * @access private
	 */
	private $indexer;

	/**
	 * indexedBy 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $indexedBy;

	public function __construct(array $terms = array(), Indexer $indexer = null)
	{
		foreach($terms as $term) {
			$this->add($term);
		}

		// DefaultIndexer just pass the ArrayIterator of Terms 
		$this->indexer = $indexer;
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

		$this->getIndexer()->reset();

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
		return $this->getIndexer()->get($id);
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

	public function getIndexer()
	{
		if(!$this->indexer) {
			$this->indexer = new ArrayIndexer($this);
		}
		return $this->indexer;
	}

	public function setIndexer(Indexer $indexer)
	{
		$this->indexer = $indexer;
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
		return $this->getIndexer()->getIterator();
	}

	public function getTerms()
	{
		return $this->terms;
	}
}

