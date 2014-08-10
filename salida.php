<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fin de la sesión</title>
</head>
<?php
session_start();
session_destroy();

echo '
					<html>
						<head>
							<meta http-equiv="refresh"content="0;url=index.php">
						</head>
					</html>
';

?>
<body>
</body>
</html>