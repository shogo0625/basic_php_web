<?php

require('../app/functions.php');

// form から送られた値を取得する GET形式で送られたmessageという名前のデータ
$messageFromGet = trim(filter_input(INPUT_GET, 'messageFromGet')); // trim 空白や改行を除去
$messageFromGet = $messageFromGet !== '' ? $messageFromGet : '...';
$text = trim(filter_input(INPUT_GET, 'text')); // trim 空白や改行を除去
$text = $text !== '' ? $text : '...';
// 配列を受け取る場合のオプション
$colors = filter_input(INPUT_GET, 'colors', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$colors = empty($colors) ? 'None selected' : implode(',', $colors); // 配列を区切り文字で連結し文字列へ
// null合体演算子　nullだった場合は、?? 以降の処理
$colorFromGet = filter_input(INPUT_GET, 'color') ?? 'transparent';
// session_startすると使える
$_SESSION['color'] = $colorFromGet;

include('../app/_parts/_header.php');

?>
<p>Message added!</p>

<p><?= h($messageFromGet); ?></p>
<!-- 改行をHTMLに変換する関数 -->
<p><?= nl2br(h($text)); ?></p>
<p><?= h($colors); ?></p>
<p><?= h($colorFromGet); ?></p>
<p><a href="index.php">Go back</a></p>

<?php

include('../app/_parts/_footer.php');
