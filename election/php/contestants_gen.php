<?php require("../includes/includes.php");
    $candidates = $_POST["candidates"];
    $number_votes = $_POST["num_votes"];
    foreach($candidates as $candidate){
        if($number_votes != 0){
            $percentage = round($candidate[4] / $number_votes, 2)*100;
        }
        else{
            $percentage = 0;
        }
        echo"
            <figure id='c$candidate[0]' class='$candidate[2]'>
                <img src='$baseURL/images/$candidate[3]' alt='$candidate[1]' />
                <figcaption>
                    $candidate[1]
                    <br />
                    <progress value='$candidate[4]' max='$number_votes'></progress>
                    <br />
                    $percentage%
                </figcaption>
            </figure>
        ";
    }
?>