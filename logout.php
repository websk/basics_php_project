<?php
require "auth.php";

if (remove_user_session_id()) {
    header('Location: /');
    exit;
}

header('HTTP/1.0 403 Forbidden');
