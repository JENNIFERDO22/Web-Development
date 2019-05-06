<!DOCTYPE html>
<html>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <title>Hiragana Quiz</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="create_quiz_functions.js"></script>
</head>

<body>
    <div id='before-submit'>
    <h1 id='hiragana-quiz'>Hiragana Quiz</h1>

    <form>

    <?php
    session_start();
    
    if (isset($_POST["num_chars"]) && !empty($_POST["num_chars"])) {
        $_SESSION["num_chars"] = intval(test_input($_POST["num_chars"]));
        for ($i = 0; $i < $_SESSION["num_chars"]; $i++) {
            $_SESSION["char" . $i] = test_input($_POST["char" . $i]);
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $num_char = $_SESSION["num_chars"];
    $training_set = [];
    
    for ($i = 0; $i < $num_char; $i++) {
        $training_set[] = $_SESSION["char" . $i];
    }

    $types = array("kana", "romaji");

    shuffle($training_set);
    

    for ($x = 0; $x < 10; $x++) {
        $question_type = array_rand($types, 1);
        $other_answers = array_merge(array_slice($training_set, 0, $x), array_slice($training_set, $x+1));

        $wrong_answers = array_rand($other_answers, 3);
        $correct_answer = $training_set[$x];

        $all_answers = [];

        foreach ($wrong_answers as $key => $value) {
            $all_answers[] = $other_answers[$value];
        }

        $all_answers[] =  $correct_answer;

        shuffle($all_answers);
        if ($question_type == 'kana') {
    ?>  

            <div class='question'>
                <p class='question-title'><?php echo 'Question ' . ($x+1) . ': '; ?> 
                    <img class='kana-image' src=<?php echo 'images/static_images/' . $correct_answer . '.png'; ?> alt="Your browser does not support this type">
                </p>
                    <input type="hidden" name=<?php echo 'question-' . $x; ?> value=<?php echo $correct_answer; ?> >

                    <?php
                    foreach ($all_answers as $char) {
                    ?>
                    <input class='answer' type="radio" name=<?php echo 'answer-' . $x; ?> value=<?php echo $char; ?>> 
                        <?php echo $char; ?> <br>
                    <?php
                    }
                    ?>
            </div>    
        
    <?php
        } else {
    ?>

            <div class='question'>
                <p class='question-title'><?php echo 'Question ' . ($x+1) . ': Kana form of ' . $correct_answer; ?> </p>
                    <input type="hidden" name=<?php echo 'question-' . $x; ?> value=<?php echo $correct_answer; ?> >
                    
                    <?php
                    foreach ($all_answers as $char) {
                    ?>

                    <input class='answer' type="radio" name=<?php echo 'answer-' . $x; ?> value=<?php echo $char; ?>>
                    <img class='kana-image' src=<?php echo 'images/static_images/' . $char . '.png'; ?> alt="Your browser does not support this type">
                    <br>
                    
                    <?php
                    }
                    ?>
            </div> 

    <?php
        }
    }

    ?>
    
    </form>

    <p id='result'></p>
    <button class='btn' id='calculate-points'>Submit</button><br>

    <div id='login-form'>
        <h2>Please login to save</h2>
        <form class='form-content'>
            <div class='form-input'>
                <label><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required><br>
            </div>

            <div class='form-input'>
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required><br>
            </div>

            <button type="submit" class='btn' id='login'>Login</button>
            <button type="button" class='btn' id='newUser'>New User</button>
            <button type="button" class='btn' class='cancel-btn' id="hide-authentication">Cancel</button>
        </form>
    </div>

    <div id='new-user-form'>
        <h2>Please Type New Username and Password</h2>
        <form class='form-content'>
            <p id='new-user-message'></p>
            <div class='form-input'>
                <label><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="newusername" required><br>
            </div>

            <div class='form-input'>
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="newpassword" required><br>
            </div>

                                                                                      
            <button type="submit" class='btn' id='new-user-to-database'>Register</button>
            <button type="button" class='btn' class='cancel-btn' id="hide-registration">Cancel</button>
        </form>
    </div>

    <button id='save-btn' class='btn'>Save</button><br>

    <button id='home-btn' class='btn'>Home</button>
    </div>

    <p id='after-submit'></p>

    <div id="credit">
        <p>Credit:</p>
        <p>All photos and strokes are from https://commons.wikimedia.org/wiki/Hiragana</p>
        <p>All audios are from http://www.guidetojapanese.org/learn/complete/hiragana</p>
    </div>

</body>

