<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
	<form id="ajaxform">
    @csrf
		<div class="container">
     
			<center>
				<h1> Student Update Form</h1> 
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
            Full Name
            <input type="hidden" name="id" id="id" value="{{$student->id}}">
			<input type="text" id="name" name="name" placeholder="Firstname" value="{{$student->name}}" size="15" required />

			<label> Phone : </label>
			<input type="text" id="phone" name="phone"  placeholder="Country Code"  value="{{$student->phone}}" value="+91" size="2" />
		
			<label for="email"><b>Email</b></label>
			<input type="text" placeholder="Enter Email" id="email" name="phone"   value="{{$student->email}}" required>

			<button type="submit" class="registerbtn" id="updateajax">Update</button>
     
	</form>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    $(document).ready(function(){
    $('#ajaxform').submit(function(e){
        e.preventDefault();
        var id= $("#id").val()
        var originURL = $(location).attr("origin");

        $.ajaxSetup({
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        }
        });
    
        $.ajax({
        type: "POST",
        url: `${originURL}/student/update/${id}`,
            datatype:JSON,
            
            data: {
                name: $('#name').val(),
                phone: $('#phone').val(),
                email: $('#email').val(),
               
            },
            success: function(result){
                //  alert('profile update Successfully');
                 window.location.href=  `${originURL}/index`;
            }});
        });
    });
</script>

</html>