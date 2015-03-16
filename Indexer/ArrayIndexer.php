<?php
namespace O3Co\Dictionary\Indexer;

use O3Co\Dictionary\Indexer;
use O3Co\Dictionary\Dictionary;

/**
 * ArrayIndexer 
 * 
 * @uses Indexer
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ArrayIndexer implements Indexer 
{
	/**
	 * dictionary 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $dictionary;

	/**
	 * __construct 
	 * 
	 * @param Dictionary $dictionary 
	 * @access public
	 * @return void
	 */
	public function __construct(Dictionary $dictionary = null)
	{
		$this->dictionary = $dictionary;
	}

	/**
	 * setDictionary 
	 * 
	 * @param Dictionary $dictionary 
	 * @access public
	 * @return void
	 */
	public function setDictionary(Dictionary $dictionary)
	{
		$this->dictionary = $dictionary;
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

	/**
	 * reset 
	 * 
	 * @access public
	 * @return void
	 */
	public function reset()
	{
	}

	/**
	 * get 
	 * 
	 * @param mixed $index 
	 * @access public
	 * @return void
	 */
	public function get($index)
	{
		return $this->dictionary->getTerms()[$index];
	}

	/**
	 * getIterator 
	 * 
	 * @access public
	 * @return void
	 */
	public function getIterator()
	{
		return new ArrayIterator($this->dictionary->getTerms());
	}
}

