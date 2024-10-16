<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Signup Page for y">
    <meta name="author" content="Colby Acton">
    <link rel="icon" href="favicon.ico">

    <title>Signup - Why use X when you can use Y!</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	
    <script src="includes/bootstrap.min.js"></script>
    
	<script>
		//load the DOM and other required items
		document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById('registration_form');
            form.addEventListener('submit', function (event) {
                event.preventDefault();

				//initalize errors array
                const validationErrors = [];

                // Get form values
                const firstname = document.getElementById('firstname').value;
                const lastname = document.getElementById('lastname').value;
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const confirm = document.getElementById('confirm').value;
                const username = document.getElementById('username').value;
                const address = document.getElementById('address').value;
                const province = document.getElementById('province').value;
                const phone = document.getElementById('phone').value;
                const postal = document.getElementById('postalCode').value;
                const desc = document.getElementById('desc').value;
                const url = document.getElementById('url').value;

				//phone regex
				const phonePattern = /^\d{3}-\d{3}-\d{4}$/;
				const phoneIsValid = phonePattern.test(phone)
				//postal regex
				const postalPattern = /^[ABCEGHJ-NPRSTVXY]\d[ABCEGHJ-NPRSTV-Z][ -]?\d[ABCEGHJ-NPRSTV-Z]\d$/i;
				const postalIsValid = postalPattern.test(postal)
				// email regex
				const emailPattern = /^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				const emailIsValid = emailPattern.test(email)

					//Validation checks
                    if (password.length > 250 || confirm.length > 250 || password !== confirm) {
                        validationErrors.push('Please make sure both passwords are the same and less than 250 characters\n');
                    }
                    if (firstname.length > 50 || firstname === "") {
                        validationErrors.push('Please enter a first name less than 50 characters in length\n');
                    }
                    if (lastname.length > 50 || lastname === "") {
                        validationErrors.push('Please enter a last name less than 50 characters in length\n');
                    }
                    if (!emailIsValid || email.length > 100 || email === "") {
                        validationErrors.push('Please enter a proper email less than 100 characters in length\n');
                    }
                    if (address.length > 200 || address === "") {
                        validationErrors.push('Please enter an address less than 200 characters in length\n');
                    }
                    if (province.length > 50 || province === "") {
                        validationErrors.push('Please enter a province less than 50 characters in length\n');
                    }
                    if (username.length > 50 || username === "") {
                        validationErrors.push('Please enter a username less than 50 characters in length\n');
                    }
                    if (desc.length > 50 || desc === "") {
                        validationErrors.push('Please enter a description less than 50 characters in length\n');
                    }
                    if (!phoneIsValid || phone === "") {
                        validationErrors.push('Please enter a phone number using format ###-###-####\n');
                    }
                    if (!postalIsValid || postal === "") {
                        validationErrors.push('Please enter a postal code using formats h2t-1b8, h2z 1b8, H2Z1B8\n');
                    }

                // Display errors or submit form
                if (validationErrors.length > 0) {
                    alert(validationErrors.join(''));
                } else {
                    form.submit();
                }
            });
        });
	</script>
  </head>

  <body>

  <?php include("Includes/headerBlank.php"); ?>

	<BR><BR>
    <div class="container">
		<div class="row">
			
			<div class="main-login main-center">
				<h5>Sign up once and troll as many people as you like!</h5>
					<form method="post" id="registration_form" action="signup_proc.php">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">First Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" name="firstname" id="firstname"  placeholder="Enter your First Name"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Last Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" name="lastname" id="lastname"  placeholder="Enter your Last Name"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Your Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Screen Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" name="username" id="username"  placeholder="Enter your Screen Name"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Confirm your Password"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Phone Number</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" name="phone" id="phone"  placeholder="Enter your Phone Number"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Address</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" name="address" id="address"  placeholder="Enter your Address"/>
								</div>
							</div>
						</div>
						
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Province</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<select name="province" id="province" class="textfield1"><?php echo $vprovince; ?> 
										<option> </option>
										<option value="British Columbia">British Columbia</option>
										<option value="Alberta">Alberta</option>
										<option value="Saskatchewan">Saskatchewan</option>
										<option value="Manitoba">Manitoba</option>
										<option value="Ontario">Ontario</option>
										<option value="Quebec">Quebec</option>
										<option value="New Brunswick">New Brunswick</option>
										<option value="Prince Edward Island">Prince Edward Island</option>
										<option value="Nova Scotia">Nova Scotia</option>
										<option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
										<option value="Northwest Territories">Northwest Territories</option>
										<option value="Nunavut">Nunavut</option>
										<option value="Yukon">Yukon</option>
									  </select>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Postal Code</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" name="postalCode" id="postalCode"  placeholder="Enter your Postal Code"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Url</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" name="url" id="url"  placeholder="Enter your URL"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Description</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" name="desc" id="desc"  placeholder="Description of your profile"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Location</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" name="location" id="location"  placeholder="Enter your Location"/>
								</div>
							</div>
						</div>
						
						
						<div class="form-group ">
							<input type="submit" name="button" id="button" value="Register" class="btn btn-primary btn-lg btn-block login-button"/>
							
						</div>
						
					</form>
				</div>
			
		</div> <!-- end row -->
    </div><!-- /.container -->
    
  </body>
</html>