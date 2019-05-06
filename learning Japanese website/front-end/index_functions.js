$(document).ready(function(){

    $(".char").hover(function(){
        var image = $(this).find('.char-img')[0];

        var old_source = $(image).attr('src');
        if (old_source != "images/static_images/white.jpg" && old_source != "images/static_images/wi.png" 
            && old_source != "images/static_images/we.png") {
            var new_source = old_source.replace("static_images", "strokes");
            new_source = new_source.replace("png", "gif");
            $(image).attr("src", new_source);
        }
    },
    function(){
        var image = $(this).find('.char-img')[0];

        var old_source = $(image).attr('src');
        if (old_source != "images/static_images/white.jpg" && old_source != "images/static_images/wi.png" 
            && old_source != "images/static_images/we.png") {
            var new_source = old_source.replace("strokes", "static_images");
            new_source = new_source.replace("gif", "png");
            $(this).attr("src", new_source);
        }
    }
    );

    $(".char").click(function(){
        var image = $(this).find('.char-img')[0];
        
        var sound = $("#audio")[0];
        var old_source = $(image).attr('src');

        if (old_source != "images/static_images/white.jpg" && old_source != "images/static_images/wi.png" 
            && old_source != "images/static_images/we.png"){
            
            var new_source = old_source.replace("strokes", "sounds");
            new_source = new_source.replace("gif", "mp3");

            $(sound).attr('src', new_source);
            sound.play();

        }
        
    });


    change_mode = function() {
        $('#change-mode-btn').hide();
        $('#done-selecting-btn').show();
        $("#quiz-message").text("Please select at least 10 characters to make the quiz");
        $("#quiz-message").show();
        select_character();
    }

    var training_set = new Array();

    select_character = function() {  
        $(".char").click(function() {
            training_set.push($(this).attr("id"));
            $(this).css('background', 'green');
        });
    }

    create_quiz = function() {
        if (training_set.length < 10) {
            $("#quiz-message").append("<div style='color: red;'>Please select more than 10 characters</div>");
        } else {
            $('#done-selecting-btn').hide();
            var form = '<form action="create_quiz.php" method="post">';
            form += '<input type="hidden" name="num_chars" value="' + training_set.length + '" >';
            for (i in training_set) {
                form += '<input type="hidden" name="char' + i + '" value="' + training_set[i] + '" >';
            }
            form += '<input type="submit" class="btn" value="Start!!!">';
            form += '</form>';
            $('#submit-form').append(form);
        }

    }   

});

