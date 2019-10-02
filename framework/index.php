<?php

// framework/index.php
$name = isset($_GET['name']) ? $_GET['name'] : 'World';

printf('Hello %s', $name);
