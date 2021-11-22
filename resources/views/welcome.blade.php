<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ScanPaid</title>
    </head>
    <body class="antialiased">
<?php
header("Location: https://scanpaid.ifs.edu.pk/admin/", true, 301);
exit();
?>
    </body>
</html>
