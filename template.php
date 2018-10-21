<?php

namespace Earth3300\EC01;

/**
 * Groups Template
 *
 * Last Updated: 2018-10-21 12:22 PM EST
 */

defined('NDA') || exit;

/**
 * Color Template
 *
 * Generates the article HTML and Page HTML necessary to view the colors
 * in a browswer.
 *
 */
class GroupsTemplate extends Groups
{
	/** Default options */
	protected $opts = [
		'max_colors' => 4,
		'max_units_level_one' => 12,
		'max_units_level_two' => 6,
		'max_units_level_three' => 2,
		'max_units_level_four' => 1,
		'group_size' => 8,
		'use_groups' => 1,
		'show_text' => 0,
		'show_hsl' => 1,
		'show_level_three' => 1,
		'use_level_one_color_level_two_border' => 1,
		'show_level_one_count' => 0,
		'show_level_one_border_color' => 0,
		'show_level_one_background_color' => 0,
		'show_level_one_background_image' => 0,
		'show_level_two_count' => 0,
		'show_level_two_border' => 1,
		'show_level_two_background_color' => 1,
		'show_level_two_background_image' => 0,
		'show_level_two_text' => 0,
		'show_level_two_color_id' => 1,
		'show_level_three_count' => 0,
		'show_level_three_border' => 0,
		'show_level_three_background_color' => 0,
		'show_level_three_background_image' => 0,
		'show_level_three_link' => 0,
		'show_level_three_icon' => 0,
		'show_level_three_text' => 0,
		'show_level_three_color_id' => 0,
		'show_level_four' => 1,
		'show_level_four_count' => 0,
		'show_level_four_border' => 0,
		'show_level_four_background_color' => 0,
		'show_level_four_background_image' => 0,
		'show_level_four_link' => 1,
		'show_level_four_icon' => 1,
		'show_level_four_text' => 0,
		'columns' => 2,
		'columns_level_one' => 1,
		'columns_level_two' => 3,
		'columns_level_three' => 1,
		'columns_level_four' => 1,
		'use_child_css' => 0,
		'use_sprite_css' => 1,
		'level_one_border_width' => 4,
		'level_two_border_width' => 6,
		'level_three_border_width' => 2,
		'level_four_border_width' => 1,
		'page_title' => 'HSL Colors',
	];

	/**
	 * Background File Names.
	 */
	protected $backgrounds = [

		];
	/**
	 * Get Level One HTML.
	 *
	 * Nested Colors, three deep. Calls the others.
	 *
	 * @param array $colors
	 *
	 * @return string
	 */
	protected function getLevelOneHTML( $blob )
	{
		$i=0;
		$group = true;
		$cnt = count( $blob );
		$hue = 0;

		$str = '<article class="one">' . PHP_EOL;
		$str .= '<div class="json sprite" style="font-size: 80%;">' . PHP_EOL;
		$str .= '<div class="line">' . PHP_EOL;

		foreach ( $blob as $k1 => $color_l1 )
		{
			$num = $k1 + 1;
			if( $num <= $this->opts['max_units_level_one'] )
			{
				$colors = $color_l1['hue']['two'];

				$str .= '<div class="line group level-1 border" style="';
				$str .= $this->opts['show_level_one_border_color'] ? sprintf( ' border: %spx solid %s', $this->opts['level_one_border_width'], $this->getHSLBorder( $color_l1['hue'], 1 ) ) : '';
				$str .= $this->opts['show_level_one_background_color'] ? ' background: ' . $this->getHSLBackgroundColor( $color_l1['hue'], 1 ) : '';
				$str .= $this->opts['show_level_one_background_image'] ? $this->getBackground( $color_l1['hue'], $num ) : '';
				$str .= '">' . PHP_EOL;
				$str .= $this->opts['show_level_one_count'] ? sprintf( '<div style="position: absolute; top: 0; left: 1px;"><sup>%s</sup></div>%s', $num, PHP_EOL ) : '';
				foreach ($colors as $k2 => $color_l2)
				{
					if( $k2 + 1 <= $this->opts['max_units_level_two'] )
					{
						$str .= $this->getLevelTwoHTML( $color_l1['hue'], $color_l2, $k1, $k2 );
					}
					else
					{
						break;
					}
				}
				$str .= '</div><!-- .group .level-1 -->' . PHP_EOL;
			}
		}
		$str .= '</div>' . PHP_EOL;
		$str .= '</div>' . PHP_EOL;
		$str .= '</article>' . PHP_EOL;
		return $str;
	}

	/**
	 * Get Level Two HTML.
	 *
	 * The Background should be determined by the main hue, but have a lightness
	 * that is cranked way up to about the 70% or 75%, depending on the look
	 * desired. This is all down in getBackgroundColor(). The background color
	 * can also be turned off.
	 *
	 * @param array $color
	 * @param int $k
	 *
	 * @return string
	 */
	private function getLevelTwoHTML( $color_l1, $color_l2, $k1, $k2 )
	{
		$num = $k2 + 1;
		$str = sprintf( '<div class="unit level-2 size1of%s"', $this->opts['columns_level_two'] ) ;
		$str .= sprintf(' title="%s"', $this->getHSLValue( $color_l2 ), PHP_EOL );
		$str .= '>' . PHP_EOL;
		$str .= '<div class="border" style="';
		$str .= 1 ? sprintf( 'border: %spx solid %s"', $this->opts['level_two_border_width'], $this->getHSLBorder( $color_l1, 2 ) ) : '';
		$str .= '>' . PHP_EOL;
		$str .= '<div class="inner" style="' . PHP_EOL;
		$str .= $this->opts['show_level_two_background_color'] ? ' background: ' . $this->getHSLBackgroundColor( $color_l2, 2 ) : '';
		$str .= $this->opts['show_level_two_background_image'] ? $this->getBackground( $color_l2, $num ) : '';
		$str .= ' color: ' . $this->getTextColor( $color_l2 );
		$str .= '">' . PHP_EOL;
		$str .= $this->opts['show_level_one_count'] ? sprintf( '<div style="position: absolute; top: 9px; left: 9px;"><sup>%s</sup></div>%s', $num, PHP_EOL ) : '';
		$str .= 0 && $this->opts['show_level_two_color_id'] ? sprintf( '<div>%s</div>', $this->getColorId( $color_l2 ) ) : '';
		$str .= $this->opts['show_level_two_color_id'] ? sprintf( '<div>%s</div>', $this->getHSLBackgroundColor( $color_l2, 2 ) ) : '';


		if ( $this->opts['show_level_three'] )
		{
			foreach ( $color_l2['three'] as $k3 => $color_l3 )
			{
				if( $k3 + 1 <= $this->opts['max_units_level_three'] )
				{
					$str .= $this->getLevelThreeHTML( $color_l3, $k1, $k2, $k3, $num );
				}
			}
		}
		$str .= '</div>' . PHP_EOL;
		$str .= '</div>' . PHP_EOL;
		$str .= '</div><!-- .unit .level-2 -->' . PHP_EOL;
		return $str;
	}

	/**
	 * Get Level Three HTML.
	 *
	 * string str_pad ( string $input , int $pad_length [, string $pad_string = " " [, int $pad_type = STR_PAD_RIGHT ]] )
	 *
	 * @param array $color
	 * @param int $k
	 *
	 * @return string
	 */
	private function getLevelThreeHTML( $color, $k1, $k2, $k3, $sum )
	{
		$sum = ($k1 + 1 ) * ( $k2 + 1 ) * ( $k3 + 1 );
		$str = sprintf( '<div class="unit level-3 size1of%s">', $this->opts['columns_level_three'] );
		$str .= '<div class="border" ';
		$str .= 'style="';
		$str .= $this->opts['show_level_three_border'] ? sprintf( ' border: %spx solid %s', $this->opts['level_three_border_width'], $this->getHSLBorder( $color, 3 ) ): '';
		$str .= ' color: ' . $this->getTextColor( $color );
		$str .= '">' . PHP_EOL;
		$str .= '<div class="inner"' . PHP_EOL;
		$str .= $this->opts['show_level_three_background_color'] ? sprintf(' style="background: %s"', $this->getHSLBackgroundColor( $color, 3 ) ) : '';
		$str .= sprintf(' title="%s"', $this->getHSLValue( $color ) );
		$str .= '>' . PHP_EOL;
		$str .= $this->opts['show_level_three_count'] ? sprintf('<span class="count"><sup>%s</sup>', $sum ) : '';
		if ( $this->opts['show_level_three_link'] )
		{
			$str .= '<a>';
			$str .= $this->opts['show_level_three_icon'] ? $this->getIcon( $color ) : '';
			$str .= $this->opts['show_level_three_text'] ? $this->getText( $color ) : '';
			$str .= $this->opts['show_level_three_color_id'] ? $this->getColorId( $color ) : '';
			$str .= '</a>';
		}
		if ( $this->opts['show_level_four'] )
		{
			foreach ( $color['four'] as $k4 => $four )
			{
				if( $k4 + 1 <= $this->opts['max_units_level_four'] )
				{
					$str .= $this->getLevelFourHTML( $four, $k4 );
				}
			}
		}

		$str .= '</div>' . PHP_EOL;
		$str .= '</div>' . PHP_EOL;
		$str .= '</div>' . PHP_EOL;
		return $str;
	}

	/**
	 * Get Level Four HTML.
	 *
	 * @param array $color
	 * @param int $k
	 *
	 * @return string
	 */
	private function getLevelFourHTML( $color, $k4 )
	{
		$str = sprintf( '<div class="unit level-4 size1of%s">', $this->opts['columns_level_four'] );
		$str .= '<div class="inner"';
		$str .= ' style="';
		$str .= $this->opts['show_level_four_border'] ? ' border: 1px solid ' . $this->getHSLBorder( $color, 4 ) : '';
		$str .= $this->opts['show_level_four_background_color'] ? ' background: ' . $this->getHSLBackgroundColor( $color, 4 ) : '';
		$str .= '">';
		$str .= '<a>';
		$str .= $this->opts['show_level_four_icon'] ? $this->getIcon( $color ) : '';
		$str .= $this->opts['show_level_four_text'] ? $this->getText( $color ) : '';
		$str .= '</a>';
		$str .= '</div>';
		$str .= '</div>' . PHP_EOL;
		return $str;
	}

	/**
	 *
	 */
	private function getIcon( $color )
	{
		$str = '<span class="architecture"><span class="icon"></span></span>';
		return $str;
	}

	/**
	 * Get the text
	 */
	private function getText( $color )
	{
		return '<span class="text">N/A</span>';
	}

	/**
	 * Get Groups HTML.
	 *
	 * Open group for every nth iteration.
	 * Close group for every nth iteration.
	 *
	 * It may be easier to create an array which would group by the values needed,
	 * then do separate foreach loops, although this technically could be done.
	 *
	 * @param array $colors
	 *
	 * @return string
	 */
	protected function getGroupsHTML( $groups, $colors )
	{
		$i=0;
		$group = true;
		$cnt = count( $colors );
		$cnt_grp = 0;
		$hue = 0;
		$max = $this->opts['max_colors'];
		$levelOne = array_values( $groups[0] );
		$levelTwo = array_values( $groups[1] );

		$str = '<article class="one">' . PHP_EOL;
		$str .= '<div class="json" style="font-size: 80%;">' . PHP_EOL;
		$str .= '<div class="line">' . PHP_EOL;

		foreach ($colors as $k => $color)
		{
			if( $k + 1 <= $this->opts['max_colors'] )
			{
				// Group open
				if ( 0 && $this->opts['use_groups'] && ( $k % $this->opts['group-size'] == 0 ) ){
					$str .= '<div class="line group border">' . PHP_EOL;
					$str .= $this->opts['show_text'] ? sprintf('<h2>%s</h2>%s', $group_name, PHP_EOL) : '';
					$cnt_grp++;
				}

				$level_one = array_keys( $groups[0] )[$cnt_group];

				$str .= sprintf( '<div class="unit size1of%s %s" style="border-radius: 3px;">%s', $this->opts['columns'], $this->getRow( $k ) , PHP_EOL) ;
				$str .= '<div class="border" style="padding: 3px;">' . PHP_EOL;
				$str .= '<div class="inner text-center" style="min-height: 46px; padding:6px; ' . PHP_EOL;
				$str .= sprintf( 'background: hsl(%s, %s%%, %s%%);', $color['h'], $color['s'], $color['l'] );
				$str .= sprintf( 'color: %s">', $this->getTextColor( $color ) );
				$str .= $this->opts['show_text'] ? sprintf('%s<br />%s', $this->getName( $groups, $level_one, $k ), PHP_EOL) : '';
				$str .= 0 ? sprintf('%s<br />%s', $color->hexString, PHP_EOL) : '';
				$str .= 0 ? sprintf('%s<br />%s', $this->getRGBValue( $color->rgb ), PHP_EOL) : '';
				$str .= $this->opts['show_hsl'] ? sprintf('<br />%s. %s<br />%s', $k + 1, $this->getHSLValue( $color ), PHP_EOL ) : '';
				$str .= 0 ? sprintf('%s%s', $this->getWavelength( $color ), PHP_EOL) : '';
				$str .= '</div>' . PHP_EOL;
				$str .= '</div>' . PHP_EOL;
				$str .= '</div>' . PHP_EOL;

				if ( 0 && $this->opts['use_group'] && ( $k % $this->opts['group-size'] == 0 ) ){
					$str .= '</div><!-- .group -->' . PHP_EOL;
				}
			}
			else
			{
				break;
			}
		}
		$str .= $this->opts['use_groups'] ? '</div><!-- .group .last -->' . PHP_EOL : '';
		$str .= '</div>' . PHP_EOL;
		$str .= '</div>' . PHP_EOL;
		$str .= '</article>' . PHP_EOL;
		return $str;
	}

	/**
	 * Break Group Open and close
	 */

	/**
	 *
	 */
	private function getName( $groups, $level_one, $k )
	{
		if ( $k > 0 )
		{
			$i = $k / $this->opts['group_size'];
		}
		else
		{
			$i = $k;
		}
		$name = isset( $groups[1][ $level_one ][$i]['name'] ) ? ucfirst( $groups[1][ $level_one ][$i]['name'] ) : 'NA';
		return $name;
	}

	/**
	 * Determine the row the unit is in.
	 *
	 * If this unit is one of the first set of four, it is on the top row.
	 * If this unit is one of the second set of four, it is in a middle row.
	 * If this unit is one of the third set of four, it is on the bottom row.
	 *
	 * @param int $k
	 *
	 * @return bool
	 */
	private function getRow( $k )
	{
		if
		(
			$k >= 0 && $k <  $this->opts['columns']
		)
		{
			return 'top';
		}
		else if
		(
			$k <> 0 && $k + 1 <> $this->opts['max_colors']
			&& is_int( ( $k + 1 ) / ( $this->opts['columns'] ) )
		)
		{
			return 'bottom';
		}
		else
		{
			return 'middle';
		}
	}

	/**
	 * Determine if a break for a group is needed.
	 *
	 * If the number plus one is evenly divisible by the group size,
	 * it is a group break. Otherwise not.
	 *
	 * If it not the last one according to the max, return true;
	 *
	 * @param int $k
	 *
	 * @return bool
	 */
	private function isGroup( $k )
	{
		if
		(
			$k <> 0 && $k + 1 <> $this->opts['max_colors']
			&& is_int( ( $k + 1 ) / ( $this->opts['group_size'] ) )
		)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Gets the Horizontal Top Nav
	 *
	 * The Top Nav contains Level One Items (Who, What, How, Where, When, Why, etc.).
	 * Therefore, its background needs to be the same as the Level One background further
	 * down below. To differentiate between the background and the border for each level,
	 * we need to keep these together. Also, using the HSL color model, it is possible to
	 * specify a differentiation between the border and the background, by a percentage, or
	 * by an absolute value. Just the saturation could be changed, or both the saturation and
	 * the lightness could be reduced.
	 *
	 * Reducing the Saturation from 100, moves towards Grey.Increasing Luminosity
	 * moves toward White, Decreasing it moves to black. { @see http://hslpicker.com/ }.
	 * Saturation is a form of intensity. A Lightness of 50% is approximately halfway on
	 * the brightness level. Thus, we should be able to pick a Lightness number (say, 75% or
	 * 80% that we can consistently use for a background (color), rather than relying on a
	 * percentage. The saturation has more to do with the *nuance* of the color. Thus, a muted
	 * color would be less saturated (kind of works).
	 *
	 */
	private function getTopNav()
	{
		$str = '<nav class="horizontal icons">';
		$str .= '<a href="#who" class="who" title="Who"><span class="icon icon8x8"></span>';
		$str .= '<a href="#what" class="what" title="What"><span class="icon icon16x8"></span></a>';
		$str .= '<a href="#how" class="how" title="How"><span class="icon icon8x16"></span></a>';
		$str .= '<a href="#where" class="where" title="Where"><span class="icon icon16x16"></span></a>';
		$str .= '<a href="#when" class="when" title="When"><span class="icon icon8x24"></span></a>';
		$str .= '<a href="#why" class="why" title="Why"><span class="icon icon16x14"></span></a>';
		$str .= '<a href="#store" class="store" title="Store"><span class="icon icon1x15"></span></a>';
		$str .= '</nav>' . PHP_EOL;
		return $str;
	}

	/**
	 * Wrap the string in page HTML `<!DOCTYPE html>`, etc.
	 *
	 * @param string $str
	 * @return string
	 */
	protected function getPageHtml( $html )
	{
		$str = '<!DOCTYPE html>' . PHP_EOL;
		$str .= '<html class="dynamic" lang="en-CA">' . PHP_EOL;
		$str .= '<head>' . PHP_EOL;
		$str .= '<meta charset="UTF-8">' . PHP_EOL;
		$str .= '<meta name="viewport" content="width=device-width, initial-scale=1"/>' . PHP_EOL;
		$str .= sprintf( '<title>%s</title>', $this->opts['page_title'], PHP_EOL );
		$str .= '<meta name="robots" content="noindex,nofollow" />' . PHP_EOL;
		$str .= '<link rel=stylesheet href="/0/theme/css/style.css">' . PHP_EOL;
		$str .= $this->opts['use_child_css'] ? '<link rel=stylesheet href="/0/theme/css/child.css">' . PHP_EOL : '';
		$str .= $this->opts['use_sprite_css'] ? '<link rel=stylesheet href="/0/theme/css/sprite.css">' . PHP_EOL : '';
		$str .= '<style>';
		$str .= 'article .unit .border { padding: 4px; border-radius: 3px; background: inherit;';
		$str .= ' border-color: transparent;}';
		$str .= ' .level-2 > .border { box-shadow: 1px 1px 3px rgba(50, 50, 50, 1.0); }';
		$str .= ' .level-2 > .border > .inner {';
		$str .= ' text-align: center; overflow: hidden; min-height: 46px; padding:6px;';
		$str .= ' box-shadow: inset 1px 1px 3px rgba(50, 50, 50, 1.0); ';
		$str .= ' }';
		$str .= ' .level-3 .border { margin: 0; box-shadow: none; }';
		$str .= ' .level-3 .inner { text-align: center; }';
		$str .= ' .level-3 .inner > a { text-align: center; min-height: 35px; overflow: hidden; padding:4px;}';
		$str .= ' .level-4 .inner { margin: 1px; box-sizing: border-box; box-shadow: none; }';
		$str .= ' .level-4 a { text-align: center; min-height: 13px; padding:4px; }';
		$str .= '</style>' . PHP_EOL;
		$str .= '</head>' . PHP_EOL;
		$str .= '<body>' . PHP_EOL;
		$str .= '<main>' . PHP_EOL;
		$str .= $html;
		$str .= '</main>' . PHP_EOL;
		$str .= '<footer>' . PHP_EOL;
		$str .= '<div class="text-center"><small>';
		$str .= 'Note: This page has been <a href="https://github.com/earth3300/ec01-colors">automatically generated</a>. No header, footer, menus or sidebars are available.';
		$str .= '</small></div>' . PHP_EOL;
		$str .= '</footer>' . PHP_EOL;
		$str .= '</html>' . PHP_EOL;

		return $str;
	}
}

function pre_dump( $arr )
{
	if( 1 )
	{
		echo "<pre>";
		var_dump( $arr );
		echo "</pre>";
	}
}
