<?php

/**
 * Creates Groups.
 *
 * This file begins the difficult task of dividing people into groups.
 * The other way of looking at this is to create groups into which go people.
 * This second way of looking things may be easier.
 */

/**
 * Groups
 */
class Groups
{
	protected $opts = [
		'max' => 48,
		'max_hues' => 8,
		'offset' => 4,
		'inc_h' => 45,
		'inc_s' => 20,
		'inc_l' => 25,
		'hsl' => [
		'h' => [ 'min' => 0, 'max' => 360 ],
		's' => [ 'min' => 0, 'max' => 100 ],
		'l' => [ 'min' => 0, 'max' => 100 ],
		],
		'allow_print' => true,
		'print_file_name' => 'index.html',
		];

	/**
	 * Get the goods
	 *
	 * 	hsl(0, 0%, 0%);
	 */
	public function get( $args=null )
	{
		$this->load();

		$groups[] = get_level_one_data();

		$groups[] = get_level_two_data();

		$groups[] = get_level_three_data();

		$template = new GroupsTemplate();

		if ( $colors = $this->generate() )
		{
			$article = $template->getGroupsHTML( $groups, $colors );

			$page = $template->getPageHTML( $article );

			$printed = $this->printHTMLPage( 'self', $page );

			return $page;
		}
		else {
			return 'N/A';
		}
	}

	/**
	 * Load the files.
	 */
	private function load()
	{
		require_once( __DIR__ . '/data.php' );
		require_once( __DIR__ . '/template.php' );
	}

	/**
	 * Generate the colors.
	 *
	 * @return array
	 */
	private function generate()
	{
		$colors = [];

		$hsl['h'] = 0;
		$hsl['s'] = 0;
		$hsl['l'] = 0;

		$inc_h = $this->opts['inc_h'];
		$inc_s = $this->opts['inc_s'];
		$inc_l = $this->opts['inc_l'];

		/**
		 * For each run through the loop, we need a distinct color.
		 * This means all the values of H, S and L need to be complete,
		 * for a single index value.
		 */
		$i = 0;

		for( $h=0; $h < 360 / $inc_h; $h++ )
		{
			if ( $h <= $this->opts['max_hues']  )
			{
				for( $s=1; $s < 100 / $inc_s; $s++ )
				{
					for( $l=1; $l < 100 / $inc_l; $l++ )
					{
						if ( $l * $inc_l < 40 || $l * $inc_l > 60 ) {
							//variable increments
							$colors[$i]['h'] = $h * $inc_h + $this->opts['offset'];

							//25% increments
							$colors[$i]['s'] = $s * $inc_s;

							//25% increments
							if ( $l * $inc_l > 60 )
							{
								$colors[$i]['l'] = $l * $inc_l - 8;
							}
							else
							{
								$colors[$i]['l'] = $l * $inc_l + 4;

							}
							$i++;
						}
					}
				}
			}
		}

		return $colors;
	}

	/**
	 * Group
	 *
	 * Sort the colors into a group.
	 *
	 * @param array $colors
	 *
	 * @return
	 */
	private function group( $colors )
	{
		foreach( $colors as $color ){

		}
	}

	/**
	 * Sort Array By the Value of a Key
	 *
	 * The key 'nm' does not exist in all cases.
	 *
	 * @param $sort_arr
	 * @param $sort_key
	 *
	 * @return array
	 */
	private function sortArrayByKey( $sort_arr, $sort_key )
	{
		$items = Array();

		foreach( $sort_arr as $key => $row )
		{
			if( isset( $row[$sort_key] ) )
			{
				$items[$key] = $row[$sort_key];
			}
			else
			{
				$items[$key] = $row[$key];
			}
		}
		//array sizes inconsistent
		array_multisort($items, SORT_FLAG_CASE | SORT_NATURAL, $sort_arr);

		return $sort_arr;
	}

	/**
	 * Get the Color Name from the Color Values.
	 *
	 * (As needed).
	 *
	 * @param array $color
	 *
	 * @return string
	 */
	private function getColorName( $color )
	{
		$name = '';
		if
		(
			$color->h >= 260 && $color->h <= 338
			&& $color->s == 0
			&& $color->l >= 34 && $color->l <= 50
		)
		{
			$name = 'violet';
		}
		else if
		(
			$color->h >= 189 && $color->h <= 218
			&& $color->s == 100
			&& $color->l >= 18 && $color->l <= 50
		)
		{
			$name = 'blue';
		}
		else if
		(
			$color->h >= 78 && $color->h <= 98
			&& $color->s == 100
			&& $color->l >= 34 && $color->l <= 50
		)
		{
			$name = 'green';
		}
		else if
		(
			$color->h >= 49 && $color->h <= 51
			&& $color->s == 100
			&& $color->l >= 42 && $color->l <= 50
		)
		{
			$name = 'yellow';
		}
		else if
		(
			$color->h >= 22 && $color->h <= 23
			&& $color->s == 100
			&& $color->l == 50
		)
		{
			$name = 'orange';
		}
		else if
		(
			$color->h == 0
			&& $color->s == 100
			&& $color->l >= 18 && $color->l <= 50
		)
		{
			$name = 'red';
		}
		return $name;
	}

	/**
	 * Get the HSL value as a Comma Separated String
	 *
	 * @pararm array $hsl
	 *
	 * @return string
	 */
	protected function getHSLValue( $hsl )
	{
		$hsl = sprintf( '(%s, %s, %s)', number_format( $hsl['h'], 0 ), $hsl['s'], $hsl['l'] );
		return $hsl;
	}

	/**
	 * Get the Text Color.
	 *
	 * Tricky.
	 */
	protected function getTextColor( $color )
	{
		$hsl = $color;
		$hsl_sum = $hsl['h'] + $hsl['s'] + $hsl['l'];
		if ( $hsl_sum <= 255 ) {
			$color = '#fff';
		}
		else {
			$color = '#000';
		}
		return $color;
	}

	/**
	 * Print the HTML Page.
	 *
	 * 1. Load the print file (If it exists).
	 * 2. Print the file.
	 * 3. Return the value.
	 *
	 * @param string $file
	 * @param string $html
	 *
	 * @return bool
	 */
	private function printHTMLPage( $file, $html )
	{
		if
		(
			$this->opts['allow_print']
			&& file_exists( __DIR__ . '/print.php' )
			&& isset( $_GET['print'] )
		)
		{
			require_once( __DIR__ . '/print.php' );

			if ( $file == 'self' )
			{
				$file = __DIR__ . '/' . $this->opts['print_file_name'];
			}
			else
			{
				$file = __DIR__ . '/' . $file;
			}

			$printPage = new PrintGroupsPage();

			$success = $printPage->print( $file, $html );

			if ( $success !== false )
			{
				$success = true;
			}
			else
			{
				$success = false;
			}
		}
		else
		{
			$success = false;
		}
		return $success;
	}
}

/**
 * Groups.
 *
 * Global function.
 */
function groups( $args = null )
{
	$groups = new Groups();
	echo $groups -> get();
}

if( function_exists( 'add_shortcode' ) )
{
	// No direct access.
	defined('ABSPATH') || exit('No direct access.');

	//shortcode [group]
	add_shortcode( 'group', 'group' );
}
else
{
	/**
	 * Outside of WordPress. Instantiate directly, assuming current directory.
	 *
	 * @return string
	 */

	/** No direct access */
	define('NDA', true);

	$groups = new Groups();
	echo $groups -> get();
}
