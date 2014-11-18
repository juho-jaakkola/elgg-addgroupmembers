<?php
/**
 * addgroupmemberss
 *
 * @package addgroupmembers
 */

elgg_register_event_handler('init', 'system', 'addgroupmembers_init');

/**
 * Init addgroupmembers plugin.
 */
function addgroupmembers_init () {
	$actionspath = elgg_get_plugins_path() . 'addgroupmembers/actions/addgroupmembers';
	elgg_register_action('addgroupmembers/add', "$actionspath/add.php");

	elgg_register_plugin_hook_handler('register', 'menu:title', 'addgroupmembers_title_menu_setup');

	elgg_register_page_handler('addgroupmembers', 'addgroupmembers_page_handler');
}

/**
 * Add a menu link for group owner and admin to add more members to a group
 */
function addgroupmembers_title_menu_setup ($hook, $type, $return, $params) {
	if (elgg_in_context('group_profile')) {
		$group = elgg_get_page_owner_entity();

		if ($group->canEdit()) {
			$text = elgg_echo("addgroupmembers:add");
			$options = array(
				'name' => 'add_members',
				'text' => "<span>$text</span>",
				'href' => "addgroupmembers/{$group->getGUID()}",
				'priority' => 100,
				'link_class' => 'elgg-button elgg-button-action'
			);
			$return[] = ElggMenuItem::factory($options);
		}
	}

	return $return;
}

/**
 * View page that allow to add new group members
 */
function addgroupmembers_page_handler ($page) {
	$params = array();

	$group_guid = $page[0];

	$form_vars = array();
	$body_vars = array('group_guid' => $group_guid);

	$params['content'] = elgg_view_form('addgroupmembers/add', $form_vars, $body_vars);
	$params['filter'] = false;
	$params['title'] = elgg_echo('addgroupmembers:add:title');

	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($params['title'], $body);
	return true;
}