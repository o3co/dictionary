<?php
namespace O3Co\Dictionary;

/**
 * Loader 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Loader
{
	/**
	 * load 
	 * 
	 * @param mixed $resource 
	 * @access public
	 * @return void
	 */
	function load($resource);
}

