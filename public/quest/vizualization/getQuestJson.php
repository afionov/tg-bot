<?php
if (!isset($_GET['pass']) || $_GET['pass'] !== 'etpgpb-ml') {
    die();
}


$quest = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../config/quest.json');

echo $quest;