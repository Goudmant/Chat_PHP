<?php
if(user_verified()) {
	$insert = $db->prepare('
		UPDATE chat_online SET online_status = :status WHERE online_user = :pseudo
	');
	$insert->execute(array(
		'status' => $_POST['status'],
		'pseudo' => $_SESSION['pseudo']		
	));
}
?>