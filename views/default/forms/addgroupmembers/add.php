<?php
/**
 * Form to add more members to a group
 */

echo elgg_view('input/userpicker');

echo elgg_view('input/hidden', array(
	'name' => 'group_guid',
	'value' => $vars['group_guid'],
));

echo elgg_view('input/submit', array(
	'value' => elgg_echo('add'),
));
