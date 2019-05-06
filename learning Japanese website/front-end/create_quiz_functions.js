$(document).ready(function() {
    var total_points = 0;

    $("#calculate-points").click(function () {
        var i;
        total_points = 0;
        var question, answer;
        for (i = 0; i < 10; i++) {
            question = $('input[name="question-'  + i +'"]').val();
            answer = $('input[name="answer-'  + i +'"]:checked').val();
            if (question == answer) {
                total_points += 1;
            }
        }

        $('#result').text('Your points: ' + total_points*10 + '%');
        $('#result').show();
    });

    $("#save-btn").click(function () {
        $('#login-form').show();
        $('#save-btn').hide();
    });

    $("#hide-authentication").click(function () {
        $('#login-form').hide();
        $('#save-btn').show();
    });

    $("#hide-registration").click(function () {
        $('#new-user-form').hide();
    });

    $("#newUser").click(function () {
        $("#hide-authentication").trigger('click');
        $('#new-user-form').show();
    });

    ////// from here
    $("#new-user-to-database").click(function () {
        var username = $('input[name="newusername"]').val();
        var password = $('input[name="newpassword"]').val();

        var data = {"uname": username, "pass":password};
        data = JSON.stringify(data);

        $.post(
            "../web-service/new_user.php", 
            data, 
            function(data){
                alert("I am here");
                alert("Hello" + data);
            }
        );

    });

        /*

        $.ajax({
            type: 'POST',
            url: '../web-service/new_user.php',
            dataType:'json',
            data: data, 
            success: function(data){
                console.log(data);
            },
            error: function(data){
                console.log("Error");
            },
            complete: function() {
                console.log("complete");
            }
        });
        
        
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                $("#after-form").html(this.responseText);
                $("#after-form").show();
                alert("OK");
            }
        };

        xhttp.open("POST", "new_user.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("uname=" + username + "&pass=" + pass);
        */
    

    

    $("#login").click(function () {
        var username = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();

        /*
        $.ajax({
            type: 'POST',
            url: 'check_user.php',
            data: ({ uname: username, pass:password}), 
            success: function(data){
                console.log("success");
                $("#after-form").text(data);
                $("#after-form").show();
            },
            error: function(data){
                console.log("Error");
                $("#after-form").text("Cannot login. Please try again");
                $("#after-form").show();
            },
            complete: function() {
                console.log("complete");
            }
        });
        */

        $.post("web-service/check_user.php",
        {
            uname: username, 
            pass:password
        },
        function(data, status){
            alert("Data: " + data + "\nStatus: " + status);
        });

        });

    $("#home-btn").click(function () {
            window.location = "./index.html";
        });


});





