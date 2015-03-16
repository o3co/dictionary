<?php
namespace O3Co\Dictionary;

/**
 * Dictionary 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Dictionary
{
	/**
	 * find 
	 *    Find data with identifier 
	 * @access public
	 * @return void
	 */
	function find($id);

	/**
	 * findBy 
	 *    Find data by field value 
	 * @param mixed $field 
	 * @param mixed $key
	 * @access public
	 * @return void
	 */
	function findBy($field, $key);

	/**
	 * getIndexer 
	 * 
	 * @access public
	 * @return void
	 */
	function getIndexer();

	/**
	 * setIndexer 
	 * 
	 * @param Indexer $indexer 
	 * @access public
	 * @return void
	 */
	function setIndexer(Indexer $indexer);
}

