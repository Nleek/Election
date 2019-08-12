<?php require('../includes/includes.php');
/**
 * Auth: Lukas Yelle
 * Date: 10/31/16
 * Time: 1:40 AM
 */
$csrf = isset($_COOKIE["csrftoken"]) ? $_COOKIE["csrftoken"] : false;
$sent_csrf = isset($_POST["csrftoken"]) ? $_POST["csrftoken"] : false;

if($csrf == $sent_csrf && $sent_csrf != false){

    //Get values.
    $candidate = $_POST["contestant_id"];
    $voter_shop = $_POST["shop_id"];
    $voter_grade = $_POST["grade"];
    $voter_age = $_POST["age"];
    $voter_gender = $_POST["gender"];
    $vote_time = time();
    $additional = $_POST["additional"];

    //Prepare statements.
    if($voter_sql = $connection->prepare("INSERT INTO `voters`(`shop`, `grade`, `age`, `gender`, `csrf`) VALUES (?,?,?,?,?)")){
        $voter_sql -> bind_param("iiisi", $voter_shop, $voter_grade, $voter_age, $voter_gender, $csrf);
        $voter_sql -> execute();
        if($voter_id_sql = $connection->prepare("SELECT `voter_id` FROM `voters` WHERE `csrf`=?")){
            $voter_id_sql -> bind_param("i", $csrf);
            $voter_id_sql -> execute();
            $voter_id_sql -> bind_result($id);
            while($voter_id_sql -> fetch()){
                $voter_id = $id;
            }
            $voter_id_sql -> close();
            if($vote_sql = $connection->prepare("INSERT INTO `votes`(`voted_for`, `voted_time`, `voter_id`) VALUES (?,?,?)")){
                $vote_sql -> bind_param("iii", $candidate, $vote_time, $voter_id);
                $vote_sql -> execute();
            }
            else{
                printf("Error: %s.\n", $connection->error);
            }
        }
        else{
            printf("Error: %s.\n", $connection->error);
        }
    }
    else{
        printf("Error: %s.\n", $connection->error);
    }

    $question_index = 1;
    foreach($additional as $question_answer){

        if($question_answer == "yes"){
            if($question = $connection->prepare("UPDATE `questions` SET `num_yes`=`num_yes`+1 WHERE `question_id`=?")){
                $question->bind_param("i",$question_index);
                $question->execute();
            }
        }
        else{
            if($question = $connection->prepare("UPDATE `questions` SET `num_no`=`num_no`+1 WHERE `question_id`=?")){
                $question->bind_param("i",$question_index);
                $question->execute();
            }
        }
        $question_index++;

    }
}
