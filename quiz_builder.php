<?php
require_once('core/inc/func/app/quiz/main.php');

// create the main array of questions for a quiz
$dataset = array();

// create a question set
$question_set = create_question_set('heres a question', 30);



// this is where a loop would usually start

$question_text = 'This is a question.';

// add a multiple choice question
$answer_list[] = 'This is the first answer';
$answer_list[]= 'This is the second answer';
$answer_list[] = 'This is the third answer';
$answer_list[] = 'This is the fourth answer';

$answer_key[] = 0;
$answer_key[] = 0;
// 1 denotes a correct answer
$answer_key[] = 1;
$answer_key[] = 0;

// add a multiple choice question to a question set
$question_set = create_mcq($question_set, $question_text, $answer_list, $answer_key);

// add a multiple choice question to a question set
$question_set = create_mcq($question_set, $question_text, $answer_list, $answer_key);



var_dump($question_set);












/*
$q1 = array();
$q1['type'] = 1;
$q1['text'] = 'This is the question!';
$a_data = array();
$a_data['correct_data'] = 'correct data here';
$answers = array();
$answers[1] = 'This is answer 1';
$answers[2] = 'This is answer 2';
$answers[3] = 'This is answer 3';
$answers[4] = 'This is answer 4';
$a_data['questions'] = $answers;

$q1['answer_data'] = $a_data;



$el_set[1] = $q1;
$elements[1] = $el_set;
$orig_data[1] = $elements;

$original['properties'] = $orig_props;
$original['data'] = $orig_data;


var_dump($original);
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 $question_text = 'This is a fill in the blank question!';


// okay, so lets create a fill in the blank question
$answer_key[1] = 'saget';
$answer_key[2] = 'saget';


// add a fill-in-the-blank question to a question set
$question_set = create_fibq($question_set, $question_text, $answer_key);









// cool, now lets create an essay question
$question_text = 'This is an essay question.';

// add an essay question to a question set
$question_set = create_essayq($question_set, $question_text);
*/


?>
