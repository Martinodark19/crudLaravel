@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

@section('content')


<div id="div-to-show" >
<button id="show-users-button" class="btn btn-primary">ver usuarios</button>
</div>

<div class="container">

    <form id="formulario">
        
        <div class="col-md-6">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control col-11" id="nombre" name="nombre" placeholder="Ingrese su nombre">
        </div>
    
        <div class="col-md-6">
            <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
            <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Ingrese su apellido paterno">
        </div>
    
        <div class="col-md-6">
            <label for="apellido_materno" class="form-label">Apellido Materno</label>
            <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Ingrese su apellido materno">
        </div>
    
        <div class="col-md-6">
            <label for="rut" class="form-label">RUT Único</label>
            <input type="text" class="form-control" id="rut" name="rut" placeholder="21434365-K" maxlength="12">
            <div id="rutDiv"  class="form-text"></div>
        </div>
    
        <div class="col-md-6">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su correo electrónico">
            <div id="emailDiv" class="form-text"></div>
        </div>
    
        <div class="col-md-6">
            <label for="profesion" class="form-label">Profesión</label>
            <input type="text" class="form-control" id="profesion" name="profesion" placeholder="Ingrese su profesión">
        </div>
    
        <div class="col-md-6">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese su dirección">
        </div>
    
       
        <div class="col-md-6">
            <label for="inputState" class="form-label">Region</label>
            <select id="inputState" class="form-select" name="region">
                <option selected>elegir...</option>
                <option>Arica-Parinacota</option>
                <option>Coquimbo</option>
                <option>Maule</option>
                <option>Los Ríos</option>
                <option>Tarapacá</option>
                <option>Valparaíso</option>
                <option>Ñuble</option>
                <option>Los Lagos</option>
                <option>Antofagasta</option>
                <option>Metropolitana</option>
                <option>Bío Bío</option>
                <option>Aysén</option>
                <option>Atacama</option>
                <option>O'Higgins</option>
                <option>Araucanía</option>
                <option>Magallanes y Antártica Chilena</option>

            </select>
        </div>
    
        <br>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    



</div>

@endsection


<script>
   
    $(document).ready(function(){

        $('#show-users-button').click(function(){
            window.location.href = '/users'
        })

        // ajax para mostrar el boton dependiendo si existen usuarios 
        $.ajax({
            url: "/showUser",
            type: 'GET',
            success: function(response)
                {               
                    if(response.success)
                    {
                        console.log("esta funcionando bien")
                        $('#div-to-show').show()
                    }
                    else
                    {
                        console.log("no funciono")
                        $('#div-to-show').hide()
                    }
                            
                },
            error: function(xhr,status,error)
                {

                    console.log("error en la solicitud ajax",error)
                }
        })
    
        // logica para enviar datos del formulario al controlador 
        $('#formulario').submit(function(event){
            event.preventDefault();
            var getDataForm = $(this).serialize()
        

            $.ajax({
                url: "/form",
                method:"POST",
                data: getDataForm,
                success: function(response){
                
                     if(response.rutInvalido)
                    {
                       $('#rutDiv').text(response.rutInvalido.original.error)
                       $('#rutDiv').css('color',"red")
                    }
                    else if(response.emailInvalido)
                    {
                        $('#emailDiv').text(response.emailInvalido.original.mensaje)
                        $('#emailDiv').css('color',"red")
                    }
                    else
                    {
                        $('#rutDiv').text('')
                        $('#emailDiv').text('')
                        alert("datos enviados correctamente")
                    }
                    
                    
                },
                error: function(xhr,status,error){

                   console.log("error en la solicitud ajax",error)
                }
            })
            
        })
 
    });
</script>



