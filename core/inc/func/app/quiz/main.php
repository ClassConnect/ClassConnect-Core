<?php
// create a question set
function create_question_set($title, $points) {
    $set = array();
    $set['title'] = $title;
    $set['points'] = $points;
    return $set;
}
// end create_question_set



// create a multiple choice question
function create_mcq($question_set, $question_text, $answer_list, $answer_key) {
    $question = array();
    $question['type'] = '1';
    $question['answer_list'] = $answer_list;
    $question['answer_key'] = $answer_key;
    $question_set['el_set'][] = $question;
    return $question_set;
}


?>
