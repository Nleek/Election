<!DOCTYPE html>
<html lang="en">
<head>
    <?php require("includes/head.php");?>
    <title>McCann 2016 Mock Election</title>
    <style>
        main section:not(#landing){
            margin-top:75px;
            font-family: "Maven Pro", Arial;
            font-size: 1.3em;
            overflow: auto;
            position: relative;
        }
        .hidden{
            opacity: 0;
        }
        #background{
            height: inherit;
            display: block;
            overflow: hidden;
            position: absolute;
            width: 100%;
            top: 0px;
            left:0px;
            z-index:0;
        }
        #background div{
            display: block;
            width: 50%;
            height: inherit;
            margin: 0;
            padding: 0;
        }
        #bg-red{
            float: left;
            background-color: rgb(187, 19, 62);
        }
        #bg-blue{
            float: right;
            background-color: rgb(0, 33, 71);
        }
        #overlay{
            border-left: 0;
            border-right: 0;
            border-top: 1px solid #fff;
            border-bottom: 1px solid #fff;
            z-index: 10;
            position: absolute;
            top: 0px;
            left:0px;
            font-family: "Montserrat", Arial;
            padding: 60px;
            text-align: center;
        }
        #overlay h1{
            font-size: 1.8em;
            color: #fff;
            text-transform: uppercase;
            margin: 0;
            padding: 0 0 60px;
        }
        #overlay button{
            width: 50%;
            min-width: 150px;
            text-align: center;
            font-family: inherit;
            color: rgb(0, 33, 71);
            background-color: #fff;
            font-size: 1em;
            padding: 10px 20px;
            border: 1px solid #fff;
        }
        #overlay button:hover{
            -moz-transform: scale(1.1);
            -webkit-transform: scale(1.1);
            -o-transform: scale(1.1);
            -ms-transform: scale(1.1);
            transform: scale(1.1);
            cursor: pointer;
        }

        #contestants, #questions{
            overflow: hidden;
            padding-bottom: 1em;
            width: 90%;
            margin: 0 auto;
        }
        .republican figcaption:after{
            content:"REPUBLICAN PARTY";
        }
        .democrat figcaption:after{
            content:"DEMOCRATIC PARTY";
        }
        .republican:hover figcaption:after, .democrat:hover figcaption:after{
            color: #fff !important;
        }
        .libertarian figcaption:after{
            content: 'LIBERTARIAN PARTY';
        }
        .green figcaption:after{
            content: 'GREEN PARTY';
        }
        .libertarian:hover figcaption:after, .green:hover figcaption:after{
            color: #000 !important;
        }

        .quarter{
            width: calc(20% - 2px);
            padding: 2.5%;
            text-align: center;
            float: left;
        }
        .quarter label{
            width: 90%;
            padding: 5%;
            text-align: center;
            display: block;
        }
        .quarter input, .quarter select{
            width: 90%;
            padding: 10px;
            margin-top: 1em;
            font-size: 1em;
            font-family: "Maven Pro", Arial;
            border: 1px solid #d0d0d0;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }
        .quarter select{
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            position: relative;
            background: url(images/down.png) no-repeat right #fff;
        }
        .radio{
            text-align: left !important;
            padding: 0 !important;
        }
        .radio input{
            display: inline-block;
            width: 20px !important;
        }

        #additional_questions .padding-center{
            overflow: hidden;
        }
        .additional_question{
            width: 20%;
            padding: 2%;
            margin: 0.5%;
            font-size: 0.8em;
            float: left;
            background-color: #fff;
        }
        .additional_question h3{
            padding: 5px;
        }
        .additional_question label{
            display: block;
            margin-bottom: 7px;
            padding: 5px;
        }
        .additional_question label:hover{
            background-color: #eeeeee;
        }
        .additional_question label:hover{
            cursor: pointer;
        }
        .additional_question input[type="radio"]{
            display: none;
        }
        .additional_question input[type="radio"]:checked + label{
            background-color: #e7e7ff !important;
        }
        #place-vote,#past-additional{
            width: 33.33%;
            min-width: 150px;
            text-align: center;
            color: #fff;
            background-color: rgb(0, 33, 71);
            font-size: 0.8em;
            padding: 10px 20px;
            border: none;
            font-family: "Montserrat", Arial;
            display: block;
            margin: 0 auto;
        }
        #place-vote:hover,#past-additional:hover{
            -moz-transform: scale(1.1);
            -webkit-transform: scale(1.1);
            -o-transform: scale(1.1);
            -ms-transform: scale(1.1);
            transform: scale(1.1);
            background-color: rgb(187, 19, 62);
            color: #fff;
            cursor: pointer;
        }
        #past-additional{
            margin-top: -3.5em;
        }
    </style>
</head>
<body>
<?php require("includes/header.php");?>
<main>
    <section id="landing" class="transition" data-scrolled="false">
        <div id="background">
            <div id="bg-red"></div>
            <div id="bg-blue"></div>
        </div>
        <div id="overlay" class="absolute-center">
            <h1>McCann 2016 Mock Election</h1>
            <button id="vote-button" class="transition">Vote Now!</button>
        </div>
    </section>
    <section id="vote">
        <div id="accent">
            <span id="accent-red"></span>
            <span id="accent-white"></span>
            <span id="accent-blue"></span>
        </div>
        <div class="padding-center">
            <h1>Choose your candidate.</h1>
            <hr />
            <div id="contestants">
                <figure id="c0" class="republican">
                    <img src="images/trump.png" alt="Donald Trump" />
                    <figcaption>
                        Donald Trump
                    </figcaption>
                </figure>
                <figure id="c1" class="democrat">
                    <img src="images/hillary.png" alt="Hillary Clinton" />
                    <figcaption>
                        Hillary Clinton
                    </figcaption>
                </figure>
                <figure id="c2" class="libertarian">
                    <img src="images/gary.png" alt="Gary Johnson" />
                    <figcaption>
                        Gary Johnson
                    </figcaption>
                </figure>
                <figure id="c3" class="green">
                    <img src="images/jill.png" alt="Jill Stein" />
                    <figcaption>
                        Jill Stein
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>
    <section id="additional_questions">
        <div class="padding-center">
            <h1>Vote Yes or No on each of the following questions:</h1>
            <?php
            if($questions = $connection->prepare("SELECT * FROM `questions`")){
                $questions->execute();
                $questions->bind_result($yes, $no, $num_yes, $num_no, $question_id);
                while($questions->fetch()){
                    echo"
                    <div id='q$question_id' class='additional_question'>
                        <h3>Question $question_id</h3>
                        <input id='q$question_id-yes' name='q$question_id' type='radio' value='yes' />
                        <label for='q$question_id-yes'>
                            YES - $yes
                        </label>
                        <br />
                        <input id='q$question_id-no' name='q$question_id' type='radio' value='no' />
                        <label for='q$question_id-no'>
                            NO - $no
                        </label>
                    </div>
                    ";
                }
            }
            ?>
        </div>
        <button id="past-additional" class="transition hidden">NEXT</button>
        <br />
        &nbsp;
    </section>
    <section id="information">
        <div class="padding-center">
            <h1>Enter a bit of information.</h1>
            <hr />
            <div id="questions">
                <div class="quarter">
                    <label for="shop">
                        Shop:
                        <select name="shop" id="shop">
                            <optgroup label="Secondary">
                                <option value="s1" selected="selected">Automotive</option>
                                <option value="s2">Business Technology</option>
                                <option value="s3">Carpentry / Cabinetry</option>
                                <option value="s4">Computer Assisted Drafting</option>
                                <option value="s5">Culinary Arts</option>
                                <option value="s6">Electricity</option>
                                <option value="s7">Information Technology</option>
                                <option value="s8">Machine Technology</option>
                                <option value="s9">Metal Fabrication</option>
                            </optgroup>
                            <optgroup label="Postsecondary">
                                <option value="s10">Cosmetology</option>
                                <option value="s11">Dental Assisting</option>
                                <option value="s12">Medical Assisting</option>
                                <option value="s13">Practical Nursing</option>
                                <option value="s14">Surgical Technology</option>
                            </optgroup>
                            <optgroup label="Faculty">
                                <option value="s15">Teacher</option>
                                <option value="s16">Guidance Counselor</option>
                                <option value="s17">Administrator</option>
                                <option value="s18">Other</option>
                            </optgroup>
                        </select>
                    </label>
                </div>
                <div id="gender" class="quarter">
                    <label for="male" class="radio">
                        <input id="male" name="gender" type="radio" value="male" />Male
                    </label>
                    <label for="female" class="radio">
                        <input id="female" name="gender" type="radio" value="female" />Female
                    </label>
                </div>
                <div class="quarter">
                    <label for="grade">
                        Grade:
                        <input name="grade" id="grade" type="number" min="8" max="13" placeholder="8" />
                    </label>
                </div>
                <div class="quarter">
                    <label for="age">
                        Age:
                        <input name="age" id="age" type="number" min="14" placeholder="15" />
                    </label>
                </div>
            </div>
            <button id="place-vote" class="transition">Submit your vote!</button>
        </div>
    </section>
</main>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/main.js"></script>
<script>
    function checkAdditional(){
        var additional_questions = [];
        $(".additional_question").each(function(){
            var question_id = $(this).attr("id");
            additional_questions.push($(this).find("input[name="+question_id+"]:checked").val());
        });
        if(additional_questions.indexOf(undefined) != -1){
            return false;
        }
        else{
            return additional_questions;
        }
    }
    function checkInfo(){
        var voted_for = $("#questions").data("vote");
        var shop = $("#shop").val();
        var grade = $("#grade").val();
        var age = $("#age").val();
        var gender = $("#questions").find("input[name='gender']:checked").val();
        var additional_questions = checkAdditional();
        console.log(voted_for+" "+shop+" "+grade+" "+age+" "+gender+" "+additional_questions);
        if(
            voted_for != undefined &&
            shop != null &&
            grade != null && grade != "" && !isNaN(grade) && (8 <= grade) && (14 >= grade) &&
            age != null && age != "" && !isNaN(age) && (14 <= age) &&
            gender != undefined &&
            additional_questions != false
        ){
            voted_for = Number(voted_for.replace("c",""));
            shop = Number(shop.replace("s",""));
            var token = create_csrf();
            return {"contestant_id":voted_for,"shop_id":shop,"grade":grade,"age":age,"gender":gender,"additional":additional_questions,"csrftoken":token};
        }
        else{
            if(voted_for == undefined){
                alert("You did not vote for a candidate.");
                $("#landing").data("scrolled","1");
                $("#landing").animate({"marginTop":(-1*height)+"px"},"fast");
            }
            if( additional_questions == false){
                alert("You did not answer all of the questions.");
                $("#landing").data("scrolled","2");
                $("#landing").animate({"marginTop":(-2*height)+"px"},"fast");
            }
            if(shop == null){
                $("#shop").css({"border":"1px solid rgb(187, 19, 62)"});
            }
            if(grade == null || grade == "" || isNaN(grade) || !(8 <= grade) || !(13 >= grade) ){
                $("#grade").css({"border":"1px solid rgb(187, 19, 62)"});
            }
            if(age == null || age == "" || isNaN(age) || !(14 <= age) ){
                $("#age").css({"border":"1px solid rgb(187, 19, 62)"});
            }
            if(gender == undefined){
                $("#gender").css({"border":"1px solid rgb(187, 19, 62)"});
            }
            return false;
        }
    }
    $(document).ready(function(){
        adjustPage();
        setCookie("csrftoken","","-1000");
        $("#vote-button").click(function(){
            create_csrf();
            $("#landing").data("scrolled","1");
            $("#landing").animate({"marginTop":(-1*height)+"px"},"fast",function(){
                $("#accent").css({"position":"fixed","top":"75px"});
            });
        });
        $("#contestants").find("figure").click(function(){
            var me = $(this);
            $("#questions").data("vote", me.attr("id"));
            $("#landing").data("scrolled","2");
            $("#landing").animate({"marginTop":(-2*height)+"px"},"fast");
        });
        $(".additional_question").click(function(){
            if(checkAdditional()){
                $("#past-additional").css("opacity","1");
            }
        });
        $("#past-additional").click(function(){
            $("#landing").data("scrolled","3");
            $("#landing").animate({"marginTop":(-3*height)+"px"},"fast",function(){
                $("#accent").css({"position":"fixed","top":"75px"});
            });
        });
        $("#place-vote").click(function(){
            var info = checkInfo();
            if(info){
                $.post("php/submit_vote.php",info,function(response){
                    if(!response){
                        window.location.href = "polls?voted=true";
                    }
                    else{
                        console.log(response);
                        alert("An error has occurred, check console for more information.");
                    }
                });
            }
        });
        $("#shop").change(function(){
            var value = $("#shop").val();
            value = Number(value.replace("s",""));
            if(9 < value && value < 15){
                $("#grade").val("13");
            }
            else if(value >= 15){
                $("#grade").val("14");
            }
        });
    });
    $(window).resize(function(){
        adjustPage();
        var scroll_check = $("#landing").data("scrolled");
        if(scroll_check!="false"){
            scroll_check = Number(scroll_check);
            $("#landing").css({"marginTop":(-scroll_check*height)+"px"});
        }
    });
</script>
</html>