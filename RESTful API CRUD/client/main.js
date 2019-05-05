$(document).ready(function() {    
    $('#create-btn').click(function() {
        var input_name = $('input[name=create-name]').val();
        var input_url = $('input[name=create-url]').val();
        var input_desc =  $('input[name=create-desc]').val();

        if (!input_name || !input_url || !input_desc) {
            $('#create-message').text("Please make sure that you filled all data");
        }
        else {
            data = {"name" : input_name, "url" : input_url, "desc" : input_desc};
            data = JSON.stringify(data);

            $.post(
                "../service/create.php", 
                data, 
                function(data){
                    data = JSON.parse(data);
                    $('#create-message').text(data.message);
                }
            );
        }
        
    });

    $('#show-retrieve-date-btn').click(function() {
        $('#retrieve-id').hide();
        $('#retrieve-date').show();
    });

    $('#show-retrieve-id-btn').click(function() {
        $('#retrieve-id').show();
        $('#retrieve-date').hide();
    });

    ///////////////////// POST here
    $("#retrieve-date-btn").click(function() {
        var input_date = $('input[name=retrieve-date]').val();

        if (!input_date) {
            $('#retrieve-message').text("Please enter a date in format yyyy-mm-dd");
        }

        else {
            data = {"date" : input_date};
            data = JSON.stringify(data);

            $.post(
                "../service/retrieve.php", 
                data, 
                function(data){
                    console.log("SUCCEED");
                    console.log(data);
                    
                    data = JSON.parse(data);

                    var htmlMessage = "<table id='retrieve-table'>"

                    htmlMessage += "<tr>";
                    htmlMessage += "<th>ID</th>";
                    htmlMessage += "<th>Date</th>";
                    htmlMessage += "<th>Name</th>";
                    htmlMessage += "<th>URL</th>";
                    htmlMessage += "<th>Description</th>";
                    htmlMessage += "</tr>";


                    data.forEach(item => {
                        htmlMessage += "<tr>";
                        htmlMessage += "<td>" + item.ID + "</td>";
                        htmlMessage += "<td>" + item.Date + "</td>";
                        htmlMessage += "<td>" + item.Name + "</td>";
                        htmlMessage += "<td>" + item.URL + "</td>";
                        htmlMessage += "<td>" + item.Desc + "</td>";
                        htmlMessage += "</tr>";
                    });

                    htmlMessage += "</table>";

                    $('#retrieve-message').html(htmlMessage);
                }
            );
        }

    });

    $("#retrieve-id-btn").click(function() {
        var input_id = $('input[name=retrieve-id]').val();

        if (!input_id) {
            $('#retrieve-message').text("Please enter an ID");
        }

        else {
            data = {"id" : input_id};
            data = JSON.stringify(data);

            $.post(
                "../service/retrieve.php", 
                data, 
                function(data,status){
                    data = JSON.parse(data);

                    var htmlMessage = "<table id='retrieve-table'>"
                    htmlMessage += "<tr>";
                    htmlMessage += "<th>ID</th>";
                    htmlMessage += "<th>Date</th>";
                    htmlMessage += "<th>Name</th>";
                    htmlMessage += "<th>URL</th>";
                    htmlMessage += "<th>Description</th>";
                    htmlMessage += "</tr>";


                    data.forEach(item => {
                        htmlMessage += "<tr>";
                        htmlMessage += "<td>" + item.ID + "</td>";
                        htmlMessage += "<td>" + item.Date + "</td>";
                        htmlMessage += "<td>" + item.Name + "</td>";
                        htmlMessage += "<td>" + item.URL + "</td>";
                        htmlMessage += "<td>" + item.Desc + "</td>";
                        htmlMessage += "</tr>";
                    });

                    htmlMessage += "</table>";

                    $('#retrieve-message').html(htmlMessage);
                }
            );
        }

    });
    //////////////////

    $('#show-update-name-btn').click(function() {
        $('#update-name').show();
        $('#update-url').hide();
        $('#update-desc').hide();
    });

    $('#show-update-url-btn').click(function() {
        $('#update-name').hide();
        $('#update-url').show();
        $('#update-desc').hide();
    });

    $('#show-update-desc-btn').click(function() {
        $('#update-name').hide();
        $('#update-url').hide();
        $('#update-desc').show();
    });

    ///////////////////////////////////////
    $('#update-name-btn').click(function() {
        var input_id = $('input[name=update-id]').val();
        var input_name = $('input[name=update-name]').val();
       
        if (!input_name || !input_id) {
            $('#update-message').text("Please make sure that you filled ID and name");
        }
        else {
            data = {"id" : input_id, "name" : input_name};
            data = JSON.stringify(data);

            $.post(
                "../service/update.php", 
                data, 
                function(data){
                    data = JSON.parse(data);
                    $('#update-message').text(data.message);
                }
            );
        }
        
    });

    $('#update-url-btn').click(function() {
        var input_id = $('input[name=update-id]').val();
        var input_url = $('input[name=update-url]').val();

        if (!input_url || !input_id) {
            $('#update-message').text("Please make sure that you filled ID and URL");
        }
        else {
            data = {"id" : input_id, "url" : input_url};
            data = JSON.stringify(data);

            $.post(
                "../service/update.php", 
                data, 
                function(data){
                    data = JSON.parse(data);
                    $('#update-message').text(data.message);
                }
            );
        }

    });

    $('#update-desc-btn').click(function() {
        var input_id = $('input[name=update-id]').val();
        var input_desc =  $('input[name=update-desc]').val();

        if (!input_desc || !input_id) {
            $('#update-message').text("Please make sure that you filled ID and description");
        }
        else {
            data = {"id" : input_id, "desc" : input_desc};
            data = JSON.stringify(data);

            $.post(
                "../service/update.php", 
                data, 
                function(data){
                    data = JSON.parse(data);
                    $('#update-message').text(data.message);
                }
            );
        }

    });
    //////////////////////

    $('#delete-btn').click(function() {
        var input_id = $('input[name=delete-id]').val();

        if (!input_id) {
            $('#delete-message').text("Please make sure that you filled ID");
        }
        else {
            data = {"id" : input_id};
            data = JSON.stringify(data);

            $.post(
                "../service/delete.php", 
                data, 
                function(data){
                    data = JSON.parse(data);
                    $('#delete-message').text(data.message);
                }
            );
        }
    });

});




