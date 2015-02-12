<?php
include 'quotes.php';
$settings['display_type'] = 1;
$settings['allow_otf'] = 1;

if ($settings['allow_otf'] && isset($_GET['type']))
{
	$type = intval($_GET['type']);
}
else
{
	$type = $settings['display_type'];
}

if (count($settings['quotes']))
{
	$txt = $settings['quotes'][array_rand($settings['quotes'])];
}
else
{
	$txt = 'null';
}

if ($type)
{
	// New lines will break Javascript, remove any and replace them with <br />
	$txt = nl2br(trim($txt));
	$txt = str_replace(array("\n","\r"),'',$txt);

	// Set the correct MIME type
	header("Content-type: text/javascript");

	// Print the Javascript code
	echo 'document.write(\'"'.$txt,'"\')';
}
else
{
	echo $txt;
}
?>
