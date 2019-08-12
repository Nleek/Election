<?php require("../includes/includes.php");
$candidates = Array();
if($contestants = $connection->prepare("SELECT * FROM `contestants`")){
    $contestants->execute();
    $contestants->bind_result($name, $party, $picture, $contestant_id);
    while($contestants->fetch()){
        $candidate = Array($contestant_id, $name, $party, $picture, 0);
        array_push($candidates, $candidate);
    }
    $contestants->close();

    $profiles = Array();
    if($voters = $connection->prepare("SELECT * FROM `voters`")){
        $voters->execute();
        $voters->bind_result($shop, $grade, $age, $gender, $csrf, $voter_id);
        while($voters->fetch()){
            $voter = Array($voter_id, $shop, $grade, $age, $gender);
            array_push($profiles, $voter);
        }
        $voters->close();

        $all_votes = Array();
        if($votes = $connection->prepare("SELECT * FROM `votes`")){
            $votes->execute();
            $votes->bind_result($voted_for, $voted_time, $voter_id, $vote_id);
            while($votes->fetch()) {
                $vote = Array($voted_for, $voter_id);
                array_push($all_votes, $vote);
            }
            $votes->close();

            $all_shops = Array();
            if($shops = $connection->prepare("SELECT * FROM `shops`")){
                $shops->execute();
                $shops->bind_result($shop_name,$shop_id);
                while($shops->fetch()){
                    $shop = Array($shop_id, $shop_name);
                    array_push($all_shops, $shop);
                }
                $shops->close();

                # Parse information.
                $number_votes = count($all_votes);
                $vote_index = 0;
                foreach($all_votes as $vote){
                    $candidate_index = 0;
                    foreach($candidates as $candidate){
                        if($candidate[0] == $vote[0]){
                            $candidates[$candidate_index][4]++;
                            $all_votes[$vote_index][0] = $candidate;
                        }
                        $candidate_index++;
                    }
                    $voter_index = 0;
                    foreach($profiles as $profile){
                        if($profile[0] == $vote[1]){
                            $all_votes[$vote_index][1] = $profile;
                        }
                        $voter_index++;
                    }
                    $shop_index = 0;
                    foreach($all_shops as $shop){
                        if($shop[0] == $all_votes[$vote_index][1][1]){
                            $all_votes[$vote_index][1][1] = $shop;
                        }
                        $shop_index++;
                    }
                    $vote_index++;
                }

                echo "num_votes = $number_votes;";
                echo "contestants = ".json_encode($candidates).";";
                echo "votes = ".json_encode($all_votes).";";
            }
        }
    }
}
$questions = Array();
if($additional_questions = $connection -> prepare("SELECT * FROM `questions`")){
    $additional_questions->execute();
    $additional_questions->bind_result($yes_body,$no_body,$num_yes,$num_no,$question_id);
    while($additional_questions->fetch()){
        $question = Array($question_id, $num_yes, $num_no);
        array_push($questions, $question);
    }
    $additional_questions->close();
    echo "additional_questions = ".json_encode($questions).";";
}
?>