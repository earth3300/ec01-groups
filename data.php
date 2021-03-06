<?php

defined('NDA') || exit;

function get_basic_colors()
{
	$items = [
		'violet' =>
			[
				'nm' => [ 'low' => 380, 'high' => 449 ],
				'hue' => [ 'low' => 260, 'high' => 338 ],
				'sat' => [ 'low' => 0, 'high' => 0 ],
				'lit' => [ 'low' => 34, 'high' => 50 ],
			],
		'blue' =>
			[
				'nm' =>  [ 'low' => 450, 'high' => 494 ],
				'hue' => [ 'low' => 189, 'high' => 218 ],
				'sat' => [ 'low' => 100, 'high' => 100 ],
				'lit' => [ 'low' => 18, 'high' => 50 ],
			],
		'green' =>
			[
				'nm' => [ 'low' => 495, 'high' => 569 ],
				'hue' => [ 'low' => 78, 'high' => 98 ],
				'sat' => [ 'low' => 100, 'high' => 100 ],
				'lit' => [ 'low' => 26, 'high' => 50 ],
			],
		'yellow' =>
			[
				'nm' => [ 'low' => 570, 'high' => 589 ],
				'hue' => [ 'low' => 49, 'high' => 51 ],
				'sat' => [ 'low' => 100, 'high' => 100 ],
				'lit' => [ 'low' => 42, 'high' => 50 ],
			],
		'orange' =>
			[
				'nm' => [ 'low' => 590, 'high' => 619 ],
				'hue' => [ 'low' => 22, 'high' => 23 ],
				'sat' => [ 'low' => 100, 'high' => 100 ],
				'lit' => [ 'low' => 50, 'high' => 50 ],
			],
		'red' =>
			[
				'nm' => [ 'low' => 620, 'high' => 749 ],
				'hue' => [ 'low' => 0, 'high' => 0 ],
				'sat' => [ 'low' => 100, 'high' => 100 ],
				'lit' => [ 'low' => 18, 'high' => 50 ],
			],
	];
	return $items;
}

/**
 * Level One
 *
 * Who, What, When, Where, How and Why, shortened to:
 * who, wha, whn, whe, how and why.
 *
 * Although each tier two grouping can have about ten tier
 * three groupings, some (many?) may be duplicated at the tier three
 * and tier four levels, with minor variations in wording to reflect
 * the difference between the tier two groupings.
 *
 * @return array
 */
function get_level_one_data(){
	$arr = [
		'who' => [ 'name' => 'who' ],
		'wha' => [ 'name' => 'what' ],
		'whn' => [ 'name' => 'when' ],
		'whe' => [ 'name' => 'where' ],
		'how' => [ 'name' => 'how' ],
		'why' => [ 'name' => 'why' ],
		'wki' => [ 'name' => 'wiki' ],
		'sto' => [ 'name' => 'store' ],
		];
	return $arr;
}

/**
 * Level Two (Four Characters).
 *
 * These all are currently placed under the "Where" (whr) directory.
 * Formerly, this was called the "cluster" directory, as that had best
 * defined what that was at that time. However, with the addition of
 * other higher level categories which include: who, what, when, how and
 * why, it seemed best to change this to "where" (or "whr") for consistency.
 *
 * @return array
 */
function get_level_two_data(){
	$arr = [
		'whe' => [
			[ 'name' => 'academic' ],
			[ 'name' => 'arts' ],
			[ 'name' => 'trade' ],
			[ 'name' => 'applied' ],
			[ 'name' => 'gardening' ],
			[ 'name' => 'care' ],
			[ 'name' => 'cafe' ],
			[ 'name' => 'monitoring' ],
			[ 'name' => 'analysis' ],
			[ 'name' => 'nature' ],
		],

		'wha' => [
			[ 'name' => 'nature' ],
			[ 'name' => 'agriculture' ],
			[ 'name' => 'building' ],
			[ 'name' => 'equipment' ],
			[ 'name' => 'supply' ],
			[ 'name' => 'property' ],
			[ 'name' => 'resource' ],
			[ 'name' => 'structure' ],
			[ 'name' => 'information' ],
			[ 'name' => 'product' ],
			[ 'name' => 'design' ],
		],

		'how' => [
			[ 'name' => 'standard' ],
			[ 'name' => 'process' ],
			[ 'name' => 'method' ],
			[ 'name' => 'project' ],
			[ 'name' => 'communication' ],
			[ 'name' => 'news' ],
			[ 'name' => 'service' ],
			[ 'name' => 'wholesale' ],
			[ 'name' => 'store' ],
			[ 'name' => 'recovery' ],
		],

		'why' => [
			[ 'name' => 'ethics' ],
			[ 'name' => 'sustainability' ],
			[ 'name' => 'religion' ],
			[ 'name' => 'other' ],
		],

		'wki' => [
			[ 'name' => 'one' ],
			[ 'name' => 'two' ],
			[ 'name' => 'three' ],
			[ 'name' => 'four' ],
		],

		'sto' => [
			[ 'name' => 'one' ],
			[ 'name' => 'two' ],
			[ 'name' => 'three' ],
			[ 'name' => 'four' ],
		],
	];
	return $arr;
}

/**
 * Level Three (Five Characters).
 *
 * There are eight to ten tier three groupings. With about eight
 * tier four groupings per tier three grouping, we have:
 * 10 x 8 = 80. About sixty to eighty tier four groupings.
 *
 * @return array
 */
function get_level_three_data(){
	$arr = [
		'centr' => [ 'name' => 'center' ],

		'chemi' => [ 'name' => 'chemistry', 'who' => 'chemist', ],
		'cogni' => [ 'name' => 'cognition', 'who' => 'psychologist', ],
		'cymat' => [ 'name' => 'cymatics', 'who' => 'cymaticist', ],
		'genet' => [ 'name' => 'genetics', 'who' => 'geneticist', ],
		'geolo' => [ 'name' => 'geology', 'who' => 'geologist', ],
		'logic' => [ 'name' => 'logic', 'who' => 'logician', ],
		'mathe' => [ 'name' => 'mathematics', 'who' => 'mathematician', ],
		'physc' => [ 'name' => 'physics', 'who' => 'physicist', ],

		'archi' => [ 'name' => 'architecture', 'who' => 'architect', ],
		'engin' => [ 'name' => 'engineering', 'who' => 'engineering', ],
		'lands' => [ 'name' => 'landscaping', 'who' => 'landscaper', ],
		'perma' => [ 'name' => 'permaculture', 'who' => 'permaculturist', ],
		'progr' => [ 'name' => 'programming', 'who' => 'programmer', ],
		'robot' => [ 'name' => 'robotics', 'who' => 'roboticist', ],

		'music' => [ 'name' => 'music', 'who' => 'musician', ],
		'paint' => [ 'name' => 'painting', 'who' => 'painter', ],
		'percn' => [ 'name' => 'percussions', 'who' => 'percussionist', ],
		'piano' => [ 'name' => 'piano', 'who' => 'pianist', ],
		'pttry' => [ 'name' => 'pottery', 'who' => 'potter', ],
		'saxop' => [ 'name' => 'saxophone', 'who' => 'saxophonist', ],
		'sclpt' => [ 'name' => 'sculpture', 'who' => 'sculptor', ],
		'violn' => [ 'name' => 'violin', 'who' => 'violinist', ],

		'bakng' => [ 'name' => 'baking', 'who' => '', ],
		'brsta' => [ 'name' => 'barista', 'who' => 'barista', ],
		'clnup' => [ 'name' => 'cleanup', 'who' => 'cleaner', ],
		'cookg' => [ 'name' => 'cooking', 'who' => 'cook', ],
		'recyl' => [ 'name' => 'recycling', 'who' => 'recycler', ],
		'servg' => [ 'name' => 'serving', 'who' => 'server', ],
		'storg' => [ 'name' => 'storage', 'who' => 'storage', ],

		'bodyc' => [ 'name' => 'baking', 'who' => 'bodyc', ],
		'cloth' => [ 'name' => 'clothing', 'who' => 'tailor', ],
		'hairc' => [ 'name' => 'haircare', 'who' => 'hairdresser', ],
		'nutri' => [ 'name' => 'nutrition', 'who' => 'nutritionist', ],
		'physi' => [ 'name' => 'physio', 'who' => 'physiotherapist', ],
		'psych' => [ 'name' => 'psyche', 'who' => 'pscyhologist', ],
		'helth' => [ 'name' => 'health', 'who' => 'health-care', ],
		'shoes' => [ 'name' => 'shoes', 'who' => 'shoemaker', ],

		'culti' => [ 'name' => 'cultivating', 'who' => 'cultivator', ],
		'hrvtg' => [ 'name' => 'harvesting', 'who' => 'harvester', ],
		'plntg' => [ 'name' => 'planting', 'who' => 'planter', ],
		'prepg' => [ 'name' => 'preparing', 'who' => 'preparer', ],
		'procg' => [ 'name' => 'processing', 'who' => 'processer', ],
		'weedg' => [ 'name' => 'weeding', 'who' => 'weeder', ],

		'anlys' => [ 'name' => 'analysis', 'who' => 'analyst', ],
		'audio' => [ 'name' => 'audio', 'who' => 'audio-engineer', ],
		'photo' => [ 'name' => 'photography', 'who' => 'photographer', ],
		'presg' => [ 'name' => 'presenting', 'who' => 'presenter', ],
		'video' => [ 'name' => 'video', 'who' => 'videographer', ],
		'writg' => [ 'name' => 'writing', 'who' => 'writer', ],

		'carpt' => [ 'name' => 'carpentry', 'who' => 'carpenter', ],
		'drywl' => [ 'name' => 'drywall', 'who' => 'drywaller', ],
		'elect' => [ 'name' => 'electrical', 'who' => 'electrician', ],
		'mason' => [ 'name' => 'masonry', 'who' => 'mason', ],
		'mecha' => [ 'name' => 'mechanical', 'who' => 'mechanic', ],
		'plumb' => [ 'name' => 'plumbing', 'who' => 'plumber', ],
		'weldg' => [ 'name' => 'welding', 'who' => 'welder', ],
		'roofg' => [ 'name' => 'roofing', 'who' => 'roofer', ],

		// Wha (What)
		'geolo' => [ 'name' => 'geology', 'who' => 'geologist', ],
		'miner' => [ 'name' => 'mineral', 'who' => 'geologist', ],
		'strat' => [ 'name' => 'strata', 'who' => 'geologist', ],
		'terrn' => [ 'name' => 'terrain', 'who' => 'geologist', ],
		'water' => [ 'name' => 'water', 'who' => 'hydrologist', ],
		'atmos' => [ 'name' => 'atmosphere', 'who' => 'meterologist', ],
		'climt' => [ 'name' => 'climate', 'who' => 'meterologist', ],
		'wther' => [ 'name' => 'weather', 'who' => 'meterologist', ],
		'lakes' => [ 'name' => 'lakes', 'who' => '', ],
		'ecosy' => [ 'name' => 'ecosystem', 'who' => '', ],
		'plant' => [ 'name' => 'plant', 'who' => '', ],
		'insct' => [ 'name' => 'insect', 'who' => '', ],
		'animl' => [ 'name' => 'animal', 'who' => '', ],

		'packs' => [ 'name' => 'packs', 'who' => 'tailor', ],
		'shelt' => [ 'name' => 'shelter', 'who' => 'carpenter', ],
		'sleep' => [ 'name' => 'sleep', 'who' => 'carpenter', ],
		'dwell' => [ 'name' => 'dwelling', 'who' => 'builder', ],
		'wkshp' => [ 'name' => 'workshop', 'who' => 'builder', ],

		'agric' => [ 'name' => 'agricultural', 'who' => 'farmer', ],
		'mecha' => [ 'name' => 'mechanical', 'who' => 'mechanic', ],
		'elect' => [ 'name' => 'electrical', 'who' => 'electrician', ],

		'fastn' => [ 'name' => 'fasteners', 'who' => 'fasteners', ],
		'sheet' => [ 'name' => 'sheet-goods', 'who' => 'sheet-goods', ],
		'struc' => [ 'name' => 'structural', 'who' => 'structural', ],

		// How (How)
		'softw' => [ 'name' => 'software', 'who' => 'programmer', ],
		'grwth' => [ 'name' => 'growth', 'who' => 'planner', ],

	];
	return $arr;
}
