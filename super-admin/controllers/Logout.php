<?php 
// Clear cookies
setcookie('user_id', '', time() - 3600, '/');
setcookie('user_email', '', time() - 3600, '/');
setcookie('phone', '', time() - 3600, '/');
setcookie('uname', '', time() - 3600, '/');
setcookie('user_designation', '', time() - 3600, '/');
setcookie('user_image', '', time() - 3600, '/');
setcookie('final_pass', '', time() - 3600, '/');
setcookie('user_type', '', time() - 3600, '/');
setcookie('user_name', '', time() - 3600, '/');
setcookie('name', '', time() - 3600, '/');
setcookie('s_date', '', time() - 3600, '/');
setcookie('e_date', '', time() - 3600, '/');
setcookie('dbNo', '', time() - 3600, '/'); // also clear dbNo if set

// Clear session
session_unset();
session_destroy();

// Redirect to login
header('Location: ../login');
exit;

?>