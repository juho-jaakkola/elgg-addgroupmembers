<?php

$lang = array(
	'addgroupmembers:add' => 'Add members',
	'addgroupmembers:add:title' => 'Add new members to the group',
	'addgroupmembers:error:nousers' => 'Select at least one user',
	'addgroupmembers:error:nogroup' => 'The group was not found',
	'addgroupmembers:error:cannot_edit' => 'You do not have the permission to add new members to the group',
	'addgroupmembers:success' => 'New members added and notified',

	// Notifications
	'addgroupmembers:notification:subject' => 'You have been added to a group',
	'addgroupmembers:notification:body' => '%s

%s has added you to the group %s at %s.

You can access the group here:
%s
',
);

add_translation('en', $lang);
