<<?php 

function updateUserInfo($username) {
	$modtime = date("Y-m-d H:i:s");
	$modby = $_SESSION['USERNAME'] ?: "unknown";
	require_once '../../includes/config.php';

	try {
		$link = new PDO( RAD_DB_DRIVER . ':host=' . RAD_DB_HOST . ';dbname=' . RAD_DB_NAME, RAD_DB_USER, RAD_DB_PASS );
	} catch ( PDOException $Exception ) {
		die( $Exception->getMessage() );
	}

	$UserInfo = $link->prepare('UPDATE userinfo SET updatedate = :modtime, updateby = :modby WHERE username = :username');
	$UserInfo->bindParam( ':username', $username );
	$UserInfo->bindParam( ':modtime', $modtime );
	$UserInfo->bindParam( ':modby', $modby );
	$UserInfo->execute();

}
