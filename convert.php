<?php

function csvsplit($line) {
	$line = trim($line, '"');
	return explode('","', $line);
}

$file = 'selectie_1216.csv';
$fp = fopen($file, 'r');
$first = fgets($fp);
$keys = csvsplit($first);
echo "BEGIN:VCALENDAR\r\n";

while ($line = fgets($fp)) {
	$values = csvsplit($line);
	$gebdatum = $values[12];
	$gebdatum = str_replace('-', '', $gebdatum);
	$name = array();
	$name[] = $values[1];
	if (!empty($values[3])) $name[] = $values[3];
	$name[] = $values[4];
	$naam = implode(' ', $name);
	if ($values[23] == 'welpen') continue;
	if ($values[23] == 'scouts') continue;
	echo "BEGIN:VEVENT\r\n";
	echo "DTSTART:$gebdatum\r\n";
	echo "DTEND:$gebdatum\r\n";
	echo "RRULE:FREQ=YEARLY\r\n";
	echo "SUMMARY:$naam jarig\r\n";
	echo "END:VEVENT\r\n";
}
echo "END:VCALENDAR\r\n";
