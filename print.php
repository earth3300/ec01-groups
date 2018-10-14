<?php

defined('NDA') || exit;

/**
 * Print File.
 *
 * Prints the file to the desired location. A check is made before this file
 * is called. If this file is not present, the file will not be printed.
 */
class PrintGroupsPage extends Groups
{
	/** Default options */
	protected $opts = [

	];

	/**
	 * Print
	 *
	 * int file_put_contents (
	 *		string $filename ,
	 *		mixed $data [,
	 *		int $flags = 0 [,
	 *		resource $context ]]
	 *
	 * @param string $file  File Name.
	 * @param string $html  HTML string to write to the file.
	 *
	 * @return int (bytes) || false
	 *	)
	 */
	protected function print( $file, $html )
	{
		return file_put_contents( $file, $html );
	}
}
