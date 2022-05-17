<?php
// global db connection for all pages
$db = new PDO('mysql:host=;dbname=', '', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);