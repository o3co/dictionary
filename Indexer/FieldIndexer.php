<?php
namespace O3Co\Dictionary\Indexer;

use O3Co\Dictionary\Dictionary;
use O3Co\Dictionary\Indexer;

/**
 * FieldIndexer 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FieldIndexer implements Indexer
{
	/**
	 * dictionary 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $dictionary;
 
	/**
	 * indecies 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $indecies;

	/**
	 * indexField 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $indexField;

	/**
	 * __construct 
	 * 
	 * @param Dictionary $dictionary 
	 * @param string $field 
	 * @access public
	 * @return void
	 */
	public function __construct(Dictionary $dictionary, $field = 'id')
	{
		$this->dictionary = $dictionary;
		$this->indexField = $field;

		// 
		$this->reset();
	}

	/**
	 * reset 
	 * 
	 * @access protected
	 * @return void
	 */
	public function reset()
	{
		$this->indecies = false;
	}

	protected function prepare()
	{
		$this->indecies = array();
		foreach($this->getDictionary()->getTerms() as $term) {
			if($term->has($this->indexField)) {
				$index = strtolower($term->get($this->indexField));

				$indecies[$index] = $term;
			}
		}
		$this->indecies = $indecies;
	}

	public function get($index)
	{
		if(!$this->indecies) 
			$this->prepare();

		return isset($this->indecies[$index]) 
			? $this->indecies[$index]
			: false;
	}

	public function getIndecies()
	{
		if(!$this->indecies) {
			$this->prepare();
		}
		return $this->indecies;
	}

	/**
	 * getIterator 
	 * 
	 * @access public
	 * @return void
	 */
	public function getIterator()
	{
		if(!$this->indecies) {
			$this->prepare();
		}
		return new \ArrayIterator($this->indecies);
	}

	/**
	 * getDictionary 
	 * 
	 * @access public
	 * @return void
	 */
	public function getDictionary()
	{
		return $this->dictionary;
	}
}

