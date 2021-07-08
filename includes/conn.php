<?php
try {
	$conn = new PDO('mysql:host=localhost; dbname=u1865077; charset=utf8', 'u1865077', 'CG05dec19cg');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $exception)
{
	echo "Oh no, there was a problem - " . $exception->getMessage();
}
?>
