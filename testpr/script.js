$(document).ready (function () {

    $("#arg1, #arg2").keydown(function(event) {
        if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
            event.preventDefault(); 
        }   
    });


	$("#get_result").click(function() {

		var arg1 = $("#arg1");
		var arg2 = $("#arg2");

		var arr = ['Sum', 'Multi', 'Diff', 'Div']; 

		if (arg1.val() == ""||
			arg2.val() == "" ) 
		{
			$("#result").text("Please, enter numbers!");
			return false;
		}

        $.ajax({
            type: "POST",
            url: "getResults.php",
            data: "arg1=" + arg1.val() + "&arg2=" + arg2.val(),
            dataType: "json",           
            success: function(msg) {
            	$("#result").empty();

            	for (var x in msg) {
            		$("#result").append("<p>" + arr[x] + ": " + msg[x] + "</p>");
            	}

            	arg1.val("");
            	arg2.val("");	
            },
            error: function(msg) {
            	alert (msg);
            }
        });

	});

	$(".get_count").on("click", function () {
		var id = $(this).attr("id");

        $.ajax({
            type: "POST",
            url: "getCount.php",
            data: "typeCount=" + id,
            dataType: "text",           
            success: function(msg) {
            	$("#resultCount").empty();
            	$("#resultCount").text("Count: " + msg);	
            },
            error: function(msg) {
            	alert (msg);
            }
        });		
	});

});