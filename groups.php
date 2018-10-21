<?php

namespace Earth3300\EC01;

/**
 * Creates Groups.
 *
 * This file begins the difficult task of dividing people into groups.
 * The other way of looking at this is to create groups into which go people.
 * This second way of looking things may be easier.
 *
 * Last Updated: 2018-10-21 12:20 PM EST
 */

/**
 * Groups
 */
class Groups
{
	protected $opts = [
		'max' => 3,
		'max_hues' => 1,
		'offset' => 12,
		'level_one_offset' => 12,
		'level_two_offset' => 4,
		'level_three_offset' => 6,
		'level_four_offset' => 8,
		'inc_h' => 45,
		'level_one_groups' => 4,
		'level_one_inc_hue' => 45,
		'level_two_groups' => 6,
		'level_two_inc_hue' => 60,
		'level_three_groups' => 8,
		'level_three_inc_hue' => 45,
		'level_four_groups' => 8,
		'level_four_inc_hue' => 45,
		'inc_s' => 20,
		'level_one_sat' => 50,
		'level_two_sat' => 33,
		'level_three_sat' => 50,
		'level_four_sat' => 50,
		'inc_l' => 25,
		'level_one_lit' => 30,
		'level_two_lit' => 80,
		'level_three_lit' => 30,
		'level_four_lit' => 30,
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

		if ( 0 )
		{
			$colors = $this->generateColors();
			$article = $template->getGroupsHTML( $groups, $colors );
		}
		elseif( 1 )
		{
			$colors = $this->generateLevelOne();
			$article = $template->getLevelOneHTML( $colors );
		}
		else
		{
			$colors = $this->generateColors();
			$article = $template->getColorHTML( $colors );
		}
		$page = $template->getPageHTML( $article );

		$printed = $this->printHTMLPage( 'self', $page );

		return $page;
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
	 * Generate Level One Colors.
	 *
	 * Cycle through the hues, n times, for each level. Then repeat for next
	 * level, changing the hue or saturation to show a difference. Maximum,
	 * three levels.
	 *
	 * For each hue, pick a saturation and lightness, then work through
	 * the hue divisions and fill out blocks with these different hues.
	 *
	 * @return array
	 */
	private function generateLevelOne()
	{
		$colors = [];
		$degrees = $this->getDegrees( $this->opts['level_one_groups'] );

		for( $h1=0; $h1 < 360 / $degrees; $h1++ )
		{
			$colors[$h1]['hue']['h'] = $h1 * $degrees + $this->opts['level_one_offset'];
			$colors[$h1]['hue']['s'] = $this->opts['level_one_sat'];
			$colors[$h1]['hue']['l'] = $this->opts['level_one_lit'];
			$colors[$h1]['hue']['two'] = $this->generateLevelTwo( $h1 );
		}
		return $colors;
	}

	/**
	 * Generate Level Two Colors
	 *
	 * Cycle through the hues, n times, for each level. Then repeat for next
	 * level, changing the hue or saturation to show a difference. Maximum,
	 * three levels.
	 *
	 * For each hue, pick a saturation and lightness, then work through
	 * the hue divisions and fill out blocks with these different hues.
	 *
	 * For saturation, pick values between about 85% and 30%. A higher saturation
	 * value indicates a purer color. A lower value tends toward grey. However no
	 * saturation means grey, which we don't want, so we need to stay above a value
	 * that allows us to still see the color. Saturation stays the same within
	 * each level. It increases by one unit for each additional level.
	 *
	 * @return array
	 */
	private function generateLevelTwo( $h1 )
	{
		$colors = [];
		$degrees = $this->getDegrees( $this->opts['level_two_groups'] );
		$increment = $this->getIncrement( $this->opts['level_two_groups'] );

		for( $h2=0; $h2 < 360 / $degrees; $h2++ )
		{
			//$saturation = $this->opts['level_two_sat'] + $this->opts['level_two_offset'] * $h1;
			$saturation = 100 - ( ( $h1 + 1 ) * $increment );
			$colors[$h2]['h'] = $h2 * $degrees + $this->opts['level_two_offset'] * 2;
			$colors[$h2]['s'] = $saturation;
			$colors[$h2]['l'] = $this->opts['level_two_lit'];
			$colors[$h2]['three'] = $this->generateLevelThree( $h1, $h2 );
		}
		return $colors;
	}

	/**
	 * Generate Level Three Colors
	 *
	 * Cycle through the hues, n times, for each level. Then repeat for next
	 * level, changing the hue or saturation to show a difference. Maximum,
	 * three levels.
	 *
	 * For each hue, pick a saturation and lightness, then work through
	 * the hue divisions and fill out blocks with these different hues.
	 *
	 * @return array
	 */
	private function generateLevelThree( $h1, $h2 )
	{
		$num = ( $h1 + 1 ) * ( $h2 + 1 );
		$colors = [];
		$degrees = $this->getDegrees( $this->opts['level_three_groups'] );
		$increment = $this->getIncrement( $this->opts['level_three_groups'] );
		for( $h3=0; $h3 < 360 / $degrees; $h3++ )
		{
			$colors[$h3]['h'] = $h3 * $degrees + $this->opts['level_three_offset'] * 3;
			$colors[$h3]['s'] = $this->opts['level_three_sat'] + $this->opts['level_two_offset'];
			$colors[$h3]['l'] = $this->opts['level_three_lit'] + $this->opts['level_three_offset'] * $increment;
			$colors[$h3]['four'] = $this->generateLevelFour( $h1, $h2, $h3 );
		}
		return $colors;
	}

	/**
	 * Generate Level Four Colors
	 *
	 * Cycle through the hues, n times, for each level. Then repeat for next
	 * level, changing the hue or saturation to show a difference. Maximum,
	 * three levels.
	 *
	 * For each hue, pick a saturation and lightness, then work through
	 * the hue divisions and fill out blocks with these different hues.
	 *
	 * @return array
	 */
	private function generateLevelFour( $h1, $h2, $h3 )
	{
		$colors = [];
		$degrees = $this->getDegrees( $this->opts['level_four_groups'] );
		$increment = $this->getIncrement( $this->opts['level_four_groups'] );

		for( $h4=0; $h4 < 360 / $degrees; $h4++ )
		{
			$colors[$h4]['h'] = $h4 * $degrees; + $this->opts['level_four_offset'] * 4;
			$colors[$h4]['s'] = $this->opts['level_four_sat'];
			$colors[$h4]['l'] = $this->opts['level_four_lit'];
		}
		return $colors;
	}

	/**
	 * Generate the colors.
	 *
	 * @return array
	 */
	private function generateColors()
	{
		$colors = [];

		$inc_h = $this->opts['inc_h'];
		$inc_s = $this->opts['inc_s'];
		$inc_l = $this->opts['inc_l'];

		$i = 0;

		// generate a hue set first.
		// Then for each hue set, generate a bunch of other colors.

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

							// ~25% increments
							$colors[$i]['s'] = $s * $inc_s;

							// ~25% increments
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
	 * Gets Degrees of Separation Between Hues Based on the Number of Groups Needed.
	 *
	 * Gets the degrees of saturation between the hues based on
	 * how many groups are needed.
	 *
	 * @param $num_groups
	 *
	 * @return integer $degrees
	 */
	private function getDegrees( $num_groups )
	{
		$degrees = 360 / $num_groups;
		return $degrees;
	}

	/**
	 * Gets Increment
	 *
	 * Gets the increment based on number of groups
	 *
	 * @param $num_groups
	 *
	 * @return integer $increment
	 */
	private function getIncrement( $num_groups )
	{
		$increment = 100 / $num_groups;
		return $increment;
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
		if ( isset( $hsl['h'] ) && isset( $hsl['s'] ) && isset( $hsl['l'] ) )
		{
			$hsl = sprintf( '(%s, %s, %s)',
						   number_format( $hsl['h'], 0 ),
						   number_format( $hsl['s'], 0 ),
						   $hsl['l'] );
		}
		else
		{
			$hsl = '';
		}
		return $hsl;
	}

	/**
	 * Get the HSL value formatted for Styling
	 *
	 * @pararm array $hsl
	 *
	 * @return string
	 */
	protected function getHSLStyle( $hsl, $type = 'background' )
	{
		if ( isset( $hsl['h'] ) && isset( $hsl['s'] ) && isset( $hsl['l'] ) )
		{
			if ( $type == 'border' )
			{
				$hsl = sprintf( 'hsl(%s, %s%%, %s%%);', number_format( $hsl['h'], 0 ), $hsl['s'], $hsl['l'] );
			}
			elseif ( $type == 'background' )
			{
				$hsl = sprintf( 'hsl(%s, %s%%, %s%%);', number_format( $hsl['h'], 0 ), $hsl['s'], 80 );
			}
			elseif ( $type == 'darker' )
			{
				$hsl = sprintf( 'hsl(%s, %s%%, %s%%);', number_format( $hsl['h'], 0 ), $hsl['s'], 25 );
			}
			elseif ( $type == 'medium' )
			{
				$hsl = sprintf( 'hsl(%s, %s%%, %s%%);', number_format( $hsl['h'], 0 ), $hsl['s'], 50 );
			}
			elseif ( $type == 'strong' )
			{
				$hsl = sprintf( 'hsl(%s, %s%%, %s%%);', number_format( $hsl['h'], 0 ), $hsl['s'], 40 );
			}
			else
			{
				$hsl = sprintf( 'hsl(%s, %s%%, %s%%);', number_format( $hsl['h'], 0 ), $hsl['s'], 80 );
			}
		}
		else
		{
			$hsl = false;
		}
		return $hsl;
	}

	/**
	 * Get the HSL value formatted for Styling
	 *
	 * @pararm array $hsl
	 *
	 * @return string
	 */
	protected function getHSLBorder( $hsl, $level = 1 )
	{
		if ( isset( $hsl['h'] ) && isset( $hsl['s'] ) && isset( $hsl['l'] ) )
		{
			$hslStyle = sprintf( 'hsl(%s, %s%%, ',
								number_format( $hsl['h'], 0 ),
								number_format( $hsl['s'], 0 )
								);

			if ( $level == 1 )
			{
				// 25
				$hslStyle .= sprintf( '%s%%);', 25 );
			}
			elseif ( $level == 2 )
			{
				// 30
				$hslStyle .= sprintf( '%s%%);', 30 );
			}
			elseif ( $level == 3 )
			{
				// 35
				$hslStyle .= sprintf( '%s%%);', 35 );
			}
			elseif ( $level == 4 )
			{
				// 40
				$hslStyle .= sprintf( '%s%%);', 40 );
			}
			else
			{
				// 27
				$hslStyle .= sprintf( '%s%%);', 27 );
			}
		}
		else
		{
			$hslStyle = false;
		}
		return $hslStyle;
	}

	/**
	 * Gets the HSL value formatted for Styling.
	 *
	 * Keeps the Hue and Saturation the same. Cranks the Lightness way down.
	 *
	 * @link http://hslpicker.com/
	 *
	 * @pararm array $hsl
	 *
	 * @return string
	 */
	protected function getHSLBackgroundColor( $hsl, $level = 1 )
	{
		if ( isset( $hsl['h'] ) && isset( $hsl['s'] ) && isset( $hsl['l'] ) )
		{
			$hslStyle = sprintf( 'hsl(%s, %s%%, ',
								number_format( $hsl['h'], 0 ),
								number_format( $hsl['s'], 0 )
								);

			if ( $level == 1 )
			{
				$hslStyle .= sprintf( '%s%%);', 85 );
			}
			elseif ( $level == 2 )
			{
				$hslStyle .= sprintf( '%s%%);', 75 );
			}
			elseif ( $level == 3 )
			{
				$hslStyle .= sprintf( '%s%%);', 70 );
			}
			elseif ( $level == 4 )
			{
				$hslStyle .= sprintf( '%s%%);', 65 );
			}
			else
			{
				$hslStyle .= sprintf( '%s%%);', 80 );
			}
		}
		else
		{
			$hslStyle = false;
		}
		return $hslStyle;
	}

	/**
	 *
	 */
	protected function getBackground( $color, $num )
	{
		if ( ! isset( $color['h'] ) || ! isset( $color['s'] ) || ! isset( $color['l'] ) )
		{
			//var_dump( $color );
		}

		if ( isset( $color['h'] ) && isset( $color['s'] ) && isset( $color['l'] ) )
		{
			$hsl = sprintf( 'hsl(%s, %s%%, %s%%)', $color['h'], $color['s'], $color['l'] );
		}
		else
		{
			$hsl = 'hsl( 36, 75%, 75%)';
		}

		$data = [
			1 => 'tile-3px.png',
			2 => 'graph.png',
			3 => 'asphalt.png',
			4 => 'basketball.png',
			5 => 'bricks.png',
			6 => 'felt.png',
			7 => 'leaves.png',
		];
		$url = '/0/theme/image/background';
		$url .= isset( $data[$num] ) ? '/' . $data[$num] : $data[6];
		$background = sprintf(' background: %s url(%s);', $hsl, $url );
		return $background;
	}

	/**
	 * Get the Text Color.
	 *
	 * Tricky.
	 */
	protected function getTextColor( $color )
	{
		if ( isset( $hsl['h'] ) )
		{
				$hsl = $color;
				$hsl_sum = $hsl['h'] + $hsl['s'] + $hsl['l'];
			if ( $hsl_sum <= 255 ) {
				$color = '#fff;';
			}
			else {
				$color = '#000;';
			}
		}
		else
		{
			$color = '#000;';
		}
		return $color;
	}

	/**
	 * Gets the Color Id.
	 *
	 * Id is built on HSL as a nine digit string character.
	 * Unique for each "bin". Increments by one (or more) for each additional
	 * layer of level one or two. Does not repeat.
	 *
	 * @param array $color
	 *
	 * @return string|boolean
	 */
	protected function getColorID( $color )
	{
		if ( ! isset( $color['h'] ) || ! isset( $color['s'] ) || ! isset( $color['l'] ) )
		{
			$color_id = false;
		}
		elseif ( isset( $color['h'] ) && isset( $color['s'] ) && isset( $color['l'] ) )
		{
			$color_id = sprintf( '%s-%s-%s',
								str_pad( $color['h'], 3, "0", STR_PAD_LEFT ),
								str_pad( number_format( $color['s'], 0 ), 3, "0", STR_PAD_LEFT ) ,
								str_pad( $color['l'], 3, "0", STR_PAD_LEFT )
								);
		}
		else
		{
			$color_id = '000000000';
		}

		return $color_id;
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
