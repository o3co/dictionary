<?php
namespace O3Co\Dictionary\Loader;

use Symfony\Component\Config\FileLocatorInterface;

/**
 * FileLoader 
 * 
 * @uses ArrayLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class FileLoader extends ArrayLoader
{
	private $locator;

	public function __construct(FileLocatorInterface $locator)
	{
		$this->locator = $locator;
	}

	public function load($resource)
	{
		$path = $this->locator->locate($resource);

		$content = $this->loadFile($path);

		return parent::load($content);
	}

	abstract public function loadFile($filepath);
	//public function loadFile($file)
	//{
	//	if (!stream_is_local($file)) {
    //        throw new \InvalidArgumentException(sprintf('This is not a local file "%s".', $file));
    //    }

    //    if (!file_exists($file)) {
    //        throw new \InvalidArgumentException(sprintf('The service file "%s" is not valid.', $file));
    //    }

	//	$content = file_get_contents($file);

	//	// convert to rows
	//	return $this->parseFileContent($content);
	//}
    
    public function getLocator()
    {
        return $this->locator;
    }
    
    public function setLocator(FileLocatorInterface $locator)
    {
        $this->locator = $locator;
        return $this;
    }
}

