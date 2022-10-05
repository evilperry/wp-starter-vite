<?php

$public_uri = get_template_directory_uri() .'/dist';
if(ndh_is_vite_development()) {
  $dotenv = Dotenv\Dotenv::createImmutable(get_template_directory());
  $dotenv->safeLoad();
  $vite_server_port = $_ENV['VITE_SERVER_PORT'] ?? 3000;
  $public_uri = 'http://localhost:' .$vite_server_port .'/src';
}
define('PUBLIC_URI', $public_uri);

?>
