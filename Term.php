<?php
namespace O3Co\Dictionary;

/**
 * Term 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Term
{
	/**
	 * set
	 * 
	 * @param mixed $field 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	function set($field, $data);

	/**
	 * get
	 *   Get field value 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function get($field);
}

