<?php

require('../app/functions.php');

unset($_SESSION['color']);

// header関数 ページのリダイレクト
header('Location: http://localhost:8080/index.php');
