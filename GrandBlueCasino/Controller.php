<?php
require "Model.php";

$pokermodel = new PokerModel;

echo '初期手札'.PHP_EOL;
$pokermodel->makeHand();
$pokermodel->viewHand();

echo 'マリガン後'.PHP_EOL;
$pokermodel->changeHand(0b10101);
$pokermodel->viewHand();

echo '================'.PHP_EOL;
echo 'デバッグ用手札'.PHP_EOL;
$pokermodel->setDebugHand( [53,53,53,2,1] );
$pokermodel->viewHand();

$a_joker = $pokermodel->setNumJoker();
$b_flush = $pokermodel->setFlgFlush();
$c_straight = $pokermodel->setFlgStraight();
$d_royal = $pokermodel->is_RoyalStraightFlush();
echo 'end';

//次はcountSameRankをリファクタリング
//setArraySameRank

//その後にファイブカードか？