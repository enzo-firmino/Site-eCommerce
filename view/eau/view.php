<?php
		// Si $controleur='eau' et $view='list',
		// alors $filepath="/chemin_du_site/view/eau/list.php"
		$filepath = File::build_path(array('view', 'view.php'));
		require $filepath;
		?>
