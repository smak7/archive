
// when submit is pressed on our form, attempt to save data
 $("form").submit(function(e) {
 	e.preventDefault();
 	console.log("Save data on submit.");
 	saveMyData();
 });


// function to send data to php script and get response
function saveMyData(){
	
	var request;	// ajax request
	var dataToSend = "myName=" + $("#name").val();

	request = $.ajax({
        url: "saveName.php",
        type: "post",
        data: dataToSend
    });

	// called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        if(response == "success"){
        	console.log("Hooray, it worked! " + response);
        	$("#response").text("success!");
        	$("form").hide();
        }else{
        	$("#response").text("please try again");
        }
        
    });

     // called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
         console.error(
             "The following error occurred: "+
             textStatus, errorThrown
         );
         $("#response").text("failed");
         $("form").hide();

    });
}

