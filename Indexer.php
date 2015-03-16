<?php
namespace O3Co\Dictionary;

/**
 * Indexer 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Indexer extends \IteratorAggregate
{
	/**
	 * getDictionary 
	 * 
	 * @access public
	 * @return void
	 */
	function getDictionary();

	/**
	 * getIterator 
	 * 
	 * @access public
	 * @return void
	 */
	function getIterator();

	/**
	 * get 
	 * 
	 * @access public
	 * @return void
	 */
	function get($index);

	/**
	 * reset 
	 * 
	 * @access public
	 * @return void
	 */
	function reset();
}
