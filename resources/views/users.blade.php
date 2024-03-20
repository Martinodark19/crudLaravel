@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>

@section('content')

@if($objToGetusers->isEmpty())
    @php
        // Redirigir si no hay datos
        header("Location: /");
        exit();
    @endphp
@else
    {{-- Aquí va el código para mostrar los datos --}}
    <div class="container">
      <button type="button" class="btn btn-danger float-right" id="delete-button">eliminar</button>
    </div>

    <div class="container">
      <button class="btn btn-primary editar" id="edit-user">Editar usuarios</button>
    </div>

    <div class="container">
      <button class="btn btn-success guardar" style="display: none;">Guardar</button>
    </div>

    



    
      
        
  
   

  
  </div>
  <div class="table-responsive">
      <table class="table" id="table-users">
          <thead>
            <tr>
              <th></th>
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
              @foreach($objToGetusers as $user)
            <tr>
              <td><input type="checkbox" name="userSelect" value="{{ $user->rut }}"></td>
              <td>{{$user->nombre}}</td>
              <td>{{$user->apellido_paterno}}</td>
              <td>{{$user->apellido_materno}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->rut}}</td>
              <td>{{$user->profesion}}</td>
              <td>{{$user->direccion}}</td>
              <td>{{$user->region}}</td>
             

            </tr>
            @endforeach
  
           
          </tbody>
      </table>
  </div>
@endif



@endsection


<script>
    $(document).ready(function(){


        $('#table-users').DataTable({
                searching: true
            });

        $('#edit-user').click(function(){
           window.location.href = '/edit'
      })
        

          $('#delete-button').click(function(){
            
            var valuesToDelete = []

            $('input[name="userSelect"]:checked').each(function(){
              valuesToDelete.push($(this).val())
            })

            $.ajax({
                url: "/delete",
                method: "post",
                dataType: "json",
                data: {values:valuesToDelete},
                success: function(response){
                  if(response.success)
                  {
                    console.log("se borro correctamente")
                    alert(response.success)
                    location.reload()
                    
                  }
                  else
                  {
                    console.log("paso por el else y error wn")
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