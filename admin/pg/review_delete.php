<?php
//보안부분(세션등록, 체크할내용, GET, POST)
session_start();
$ses_id = (isset($_SESSION['ses_id']) && $_SESSION['ses_id'] != '') ? $_SESSION['ses_id'] : '';
$ses_level = (isset($_SESSION['ses_level']) && $_SESSION['ses_level'] != '') ? $_SESSION['ses_level'] : '';

if ($ses_id == '' || $ses_level != 10) {
  $arr = ['result' => "access_denied"];
  die(json_encode($arr));
}

include_once $_SERVER['DOCUMENT_ROOT'] . "/php_treefare/inc/db_connect.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/php_treefare/inc/image_board.php";
$imageboard = new ImageBoard($conn);

$idx = (isset($_POST['idx']) && $_POST['idx'] != '' && is_numeric($_POST['idx'])) ? $_POST['idx'] : '';

if ($idx == '') {
  $arr = ['result' => "empty_idx"];
  die(json_encode($arr));
}

$imageboard->del_of_num($idx);
$arr = ['result' => "success"];
die(json_encode($arr));
