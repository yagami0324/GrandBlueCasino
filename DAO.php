<?php

// 1. 変数の宣言
$dsn  = 'mysql:dbname=GrandBlueCasino;host=localhost';
$user = "gbf_master";
$pass = "GraPass";
$test = "PDO_Result:";

// 2. try&catchを使いつつPDOでデータベース接続
try{    
    $pdo = new PDO($dsn,$user,$pass);
} catch (PDOException $e) {
    exit('データベースに接続できませんでした。' . $e->getMessage());
} 


// 3. SQL文を実行、表示
$stmt = $pdo->query('SQL文');

if (!$stmt){
    $info = $pdo->errorInfo();

    exit($info[2]);
}
    while($data= $stmt->fetch(PDO::FETCH_ASSOC)){
        echo $testName;
        echo '<p>'. $data['col1'] ."</p>\n";
}

    // 4. データベースから切断
    $pdo = null;
