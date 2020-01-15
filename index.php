<?php
    set_time_limit(0);
    error_reporting(-1);
    ini_set('display_errors', 1);
    require_once(__DIR__ . '/vendor/autoload.php');
    require_once(__DIR__ . '/PhantomParser.php');

    if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['keyword']) && !empty($_POST['keyword'])) {
        $id = trim($_POST['id']);
        $keyword = trim($_POST['keyword']);
        $parser = new PhantomParser($id, $keyword);
        $resultArray = $parser->run();
    }

    require_once(__DIR__ . '/form.php');