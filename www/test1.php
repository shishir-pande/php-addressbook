<html>

	<style type="text/css">
		body {
			padding: 50px;
		}
	</style>

	<head>
		<title>Address Book</title>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script type="text/javascript">

    	//send contact details from form to backend contact add on button click
  	  $(function() {
  	  	$("#addcontact").click(function(){
	        var firstname= $("#firstname").val();
	        var lastname= $("#lastname").val();
	        var email= $("#email").val();

	        $.ajax({
            type: "POST",
            url: "add-contact.php",
            data: {"firstname": firstname, "lastname": lastname, "email": email},
            dataType: "json",
	        });
  	  	});
			});

			//send email search term from form to backend search
			$(document).ready(function(){
			    $('.search-box input[type="text"]').on("keyup input", function(){
			        /* Get input value on change */
			        var inputVal = $(this).val();
			        var resultDropdown = $(this).siblings(".result");
			        if(inputVal.length){
			            $.get("backend-search.php", {term: inputVal}).done(function(data){
			                //display the returned data in browser
			                resultDropdown.html(data);
			            });
			        } else{
			        		//reset browser to show nothing when user clears search
			            resultDropdown.empty();
			        }
			    });
			    
			    //set search input value on click of result item
			    $(document).on("click", ".result p", function(){
			        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
			        $(this).parent(".result").empty();
			    });
			});

		</script>

	</head>

	<body>
		
		<div class="row">
			<div class="col-lg-12">
				<form name="form1">
					<div class="form-group">
						<label for="firstname">First Name</label><br>
						<input type="TEXT" class="form-control" id="firstname">
					</div>
					<div class="form-group">
						<label for="lastname">Last Name</label><br>
						<input type="TEXT" class="form-control" id="lastname">
					</div>
					<div class="form-group">
						<label for="email">Email</label><br>
						<input type="email" class="form-control" id="email">
					</div>
					<center><button type="button" class="btn btn-default" id="addcontact">Add to Address Book</button><br></center>
				</form>
			</div>
		</div>

		<br>

		<div class="row">
			<div class="col-md-12">
		    <div class="search-box form-group">
		        <input type="text" class="form-control" autocomplete="off" placeholder="Search by email..." />
		        <div class="result"></div>
		    </div>
		  </div>
	  </div>
	</body>
</html>