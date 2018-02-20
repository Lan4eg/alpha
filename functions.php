<?php

function render_header($user_params = [])
{
	$params = [
		'title' => PROJECT_TITLE,
		'is_home' => false,
		'menu_active_item' => 'home'
	];
	$params = array_merge($params, $user_params);

	include PATH_PARTIALS . 'header.php';
}

function render_footer()
{
	include PATH_PARTIALS . 'footer.php';
}

function render_menu()
{
	global $db;
	$sql = '
			SELECT * 
			FROM `menu_items`
			ORDER BY `ord` ASC
			';
	$result = mysqli_query($db, $sql);
	$items = [];
	while($row = mysqli_fetch_assoc($result))
	{
		$items[] = $row;
	}
	foreach($items as $id => $item)
	{
		$parent_id = (int) $item['parent_id'];
		if($parent_id > 0)
		{
			$items[$parent_id]['submenu'][] = $item;
		}
	}
		echo "<pre>";
		var_dump($items);
		echo "</pre>";
}
render_menu();