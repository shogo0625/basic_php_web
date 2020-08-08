<?php

require('../app/functions.php');

createToken();

// 重複する記述は定数にする
define('FILENAME', '../app/messages.txt');

// POSTでリクエストされたか確認する
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  validateToken();

  // POSTで送信された内容を取得
  $message = trim(filter_input(INPUT_POST, 'message'));
  $message = $message !== '' ? $message : '...';
  // ファイルをオープンして書き込み
  $fp = fopen(FILENAME, 'a');
  fwrite($fp, $message . "\n");
  fclose($fp);

  header('Location: http://localhost:8080/result.php');
  exit;
}

$messages = file(FILENAME, FILE_IGNORE_NEW_LINES);

include('../app/_parts/_header.php');

?>

<form action="result.php" method="get">
  <input type="text" name="message">
  <textarea name="text"></textarea>
  <!-- セレクトボックス　multiple 値を配列形式で複数渡せる -->
  <select name="colors[]" multiple>
    <option value="orange">Orange</option>
    <option value="pink">Pink</option>
    <option value="gold">Gold</option>
  </select>
  <!-- チェックボックス -->
  <label><input type="checkbox" name="colors[]" value="orange"> Orange</label>
  <label><input type="checkbox" name="colors[]" value="pink"> Pink</label>
  <label><input type="checkbox" name="colors[]" value="gold"> Gold</label>
  <!-- ラジオボタン　1つしか選択できない -->
  <label><input type="radio" name="color" value="orange"> Orange</label>
  <label><input type="radio" name="color" value="pink"> Pink</label>
  <label><input type="radio" name="color" value="gold"> Gold</label>

  <button>Send</button>

  <a href="reset.php">[reset]</a>
</form>

<!-- Postで別ファイルに内容を登録して表示する -->
<ul>
  <?php foreach ($messages as $message) : ?>
    <li><?= h($message); ?></li>
  <?php endforeach; ?>
</ul>

<form action="" method="post">
  <input type="text" name="message">
  <button>Post</button>
  <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
</form>

<?php

include('../app/_parts/_footer.php');
