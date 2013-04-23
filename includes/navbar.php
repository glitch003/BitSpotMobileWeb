		<div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="index.php">BitSpot</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li class="active"><a href="index.php">Home</a></li>
                             <!--li class=""><a href="contact.php">Contact Us</a></li-->
                        </ul>
                        <!--form class="navbar-form pull-right">
                            <input class="span2" type="text" placeholder="Email">
                            <input class="span2" type="password" placeholder="Password">
                            <button type="submit" class="btn">Sign in</button>
                            <a href="#signUpWindow" role="button" class="btn btn-success" data-toggle="modal">Sign up</a>
                        </form-->
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        
        
        
        <script type="text/javascript">
		$(document).ready(function(){
 
		 $('#signUpForm').validate(
		 {
		  rules: {
			emailSignUp: {
			  required: true,
			  email: true
			},
			passwordSignUp: {
			  minlength: 6,
			  required: true
			},
			confirmPasswordSignUp: {
			  equalTo: passwordSignUp,
			  required: true
			}
		  },
		  highlight: function(element) {
			$(element).closest('.control-group').removeClass('success').addClass('error');
		  },
		  success: function(element) {
			element
			.text('OK!').addClass('valid')
			.closest('.control-group').removeClass('error').addClass('success');
		  }
		 });
		}); // end document.ready
		
		
		//Fired when a key is pressed in a form.  
		//Checks if the key is 'enter/return' and if it is, it submits the form
		function checkSubmit(e)
		{
		   if(e && e.keyCode == 13)
		   {
			   $(e.target).closest("form").submit();
		   }
		}

</script>
        
        
        <div id="signUpWindow" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="signUpWindowLabel" aria-hidden="true">
          <div class="modal-header">
            <a type="button" class="close" data-dismiss="modal" aria-hidden="true">×</a>
            <h3 id="signUpWindowLabel">Sign up</h3>
          </div>
           <form class="form-horizontal" id="signUpForm" action="signup.php" method="POST">
              <div class="modal-body" onkeypress="javascript:checkSubmit(event);">
               
                  <fieldset>
                    <div class="control-group">
            
                      <!-- Text input-->
                      <label class="control-label" for="emailSignUp">Email</label>
                      <div class="controls">
                        <input type="text" placeholder="user@example.com" class="input-xlarge" name="emailSignUp" id="emailSignUp">
                        <p class="help-block">Your email address will be your username</p>
                      </div>
                    </div>
            
                    <div class="control-group">
            
                      <!-- Text input-->
                      <label class="control-label" for="passwordSignUp">Password</label>
                      <div class="controls">
                        <input type="password" placeholder="" class="input-xlarge" name="passwordSignUp" id="passwordSignUp">
                        <p class="help-block">Minimum of 6 characters</p>
                      </div>
                    </div>
            
                    <div class="control-group">
            
                      <!-- Text input-->
                      <label class="control-label" for="confirmPasswordSignUp">Confirm Password</label>
                      <div class="controls">
                        <input type="password" placeholder="" class="input-xlarge" name="confirmPasswordSignUp" id="confirmPasswordSignUp">
                        <p class="help-block"></p>
                      </div>
                    </div>
                 
                </fieldset>
          
              </div>
              <div class="modal-footer">
                <a class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </form>
        </div>
