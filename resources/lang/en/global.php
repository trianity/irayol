<?php

return [
	'language' => 'Language',
	'welcome' => 'Hi and Welcome!',
	
	'user-management' => [
		'title' => 'User Management',
		'created_at' => 'Time',
		'fields' => [
		],
	],
	
	'permissions' => [
		'title' => 'Permissions',
		'created_at' => 'Time',
		'fields' => [
			'name' => 'Name',
		],
	],
	
	'roles' => [
		'title' => 'Roles',
		'created_at' => 'Time',
		'fields' => [
			'name' => 'Name',
			'permission' => 'Permissions',
		],
	],
	
	'users' => [
		'title' => 'Users',
		'created_at' => 'Time',
		'fields' => [
			'name' => 'Name',
			'email' => 'Email',
			'password' => 'Password',
			'roles' => 'Roles',
			'remember-token' => 'Remember token',
		],
	],
	'create' => 'Create',
	'save' => 'Save',
	'edit' => 'Edit',
	'view' => 'View',
	'update' => 'Update',
	'list' => 'List',
	'no_entries_in_table' => 'No entries in table',
	'custom_controller_index' => 'Custom controller index.',
	'logout' => 'Logout',
	'add_new' => 'Add new',
	'are_you_sure' => 'Are you sure?',
	'back_to_list' => 'Back to list',
	'dashboard' => 'Dashboard',
	'delete' => 'Delete',
	'global_title' => 'Roles-Permissions Manager',

	// Admin Home
	'home' => 'Home',
	'pages' => 'Pages',
	'blogs' => 'Blogs',
	'media' => 'Media',
	'categories' => 'Categories',

	// Admin Navbar
	'view_site' => 'View site',
	'profile' => 'Profile',
	'settings' => 'Settings',
	'themes' => 'Themes',
	'modules' => 'Modules',
	'menu' => 'Menu'



];