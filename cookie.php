<?php
setcookie("TOKEN", time(), time() + 3600 * 24 * 365, '/');
var_dump($_COOKIE);
var_dump($_REQUEST);
var_dump($_SERVER);
var_dump(function_exists('sqlite_open'));
var_dump(PDO::getAvailableDrivers());
?>

<script>
  console.log(document.cookie)
</script>
