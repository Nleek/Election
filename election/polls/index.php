<!DOCTYPE html>
<html lang="en">
<head>
    <?php require("../includes/head.php");?>
    <title>Current Polls | McCann 2016 Mock Election</title>
    <style>
        main{
            font-family: "Maven Pro", Arial;
        }
        #wrapper{
            padding-top: 35px;
            overflow: auto;
            text-align: center;
        }
        #winner{
            display: none;
            text-align: center;
            color:rgb(187, 19, 62);
        }
        #contestants{
            display: none;
        }
        #accent{
            position: fixed;
            top: 75px;
        }
        #statistics{
            display: none;
            position: absolute;
            padding: 5px 20px 5px 20px;
            background-color: #fff;
            -webkit-box-shadow: 0px 0px 13px 0px rgba(50, 50, 50, 0.55);
            -moz-box-shadow:    0px 0px 13px 0px rgba(50, 50, 50, 0.55);
            box-shadow:         0px 0px 13px 0px rgba(50, 50, 50, 0.55);
            text-align: left;
        }
        #statistics h3{
            margin-top: 0.3em;
            padding-bottom: 0.5em;
            margin-bottom: 0.5em;
            border-bottom: 1px solid #ccc;
        }
        #stats_close{
            font-size: 1.5em;
            font-family: "Maven Pro", Arial;
        }
        #stats_close:hover{
            cursor: pointer;
        }

        #additional{
            border-top: 1px solid #ccc;
            width: 90%;
            min-width: 400px;
            margin: 0 auto;
            overflow: hidden;
            display: none;
        }
        #additional .quarter{
            width: 20%;
            padding: 2.5%;
            text-align: center;
            float: left;
        }

        #vote-again{
            width: 25%;
            min-width: 150px;
            text-align: center;
            font-family: inherit;
            background-color: rgb(0, 33, 71);
            font-size: 1em;
            padding: 10px 20px;
            border: none;
            opacity: 0;
            margin: 0 auto 50px;
            color: #fff;
            display: none;
        }
        #vote-again:hover{
            -moz-transform: scale(1.1);
            -webkit-transform: scale(1.1);
            -o-transform: scale(1.1);
            -ms-transform: scale(1.1);
            transform: scale(1.1);
            cursor: pointer;
            background-color: rgb(187, 19, 62);
        }
    </style>
</head>
<body>
<?php require("../includes/header.php");?>
<main>
    <section id="wrapper">
        <div id="accent">
            <span id="accent-red"></span>
            <span id="accent-white"></span>
            <span id="accent-blue"></span>
        </div>
        <h1 id="voted" class="caps">Thank you for voting!<br />Check out the current results below.</h1>
        <h1 id="no-vote" class="caps">Check out the current results below.</h1>
        <h3 id="winner"></h3>
        <div id="contestants"></div>
        <div id="additional"></div>
        <div id="statistics" class="absolute-center" data-open="false">
            <a id="stats_close" class="right">x</a>
            <h3>Candidate: <span id="stats_candidate"></span></h3>
            <h4>Percent Male Votes: <span id="stats_male"></span>%</h4>
            <h4>Percent Female Votes: <span id="stats_female"></span>%</h4>
            <h4>Shops:</h4>
            <ul id="stats_shops"></ul>
            <h4>Grades:</h4>
            <ul id="stats_grades"></ul>
        </div>
        <button id="vote-again" class="transition">Done!</button>
    </section>
</main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="../js/main.js"></script>
<script id="result_script"></script>
<script>
    function get_winner(){
        var winner = [contestants[0]];
        for(candidate_index in contestants){
            if(contestants[candidate_index][4] > winner[0][4]){
                winner = [contestants[candidate_index]];
            }
            else if(contestants[candidate_index][4] == winner[0][4]){
                if(winner.indexOf(contestants[candidate_index]) == -1){
                    winner.push(contestants[candidate_index]);
                }
            }
        }
        return winner;
    }
    function get_candidate_statistics(id){
        var female_count = 0;
        var male_count = 0;
        var shops = [];
        var grades = [];
        for(vote_index in votes){

            var vote = votes[vote_index];
            var vote_candidate = vote[0];
            var vote_profile = vote[1];
            var vote_profile_gender = vote_profile[4];
            var vote_profile_grade = vote_profile[2];
            var vote_profile_shop = vote_profile[1];
            if(vote_candidate[0] == id){

                if(vote_profile_gender == "male") male_count++;
                if(vote_profile_gender == "female") female_count++;

                if(shops.length > 0){
                    var in_shops = false;
                    for(shop_index in shops){
                        if(shops[shop_index][0] == vote_profile_shop[1]){
                            shops[shop_index][1]++;
                            in_shops = true;
                        }
                    }
                    if(!in_shops){
                        shops.push([vote_profile_shop[1],1]);
                    }
                }
                else{
                    shops.push([vote_profile_shop[1],1]);
                }
                if(grades.length > 0){
                    var in_grades = false;
                    for(grade_index in grades){
                        if(grades[grade_index][0] == vote_profile_grade){
                            grades[grade_index][1]++;
                            in_grades = true;
                        }
                    }
                    if(!in_grades){
                        grades.push([vote_profile_grade,1]);
                    }
                }
                else{
                    grades.push([vote_profile_grade,1]);

                }

            }

        }
        return {"candidate":contestants[id][1],"male":male_count,"female":female_count,"shops":shops,"grades":grades};
    }
    function format_statistics(data_object){
        var candidate = data_object["candidate"];
        var male_votes = data_object["male"];
        var female_votes = data_object["female"];
        var total_votes = male_votes + female_votes;
        var percent_male = 100 * Math.round((male_votes / total_votes) * 100) / 100;
        var percent_female = 100 * Math.round((female_votes / total_votes) * 100) / 100;
        var shops = data_object["shops"];
        var grades = data_object["grades"];
        shops.sort(function(a,b){
            return b[1] - a[1];
        });
        grades.sort(function(a,b){
            return a[0] - b[0];
        });
        special = data_object;
        $("#stats_candidate").html(candidate);
        $("#stats_male").html(percent_male);
        $("#stats_female").html(percent_female);
        $("#stats_shops,#stats_grades").html("");
        for(shop_index in shops){
            shop = shops[shop_index];
            shop_percent = 100 * Math.round((shop[1] / total_votes) * 100) / 100;
            $("#stats_shops").append("<li>"+shop[0]+" - "+shop[1]+" votes</li>");
        }
        for(grade_index in grades){
            grade = grades[grade_index];
            grade_percent = 100 * Math.round((grade[1] / total_votes) * 100) / 100;
            if(grade[0] == 13){
                grade[0] = "Post Secondary";
            }
            else if(grade[0] == 14){
                grade[0] = "Faculty";
            }
            else{
                grade[0] = grade[0]+"th grade";
            }
            $("#stats_grades").append("<li>"+grade[0]+" - "+grade[1]+" votes</li>");
        }
        adjustPage();
        var stats = $("#statistics");
        if(!stats.data("open")){
            stats.fadeIn("fast");
            stats.data("open",true);
        }
        else{
            stats.css("display","block");
        }
    }
    function load_results(fade){
        $("#result_script").load("../php/results_arrays.php",function(){
            var winner = get_winner();
            var winner_string = "";
            if(winner.length > 1){
                winner_string = "There is currently a tie between ";
                for(index in winner){
                    winner_string += winner[index][1];
                    if(index < winner.length - 1 && index > winner.length - 3){
                        winner_string += " and ";
                    }
                    else if(index <= winner.length - 3){
                        winner_string += ", ";
                    }
                    else{
                        winner_string += ".";
                    }
                }
            }
            else if(winner != undefined){
                winner_string = "The front runner is currently " + winner[0][1];
            }
            else{
                winner_string = "No votes yet!";
            }
            $.post("../php/contestants_gen.php",{"candidates":contestants,"num_votes":num_votes},function(response){
                if(fade){
                    $("#contestants").html(response).fadeIn(450);
                }
                else{
                    $("#contestants").html(response);
                }
                $("#contestants").find("figure").click(function(){
                    var id = $(this).attr("id");
                    id = Number(id.replace("c",""));
                    var data_object = get_candidate_statistics(id);
                    format_statistics(data_object);
                });
                $.post("../php/additional_gen.php",{"additional":additional_questions},function(response){
                    if(fade){
                        $("#additional").html(response).fadeIn(450);
                    }
                    else{
                        $("#additional").html(response);
                    }
                });
            });
            if(fade){
                $("#winner").html(winner_string).fadeIn(450);
            }
            $("#winner").html(winner_string);
        });
        setTimeout(function(){
            load_results(false);
        },5000);
    }
    function dataDump(key, value){
        key = key ? key : false;
        value = value ? value : false;
        var array = [];
        if(key && value){
            for(x in votes){
                if(key == "shop"){
                    if(votes[x][1][1][1] == value) array.push(votes[x]);
                }
                if(key == "candidate"){
                    if(votes[x][0][1] == value) array.push(votes[x]);
                }
                if(key == "gender"){
                    if(votes[x][1][4] == value) array.push(votes[x]);
                }
                if(key == "age"){
                    if(votes[x][1][3] == value) array.push(votes[x]);
                }
            }
        }
        else{
            for(x in votes){
                array.push(votes[x]);
            }
        }
        array.sort(function(a,b){return a[0][0] - b[0][0]});
        $('body').html("");
        for(x in array){
            $('body').append(JSON.stringify(array[x])+"<br />");
        }
    }
    $(document).ready(function(){

        adjustPage();

        if(getUrl("voted")=="true"){
            $("#voted").fadeIn(450);
            setTimeout(function(){
                $("#vote-again").css({"opacity":"1","display":"block"});
            },650);
        }
        else{
            $("#no-vote").fadeIn(450);
        }

        load_results(true);

        $("#stats_close").click(function(){
            $("#statistics").fadeOut("fast",function(){
                $("#statistics").data("open",false);
            });
        });
        $("#vote-again").click(function(){
            setCookie("csrftoken","","-1000");
            window.location.href = "<?php echo $baseURL;?>";
        });

    });
    $(window).resize(function(){
        adjustPage();
    });
</script>
</html>