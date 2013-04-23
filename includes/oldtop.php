
 <script type="text/javascript">
 	<?php if(isset($_SESSION['uid']) && $_SESSION['uid'] != ""){ ?>
		var loggedIn = true;
	<?php }else{ ?>
		var loggedIn = false;
	<?php } ?>
 	<!-- UserID: <?php echo $_SESSION['uid']; ?> -->
    $(document).ready(function(){
		
		if(loggedIn){
			$("#logoutButton").show();
			$("#signupButton").hide();
			$("#loginButton").hide();
			$("#username").hide();
			$("#password").hide();
		}else{
		}
		
		//keybinding for the enter button
		$("#password").keypress(function(evt){
			if(evt.which == 13){
				tryToLogin();
			}
				
		});
		
    	$("#loginButton").click(function(){
			
			
        	tryToLogin();
        });
		
		$("#submitSignUp").click(function(){
			
			
        	trySignUp();
        });
		
		
		$("#signupButton").click(function(){	
			
        	$("#signupform").modal({backdrop:false});
        });
		
		$("#signUpToday").click(function(){	
			
        	$("#signupform").modal({backdrop:false});
        });
	
		
		$("#logoutButton").click(function(){
			
			$("#logoutButton").html("Loading...");
	   		$("#logoutButton").attr("disabled", "disabled");
			$.ajax({
				url: 'ajax/logout.php',
				success: function(){
					$("#logoutButton").html("Log out");
	   				$("#logoutButton").removeAttr("disabled");
					$("#logoutButton").hide();
					$("#loginButton").fadeIn();
					$("#signupButton").fadeIn();
					$("#username").fadeIn();
					$("#password").fadeIn();
				},
				failure: function(data){
					console.log(data);
					alert("error");
					$("#logoutButton").html("Log out");
	   				$("#logoutButton").removeAttr("disabled");
				}
			});
		});
    
		
		$(".signUpRequired").each(function(index, element){
			$(element).popover({
					trigger: "manual",
					title: "Error",
					content: "This field is required."	
			});
			$(element).blur(function(e){
				if($(element).val() != ""){
					$(element).popover('hide');	
				}
			});
		});
		$(".required").each(function(index, element){
                        $(element).popover({
                                        trigger: "manual",
                                        title: "Error",
                                        content: "This field is required."      
                        });     
                        $(element).blur(function(e){
                                if($(element).val() != ""){ 
                                        $(element).popover('hide');     
                                }       
                        });     
                });     	
    
    });
    
	function doLoginSuccess(){
		$(".navbar-inner").css("background-image","-webkit-linear-gradient(top, #00BB00, #006600)");
		$(".navbar-inner").css("background-color", "#00FF00");
		$("#logoutButton").fadeIn();
		$("#loginButton").hide();
		$("#signupButton").hide();
		$("#username").hide();
		$("#password").hide();
	}
   function tryToLogin(){
	   $("#loginButton").html("Loading...");
	   $("#loginButton").attr("disabled", "disabled");
	   $("#username").attr("disabled", "disabled");
	   $("#password").attr("disabled", "disabled");
	   
	   $.ajax({
            	url: "ajax/login.php",
				type: 'POST',
                data: "username="+$("#username").val()+"&password="+$("#password").val(),
                success: function(resp){
					$("#loginButton").html("Sign in");
					$("#loginButton").removeAttr("disabled");
					$("#username").removeAttr("disabled");
					$("#password").removeAttr("disabled");
                	if(resp == "success"){
						doLoginSuccess();
                    }else{
                    	
						$(".navbar-inner").css("background-image","-webkit-linear-gradient(top, #BB0000, #660000)");
						$(".navbar-inner").css("background-color", "#FF0000");
                    }
                    
               	},
                failure: function(data){
					$("#loginButton").html("Sign in");
					$("#loginButton").removeAttr("disabled");
					$("#username").removeAttr("disabled");
					$("#password").removeAttr("disabled"); 
                	console.log(data); 
                    alert("error");
                }
		});
			 
   }
   
   function trySignUp(){
	   var validationError = false;
	   $(".signUpRequired").each(function(index, element) {
        	if($(element).val() == ""){
				
				$(element).popover('show');
				validationError = true;
			}
				
    	});
		
		if(validationError){
			
			return;	
		}
	   
	   $("#submitSignUp").html("Loading...");
	   $("#submitSignUp").attr("disabled", "disabled");
	   $("#inputFname").attr("disabled", "disabled");
	   $("#inputLname").attr("disabled", "disabled");
	   $("#inputUname").attr("disabled", "disabled");
	   $("#inputPassword").attr("disabled", "disabled");
	   
	   $.ajax({
            	url: "ajax/signup.php",
				type: 'POST',
                data: "firstName="+$("#inputFname").val()+"&lastName="+$("#inputLname").val()+"&username="+$("#inputUname").val()+"&password="+$("#inputPassword").val(),
                success: function(resp){
					$("#submitSignUp").html("Sign Up");
					$("#submitSignUp").removeAttr("disabled");
					$("#inputFname").removeAttr("disabled");
					$("#inputLname").removeAttr("disabled");
					$("#inputUname").removeAttr("disabled");
					$("#inputPassword").removeAttr("disabled");
                	if(resp == "success"){
						$("#signupform").modal('hide');
						doLoginSuccess(); 
                    }else if (resp == "taken"){
						alert("This username has already been taken. Please try again.");
					}else{
                    	alert("error");
						$(".navbar-inner").css("background-image","-webkit-linear-gradient(top, #BB0000, #660000)");
						$(".navbar-inner").css("background-color", "#FF0000");
                    }
                    
               	},
                failure: function(data){
					$("#submitSignUp").html("Sign Up");
					$("#submitSignUp").removeAttr("disabled");
					$("#inputFname").removeAttr("disabled");
					$("#inputLname").removeAttr("disabled");
					$("#inputUname").removeAttr("disabled");
					$("#inputPassword").removeAttr("disabled");
                	console.log(data); 
                    alert("error");
                }
		});
			 
   }
   
   </script>
   
   
  <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="http://heidyk.com/db/">Cards for Bits</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="http://heidyk.com/db">Home</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Options <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="browsepoems.php">Browse Poems</a></li>
                  <li><a href="browsecentos.php">Browse CentoPoems</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">My Account</li>
                  <li><a id="genCento" href="centogenerate.php">Generate Centopoem</a></li>
                  <li><a id="profile" href="myprofile.php">My Profile</a></li>
                </ul>
              </li>
            </ul>
            <form class="navbar-form pull-right">
              <input class="span2" type="text" placeholder="Username" id="username">
              <input class="span2" type="password" placeholder="Password" id="password">
              <button type="button" class="btn inbtn btn-success" id="loginButton">Sign in</button>
			  <button type="button" class="btn inbtn btn-primary" id="signupButton">Sign up</button>
			  <button type="button" class="btn outbtn btn-danger" id="logoutButton" style="display: none;">Sign out</button>
			  
			  <div id="signupform" class="modal hide fade in" style="display: none; ">  
				<div class="modal-header">  
				<a class="close" data-dismiss="modal">x</a>  
				<h3>Sign Up!</h3>  
				</div>  
				<div class="modal-body">  
						<form class="form-horizontal">
							<div class="control-group">
							<label class="control-label" for="inputFname">First Name</label>
							<div class="controls">
							<input type="text" id="inputFname" placeholder="First Name" class="signUpRequired">
							</div>
							</div>							
							<div class="control-group">
							<label class="control-label" for="inputLname">Last Name</label>
							<div class="controls">
							<input type="text" id="inputLname" placeholder="Last Name" class="signUpRequired">
							</div>
							</div>
							<div class="control-group">
							<label class="control-label" for="inputUname">Username</label>
							<div class="controls">
							<input type="text" id="inputUname" placeholder="Username" class="signUpRequired">
							</div>
							</div>
							<div class="control-group">
							<label class="control-label" for="inputPassword">Password</label>
							<div class="controls">
							<input type="password" id="inputPassword" placeholder="Password" class="signUpRequired">
							</div>
							</div>							
						 </form>                
				</div>  
				<div class="modal-footer">  
				<a href="#" class="btn btn-success" id="submitSignUp">Sign Up</a>  
				<a href="#" class="btn" data-dismiss="modal">Close</a>  
				</div>  
			 </div> 


			  
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
