<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	body {
		font-family: Calibri, Helvetica, sans-serif;
		background-color: pink;
	}
	
	.container {
		padding: 50px;
		background-color: lightblue;
	}
	
	input[type=text],
	input[type=password],
	textarea {
		width: 100%;
		padding: 15px;
		margin: 5px 0 22px 0;
		display: inline-block;
		border: none;
		background: #f1f1f1;
	}
	
	input[type=text]:focus,
	input[type=password]:focus {
		background-color: orange;
		outline: none;
	}
	
	div {
		padding: 10px 0;
	}
	
	hr {
		border: 1px solid #f1f1f1;
		margin-bottom: 25px;
	}
	
	.registerbtn {
		background-color: #4CAF50;
		color: white;
		padding: 16px 20px;
		margin: 8px 0;
		border: none;
		cursor: pointer;
		width: 100%;
		opacity: 0.9;
	}
	
	.registerbtn:hover {
		opacity: 1;
	}
	</style>
</head>

<body>
	<form action="{{route('register.student')}}" method="POST">
    @csrf
		<div class="container">
     
			<center>
				<h1> Student Registeration Form</h1> 
        @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
            <div class="col-lg-12">
            @if (Session::has('msg'))
                  <div class="alert alert-success">
                      {{Session::get('msg')}}
                  </div>
              @endif
              @if (Session::has('error'))
                  <div class="alert alert-success">
                      {{Session::get('error')}}
                  </div>
              @endif
      </center>
			<hr>
			<label> Firstname </label>
			<input type="text" name="name" placeholder="Firstname" size="15" required />

			<label> Phone : </label>
			<input type="text" name="phone" placeholder="Country Code" value="+91" size="2" />
		
			<label for="email"><b>Email</b></label>
			<input type="text" placeholder="Enter Email" name="email" required>

			<label for="psw"><b>Password</b></label>
			<input type="password" placeholder="password" name="password" required>

			<label for="psw-repeat"><b>Re-type Password</b></label>
			<input type="password" placeholder="Retype Password" name="password_confirmation" required>

			<button type="submit" class="registerbtn">Register</button>
      alreday Register <a href="{{route('login')}}"> Login ? </a>
	</form>
</body>

</html>