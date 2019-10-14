<?php


function createDateByMonth($month = 01, $year = 2017) {

	$month = ltrim($month, '0');
	return DateTime::createFromFormat('Y-m-d', "{$year}-$month-01")->format('Y-m-d');
}