<?php
// session を使用する際に必要

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function createToken()
{
  if (!isset($_SESSION['token'])) {
    // bin2hex バイナリ（2進数）から16進数へ変更　random_bytes 引数で渡した桁数の暗号を作成
    $_SESSION['token'] = bin2hex(random_bytes(32));
  }
}

function validateToken()
{
  if (
    empty($_SESSION['token']) ||
    $_SESSION['token'] !== filter_input(INPUT_POST, 'token')
  ) {
    exit('Invalid post request');
  }
}

session_start();
