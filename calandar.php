<?php
function get_century_code($century)
{
	// XVIII
	if (1700 <= $century && $century <= 1799)
		return 4;
 
	// XIX
	if (1800 <= $century && $century <= 1899)
		return 2;
 
	// XX
	if (1900 <= $century && $century <= 1999)
		return 0;
 
	// XXI
	if (2000 <= $century && $century <= 2099)
		return 6;
 
	// XXII
	if (2100 <= $century && $century <= 2199)
		return 4;
 
	// XXIII
	if (2200 <= $century && $century <= 2299)
		return 2;
 
	// XXIV
	if (2300 <= $century && $century <= 2399)
		return 0;
 
	// XXV
	if (2400 <= $century && $century <= 2499)
		return 6;
 
	// XXVI
	if (2500 <= $century && $century <= 2599)
		return 4;
 
	// XXVII
	if (2600 <= $century && $century <= 2699)
		return 2;
}
 
/**
 * Get the day of a given date
 * 
 * @param $date
 */
function get_day_from_date($date) 
{
	$months = array(
		1 => 0,		// January
		2 => 3,		// February
		3 => 3,		// March
		4 => 6,		// April
		5 => 1,		// May
		6 => 4,		// June
		7 => 6,		// July
		8 => 2,		// August
		9 => 5,		// September
		10 => 0,	// October
		11 => 3,	// November
		12 => 5,	// December
	);
 
	$days = array(
		0 => 'Sunday',
		1 => 'Monday',
		2 => 'Tuesday',
		3 => 'Wednesday',
		4 => 'Thursday',
		5 => 'Friday',
		6 => 'Saturday',
	);
 
	// calculate the date
	$dateParts = explode('-', $date);
	$century = substr($dateParts[2], 0, 2);
	$year = substr($dateParts[2], 2);
 
	// 1. Get the number for the corresponding century from the centuries table
	$a = get_century_code($dateParts[2]);
 
	// 2. Get the last two digits from the year
	$b = $year;
 
	// 3. Divide the number from step 2 by 4 and get it without the remainder
	$c = floor($year / 4);
 
	// 4. Get the month number from the month table
	$d = $months[$dateParts[1]];
 
	// 5. Sum the numbers from steps 1 to 4
	$e = $a + $b + $c + $d;
 
	// 6. Divide it by 7 and take the remainder
	$f = $e % 7;
 
	// 7. Find the result of step 6 in the days table
	return $days[$f];
}
 
// Sunday
echo get_day_from_date('31-1-1883');
?>
