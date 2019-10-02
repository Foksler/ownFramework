<?php

$response = new \Symfony\Component\HttpFoundation\Response();
$response->setContent('Goodbye!');
$response->send();
