<?php

$user_guids = get_input('members');
$group_guid = get_input('group_guid');

$group = get_entity($group_guid);

if (!elgg_instanceof($group, 'group')) {
	register_error(elgg_echo('addgroupmembers:error:nogroup'));
	forward(REFERER);
}

if (!$group->canEdit()) {
	register_error(elgg_echo('addgroupmembers:error:cannot_edit'));
	forward(REFERER);
}

$users = new ElggBatch('elgg_get_entities' ,array(
	'type' => 'user',
	'guids' => $user_guids,
	'limit' => false,
));

foreach ($users as $user) {
	if ($user->isBanned()) {
		continue;
	}

	if ($group->join($user)) {
		// Notify user about the new membership
		$subject = elgg_echo('addgroupmembers:notification:subject');
		$body = elgg_echo('addgroupmembers:notification:body', array(
			$user->name,
			elgg_get_logged_in_user_entity()->name,
			$group->name,
			elgg_get_site_entity()->name,
			$group->getURL(),
		));

		notify_user($user->guid, elgg_get_site_entity()->guid, $subject, $body);
	}
}

system_message(elgg_echo('addgroupmembers:success'));

forward($group->getURL());
