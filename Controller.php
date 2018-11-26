<?php
require "Model.php";

test

$poker_model = new PokerModel;

echo '【初期手札】'.PHP_EOL;
$poker_model->makeHand();
$poker_model->viewHand();
$poker_model->checkPokerHand();
$poker_model->viewPokerHandNameJa();
echo PHP_EOL;

echo '【マリガン後】'.PHP_EOL;
$poker_model->changeHand(0b10101);
$poker_model->viewHand();
$poker_model->checkPokerHand();
$poker_model->viewPokerHandNameJa();
echo PHP_EOL;

echo '【デバッグ用手札】'.PHP_EOL;
$poker_model->setDebugHand( [14,10,11,1,13] );
$poker_model->viewHand();
$poker_model->checkPokerHand();
$poker_model->viewPokerHandNameJa();
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
