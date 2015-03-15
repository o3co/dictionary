<?php
namespace O3Co\Dictionary\Loader;

use O3Co\Dictionary\Loader;
use O3Co\Dictionary\Dictionary\OnMemoryDictionary;
use O3Co\Dictionary\Term\SimpleTerm;

/**
 * ArrayLoader 
 * 
 * @uses Loader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ArrayLoader implements Loader
{
	private $defaultIndexField = 'id';

	/**
	 * load 
	 * 
	 * @param mixed $resources 
	 * @access public
	 * @return void
	 */
	public function load($resources)
	{
		if(!is_array($resources)) {
			throw new \InvalidArgumentException('Content must be an array.');
		}

		return $this->parseDictionary($resources);
	}

	/**
	 * parseDictionary 
	 * 
	 * @param mixed $terms 
	 * @abstract
	 * @access public
	 * @return void
	 */
	protected function parseDictionary(array $resources)
	{
		$terms = array();
		foreach($resources as $resource) {
			$terms[] = $this->parseTerm($resource);
		}
		
		return new OnMemoryDictionary($terms, $this->defaultIndexField);
	}

	protected function parseTerm(array $resource)
	{
		$term = new SimpleTerm($resource, $this->defaultIndexField);

		return $term;
	}
    
    public function getDefaultIndexField()
    {
        return $this->defaultIndexField;
    }
    
    public function setDefaultIndexField($defaultIndexField)
    {
        $this->defaultIndexField = $defaultIndexField;
        return $this;
    }
}

