<?php
namespace O3Co\Dictionary\Loader;

use Symfony\Component\Config\FileLocatorInterface;
/**
 * CsvFileLoader 
 * 
 *   Cols can be ["id", "name", "tag[]", "tag[]"] something like this.
 *   we once convert the csv to queryString, and then parse the queryString to data.
 * @uses FileLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class CsvFileLoader extends FileLoader 
{
	private $cols = array();

	private $delimiter;

	private $enclosure;

	private $escape;

	private $isHeaderIncluded;

	public function __construct(FileLocatorInterface $locator, array $cols, $isHeaderIncluded = false, $delimiter = ',', $enclosure = '"', $escape = '\\')
	{
		parent::__construct($locator);

		$this->cols = $cols;
		$this->isHeaderIncluded = $isHeaderIncluded;
		$this->delimiter = $delimiter;
		$this->enclosure = $enclosure;
		$this->escape = $escape;
	}
	
	public function loadFile($file)
	{
		$loaded = array();
		if (!stream_is_local($file)) {
            throw new InvalidResourceException(sprintf('This is not a local file "%s".', $file));
        }

        if (!file_exists($file)) {
            throw new NotFoundResourceException(sprintf('File "%s" not found.', $file));
        }

        try {
            $file = new \SplFileObject($file, 'rb');
        } catch (\RuntimeException $e) {
            throw new NotFoundResourceException(sprintf('Error opening file "%s".', $file), 0, $e);
        }

        $file->setFlags(\SplFileObject::READ_CSV | \SplFileObject::SKIP_EMPTY);
        $file->setCsvControl($this->delimiter, $this->enclosure, $this->escape);
		
		$contents = array();
        foreach ($file as $line => $row) {
			// skip row started with '#'
            if (0 === strpos('#', $row[0])) {
                continue;
            }

			$rowData = $this->formatRow($row);
			if($rowData) {
				$loaded[] = $rowData;
			}
        }

        return $loaded;
	}

	protected function formatRow($row)
	{
		$temp = array();
		foreach($this->cols as $idx => $field) {
			if($field && isset($row[$idx])) {
				$temp[] = urlencode($field) . '=' . urlencode($row[$idx]);
			}
		}

		if(!empty($temp)) {
			parse_str(implode('&', $temp), $rowData);

			return $rowData;
		}

		return false;
	}

	public function getColumns()
	{
		return $this->cols;
	}
}


