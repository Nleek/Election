<?php require("../includes/includes.php");
$additional = $_POST["additional"];
foreach($additional as $question){
    $total = $question[1]+$question[2];
    if($total != 0){
        $percent_yes = round($question[1] / $total, 2)*100;
        $percent_no = round($question[2] / $total, 2)*100;
    }
    else{
        $percent_yes = 0;
        $percent_no = 0;
    }
    echo"
        <article id='additional-$question[0]' class='quarter'>
            <h3>Question $question[0]</h3>
            <h4>$percent_yes% Yes</h4>
            <h4>$percent_no% No</h4>
        </article>
    ";
}
?>