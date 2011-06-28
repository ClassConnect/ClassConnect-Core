// load the webpage and fade in  
 $(document).ready(function(){  
 $("#lightbox, #lightbox-panel").fadeIn(300);
$( "#progressbar" ).progressbar({
			value: 33
		});
 })  
 
 // function for submitting the signup form
 $(function(){
    $("#signup-form").submit(function(){
        dataString = $("#signup-form").serialize();

        $.ajax({
        type: "POST",
        url: "signup.cc?s=1",
        data: dataString,
        success: function(data) {
        		if (data == 1) {
        			verifySchool(dataString);
        		} else {
               $("#cont-right").html(data);
            }

        }

        });

        return false;            

    });
});


// display the settings page after signup success
function verifySchool(logData) {
$.ajax({
   type: "POST",
   url: "signup.cc?s=2",
   data: logData,
   success: function(msg){
   	$("#main-block").hide();
   	$("#panel-title").hide();
     $("#main-block").html(msg).fadeIn(200);
     $("#panel-title").html("<img src=\"core/site_img/main/l_arrow.png\" style=\"padding-left:10px; padding-right:10px\" />Find Or Add Your School").fadeIn(200);
$( "#progressbar" ).progressbar({
			value: 66
		});
   }
 });

    
}


function searchSchool() {
$('#query-right').html('<br /><br /><br /><center><img src="/app/core/site_img/loading.gif" /></center>');
        request = $.getJSON("openSearch.cc",{
            q:$("#schoolsearch").val(),
            node:1
        },function(data){
            showResults(data,$("#schoolsearch").val());
        });
return false;
};

function showResults(data, highlight){
   if (data == null) {
            resultHtml = '<br /><br /><br /><center><span style="color:#666">No schools found. Try another search term.</span></center>';
            } else {
           var resultHtml = '';
            $.each(data, function(i,item){
                resultHtml+='<div style="border-bottom: 1px solid #ccc; margin-bottom:4px">';
                resultHtml+='<div style="font-size:16px; font-weight:bolder; color:#333; padding-left:10px"><a href="#" onClick="schoolForm('+item.id+')">'+item.name.replace(highlight, '<span class="highlight">'+highlight+'</span>')+'</a></div>';
                resultHtml+='<div style="font-size:12px; color: #999; padding-left:10px">'+item.city.replace(highlight, '<span class="highlight">'+highlight+'</span>')+', '+item.state.replace(highlight, '<span class="highlight">'+highlight+'</span>')+' '+item.zip.replace(highlight, '<span class="highlight">'+highlight+'</span>')+' '+item.country+'</div>';
                resultHtml+='</div>';
            });
            }

            $('div#query-right').html(resultHtml);
        }





// function for submitting the school signup form
function submitSchool() {
        dataString = $("#school-signup").serialize();

        $.ajax({
        type: "POST",
        url: "signup.cc?s=3",
        data: dataString,
        success: function(data) {
        		if (data == 1) {
        			allowLogin(1);
        		} else {
               $("#failer").html(data);
            }

        }

        });
}





// function for submitting the school email signup form
function submitEmail() {
        dataString = $("#school-email-signup").serialize();

        $.ajax({
        type: "POST",
        url: "signup.cc?s=3",
        data: dataString,
        success: function(rsp) {
        		if (rsp == 1) {
        			allowLogin(1);
        		} else {
               $("#failer").html(rsp);
            }

        }

        });
}





// function for submitting the school email signup form
function showchangeEmail() {


        $.ajax({
        type: "POST",
        url: "signup.cc?s=6",
        success: function(data) {
        	$("#main-block").hide();
   		$("#panel-title").hide();
     		$("#main-block").html(data).fadeIn(200);
     		$("#panel-title").html("<img src=\"core/site_img/main/l_arrow.png\" style=\"padding-left:10px; padding-right:10px\" />Change Email").fadeIn(200);

        }

        });
}




// function for submitting the school email signup form
function changeEmail() {
        dataString = $("#school-email-signup").serialize();

        $.ajax({
        type: "POST",
        url: "signup.cc?s=6",
        data: dataString,
        success: function(data) {
        		if (data == 1) {
        			allowLogin(3);
        		} else {
        			$("#failer").hide();
               $("#failer").html(data).fadeIn(200);
            }

        }

        });
}




// function for requesting email link
function requestEmail() {

        $.ajax({
        type: "POST",
        url: "signup.cc?s=5",
        success: function(conf) {
        			$("#msgbox").hide();
               $("#msgbox").html(conf).fadeIn(200);
        }

        });
}



// display the settings page after signup success
function allowLogin(idType) {
$( "#progressbar" ).progressbar({
value: 90
});
if (idType == 1) {
	var crumb = 'Signup Complete!';
 } else {
 	var crumb = 'Verify Your Account';
 }
$.ajax({
   type: "POST",
   url: "signup.php?s=4&t="+idType,
   success: function(msg){
   	$("#main-block").hide();
   	$("#panel-title").hide();
     $("#main-block").html(msg).fadeIn(200);
     $("#panel-title").html("<img src=\"core/site_img/main/l_arrow.png\" style=\"padding-left:10px; padding-right:10px\" />"+crumb).fadeIn(200);
   }
 });

    
}



// show the school signup form page
function schoolForm(id) {

	if(id == null) {
		var crumb = 'Create New School';
	} else {
		var crumb = 'Verify School Email Address';
	}
$.ajax({
   type: "GET",
   url: "signup.php?s=3&id="+id,
   success: function(msg){
   	$("#main-block").hide();
   	$("#panel-title").hide();
     $("#main-block").html(msg).fadeIn(200);
     $("#panel-title").html("<img src=\"core/site_img/main/l_arrow.png\" style=\"padding-left:10px; padding-right:10px\" />"+crumb).fadeIn(200);
   }
 });

    
}