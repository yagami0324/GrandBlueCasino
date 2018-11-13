<?php
require "Model.php";

$pokermodel = new PokerModel;

echo '【初期手札】'.PHP_EOL;
$pokermodel->makeHand();
$pokermodel->viewHand();
$pokermodel->checkPokerHand();
$pokermodel->viewPokerHandNameJa();
echo PHP_EOL;

echo '【マリガン後】'.PHP_EOL;
$pokermodel->changeHand(0b10101);
$pokermodel->viewHand();
$pokermodel->checkPokerHand();
$pokermodel->viewPokerHandNameJa();
echo PHP_EOL;

echo '【デバッグ用手札】'.PHP_EOL;
$pokermodel->setDebugHand( [1,10,11,53,13] );
$pokermodel->viewHand();
$pokermodel->checkPokerHand();
$pokermodel->viewPokerHandNameJa();
echo PHP_EOL;

//確認用
$a_num_joker = $pokermodel->setNumJoker();
$b_array_sameRank = $pokermodel->setArraySameRank();
$c_flg_flush = $pokermodel->setFlgFlush();
$d_flg_straight = $pokermodel->setFlgStraight();
$e_royal = $pokermodel->isRoyalStraightFlush();
$f_five = $pokermodel->isFiveCard();
$g_straightflush = $pokermodel->isStraightFlush();
$h_four = $pokermodel->isFourOfAKind();
$i_fullhouse = $pokermodel->isFullHouse();
$j_flush = $pokermodel->isFlush();
$k_straight = $pokermodel->isStraight();
$l_three = $pokermodel->isThreeOfAKind();
$m_two = $pokermodel->isTwoPair();
$n_one = $pokermodel->isOnePair();

echo 'end';
