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
$e_royal = $pokermodel->is_RoyalStraightFlush();
$f_five = $pokermodel->is_FiveCard();
$g_straightflush = $pokermodel->is_StraightFlush();
$h_four = $pokermodel->is_FourOfAKind();
$i_fullhouse = $pokermodel->is_FullHouse();
$j_flush = $pokermodel->is_Flush();
$k_straight = $pokermodel->is_Straight();
$l_three = $pokermodel->is_ThreeOfAKind();
$m_two = $pokermodel->is_TwoPair();
$n_one = $pokermodel->is_OnePair();

echo 'end';
