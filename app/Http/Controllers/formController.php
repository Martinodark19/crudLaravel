<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\formModel;
use Illuminate\Support\Facades\DB;


class formController extends Controller
{
    protected $dataSuccess = [];
    protected $dataError = [];
    protected $dataForm = [];
   
    public function getDataForm(Request $request)
    {
        $response = $request->all();
        
        if(!empty($response))
        {
            // obtenemos cada propiedad del array para posterior insertarlo a la base de datos 
            $this->dataForm['nombre'] = $response['nombre'];
            $this->dataForm['apellido_paterno'] = $response['apellido_paterno'];
            $this->dataForm['apellido_materno']= $response['apellido_materno'];
            $this->dataForm['rut']= $response['rut'];
            $this->dataForm['email'] = $response['email'];
            $this->dataForm['profesion'] = $response['profesion'];
            $this->dataForm['direccion'] = $response['direccion'];
            $this->dataForm['region'] = $response['region'];

            $rut = str_replace(['.', '-'], '', $this->dataForm['rut']);

            // funcion para validar rut
            function validarRut($rut) 
            {
                $numero = substr($rut, 0, -1);
                $digitoVerificador = strtoupper(substr($rut, -1));

                // Algoritmo Módulo 11
                $suma = 0;
                $multiplicador = 2;

                for ($i = strlen($numero) - 1; $i >= 0; $i--) {
                    $suma += $numero[$i] * $multiplicador;
                    $multiplicador = ($multiplicador >= 7) ? 2 : $multiplicador + 1;
                }

                $resto = $suma % 11;

                $digitoCalculado = 11 - $resto;
                if ($digitoCalculado == 10) {
                    $digitoCalculado = 'K';
                } elseif ($digitoCalculado == 11) {
                    $digitoCalculado = 0;
                }

                return ($digitoCalculado == $digitoVerificador);
            }

            $validacion = validarRut($rut);


            if ($validacion) 
            {
               $this->dataSuccess['rutValido'] = response()->json(['mensaje' => 'El RUT es válido.']);
                
            } else 
            {
               $this->dataError['rutInvalido'] = response()->json(['error' => 'El RUT es inválido.']);
            }
                
               // validacion de email
            
            $apiKeyEmail = env('APIKEY_EMAIL');
            $url = Http::get("https://api.debounce.io/v1/?api=$apiKeyEmail&email=".$this->dataForm['email']);

           
            if($url->status() == 200)
            {
                    
                if($url->json()['debounce']['result'] == "Safe to Send")
                {
                    $this->dataSuccess['emailValido'] = response()->json(['mensaje'=>'email valido']);
                }
                else
                {
                    $this->dataError['emailInvalido'] = response()->json(['mensaje'=>'email invalido']);
                }
            }
            else
            {
                $this->dataError['errorApi'] = response()->json(['error'=>'ha ocurrido un error, intente mas tarde']);
            }

            if(!empty($this->dataError))
            {
                
                return response()->json($this->dataError);
            }
            else
            {
                // insertamos a la base de datos 
                $objModel = new formModel();
                $sendToModel = $objModel->sendForm($this->dataForm);

                if($sendToModel == true)
                {
                    return response()->json(['sucess'=>'usuario registrado exitosamente']);
                }
                else
                {
                    return response()->json(['errorInsert'=>'ha ocurrido un error al enviar los datos']);
                }

            }
           
               

            
        }


      


    }


    // en esta funcion preguntaremos si existen usuarios para mostrar el boton en pantalla
    public function existUsers()
    {

        $objModel = new formModel();
        $objToSendModel = $objModel->askUsers();
        return $objToSendModel;
          
    }

    public function showUsersView()
    {
        $objModel = new formModel();
        $objToGetusers = $objModel->allUsersToShow();
        
        return view('users',['objToGetusers'=>$objToGetusers]);
    }
}
