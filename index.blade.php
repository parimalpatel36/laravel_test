<html>
    <head>
        <title></title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>    
    <body>
      
        @if(Auth::user()->role == 1)
        <h2> <Center>School Login! </br> <a href="{{route('student.logout')}}" class="btn btn-primary">Logout</a> <br></center> </h2>  
          @else
          <h2> <Center>Student Profile! </br> <a href="{{route('student.logout')}}" class="btn btn-primary">Logout</a> <br></center> </h2>  
        @endif
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Full Name</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Email</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
                {{-- @if(is_null($student))
                    <div class="alert alert-warning">
                        <strong>Sorry!</strong> No Student Found.
                    </div>                                      
                @else --}}
                @foreach($student as $user)
              <tr> 
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->email}}</td>
                    <td> <a href="{{route('edit', $user->id)}}"><i class="material-icons">edit</i></a> </td>
                    <td>
                    <a href="{{ route('student.destroy',$user->id) }}" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" id="deletestudent" data-id="{{ $user->id }}">
                        Delete
                    </a>
                    </td>
              </tr>
              @endforeach
              {{-- @endif --}}
            </tbody>
          </table>
    </body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>            
    $(document).ready(function () {   
    $("body").on("click","#deletestudent",function(e){    
       if(!confirm("are you sure you delete this record ?")) {
          return false;
        }   
       e.preventDefault();
       var id = $(this).data("id");
      // var id = $(this).attr('data-id');
       var token = $('meta[name="csrf-token"]').attr('content')
       var url = e.target;
       $.ajax(
           {
             url: url.href, //or you can use url: "company/"+id,
             type: 'DELETE',
             
             data: {
               _token: token,
                   id: id
           },        
           success: function (response){
            window.location.reload();
           }
        });
         return false;
      });
    });
    </script>
</html>
