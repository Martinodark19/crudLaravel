@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>




@section('content')
<form id="update-users-form">

    <div class="table-responsive">        
        <table class="table" id="table-users">
            <thead>
            <tr>
            
                <th scope="col">nombre</th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Apellido Materno</th>
                <th scope="col">rut</th>
                <th scope="col">email</th>
                <th scope="col">profesion</th>
                <th scope="col">direccion</th>
                <th scope="col">region</th>
            
            </tr>
            </thead>
            <tbody>
                @foreach($usersToEdit as $user)
            <tr>
                <td> <input type="text" value="{{$user->nombre}}" name="nombre"> </td>
                <td> <input type="text" value="{{$user->apellido_paterno}}" name="apellido_paterno"> </td>   
                <td><input type="text" value="{{$user->apellido_materno}}" name="apellido_materno"></td>   
                <td> <input type="text" value="{{$user->email}}" name="email"> </td>   
                <td> <input type="text" value="{{$user->rut}}" name="rut"> </td>   
                <td> <input type="text" value="{{$user->profesion}}" name="profesion"> </td>   
                <td> <input type="text" value="{{$user->direccion}}" name="direccion"> </td>   
                <td> <input type="text" value="{{$user->region}}" name="region"> </td>    
            

            </tr>
            @endforeach

            
            </tbody>
        </table>
        
    </div>

    <div class="container">
        <button type="submit" class="btn btn-success float-right" id="update-button">guardar cambios</button>
    </div>

</form> 


@endsection



<script>

    $(document).ready(function(){

        $('#update-button').click(function(event){
            event.preventDefault();

            var updateData = $('#update-users-form').serialize();

            console.log(updateData)

            $.ajax({
                url: "/edit/update",
                method: "post",
                data: updateData,
                success: function(response){
                    if(response.success)
                    {
                        alert(response.success)
                    }
                    else
                    {
                        alert(response.error)
                    }
                },
                error: function(xhr){
                  console.log("errownn")
                }
            })
        })
    })
</script>

