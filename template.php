<?php

defined('NDA') || exit;

/**
 * Color Template
 *
 * Generates the article HTML and Page HTML necessary to view the colors
 * in a browswer.
 */
class GroupsTemplate extends Groups
{
	/** Default options */
	protected $opts = [
		'max' => 480,
		'group_size' => 8,
		'use_groups' => true,
		'row_size' => 2,
		'page_title' => 'HSL Colors',
	];

		/**
	 * Get HTML from HSL
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
		$cnt_group = 0;
		$hue = 0;
		$max = $this->opts['max'];
		$levelOne = array_values( $groups[0] );
		$levelTwo = array_values( $groups[1] );

		$str = '<article class="one">' . PHP_EOL;
		$str .= '<div class="json" style="font-size: 80%;">' . PHP_EOL;
		$str .= '<div class="line">' . PHP_EOL;

		$str .= $this->opts['use_groups'] ? '<div class="line group border shadows first">' . PHP_EOL : '';
		$str .= 1 ? sprintf('<h2>%s</h2>%s', ucfirst( $levelOne[0]['name'] ), PHP_EOL) : '';

		foreach ($colors as $k => $color)
		{
			if( $k + 1 <= $max )
			{
				$level_one = array_keys( $groups[0] )[$cnt_group];

				$str .= sprintf( '<div class="unit size1of2 %s" style="border-radius: 3px;">%s', $this->getRow( $k ) , PHP_EOL) ;
				$str .= '<div class="border" style="padding: 3px;">' . PHP_EOL;
				$str .= '<div class="inner text-center" style="min-height: 46px; padding:6px; ' . PHP_EOL;
				$str .= sprintf( 'background: hsl(%s, %s%%, %s%%);', $color['h'], $color['s'], $color['l'] );
				$str .= sprintf( 'color: %s">', $this->getTextColor( $color ) );
				$str .= 1 ? sprintf('%s<br />%s', $this->getName( $groups, $level_one, $k ), PHP_EOL) : '';
				$str .= 0 ? sprintf('%s<br />%s', $color->hexString, PHP_EOL) : '';
				$str .= 0 ? sprintf('%s<br />%s', $this->getRGBValue( $color->rgb ), PHP_EOL) : '';
				$str .= 1 ? sprintf('%s. %s<br />%s', $k + 1, $this->getHSLValue( $color ), PHP_EOL ) : '';
				$str .= 0 ? sprintf('%s%s', $this->getWavelength( $color ), PHP_EOL) : '';
				$str .= '</div>' . PHP_EOL;
				$str .= '</div>' . PHP_EOL;
				$str .= '</div>' . PHP_EOL;

				if (  $this->opts['use_groups'] && $this->isGroup( $k ) )
				{
					$cnt_group++;
					$group_name = isset ( $levelOne[$cnt_group]['name'] ) ? ucfirst( $levelOne[$cnt_group]['name'] ) : 'NA';
					$str .= '</div><!-- .group -->' . PHP_EOL;
					$str .= '<div class="line border group middle">' . PHP_EOL;
					$str .= 1 ? sprintf('<h2>%s</h2>%s', $group_name, PHP_EOL) : '';
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
	 *
	 */
	private function getName( $groups, $level_one, $k )
	{
		//var_dump( $groups[1] );
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
	 * Get HTML from HSL
	 *
	 * @param array $colors
	 *
	 * @return string
	 */
	protected function getHTMLfromHSL( $colors )
	{

		$i=0;
		$group = true;
		$cnt = count( $colors );
		$hue = 0;
		$max = $this->opts['max'];

		$str = '<article class="one">' . PHP_EOL;
		$str .= '<div class="json" style="font-size: 80%;">' . PHP_EOL;
		$str .= '<div class="line">' . PHP_EOL;

		$str .= $this->opts['use_groups'] ? '<div class="line group border shadows first">' . PHP_EOL : '';

		foreach ($colors as $k => $color)
		{
			if( $k + 1 <= $max )
			{
				$str .= sprintf( '<div class="unit size1of2 %s" style="border-radius: 3px;">%s', $this->getRow( $k ) , PHP_EOL) ;
				$str .= '<div class="border" style="padding: 3px;">' . PHP_EOL;
				$str .= '<div class="inner text-center" style="min-height: 46px; padding:6px; ' . PHP_EOL;
				$str .= sprintf( 'background: hsl(%s, %s%%, %s%%);', $color['h'], $color['s'], $color['l'] );
				$str .= sprintf( 'color: %s">', $this->getTextColor( $color ) );
				$str .= 0 ? sprintf('%s<br />%s', $color->name, PHP_EOL) : '';
				$str .= 0 ? sprintf('%s<br />%s', $color->hexString, PHP_EOL) : '';
				$str .= 0 ? sprintf('%s<br />%s', $this->getRGBValue( $color->rgb ), PHP_EOL) : '';
				$str .= 1 ? sprintf('<br />%s. %s<br /><br />%s', $k + 1, $this->getHSLValue( $color ), PHP_EOL ) : '';
				$str .= 0 ? sprintf('%s%s', $this->getWavelength( $color ), PHP_EOL) : '';
				$str .= '</div>' . PHP_EOL;
				$str .= '</div>' . PHP_EOL;
				$str .= '</div>' . PHP_EOL;

				if (  $this->opts['use_groups'] && $this->isGroup( $k ) )
				{
					$str .= '</div><!-- .group -->' . PHP_EOL;
					$str .= '<div class="line border group middle">' . PHP_EOL;
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
			$k >= 0 && $k <  $this->opts['row_size']
		)
		{
			return 'top';
		}
		else if
		(
			$k <> 0 && $k + 1 <> $this->opts['max']
			&& is_int( ( $k + 1 ) / ( $this->opts['row_size'] ) )
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
			$k <> 0 && $k + 1 <> $this->opts['max']
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
