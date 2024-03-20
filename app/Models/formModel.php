<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class formModel extends Model
{
    use HasFactory;
    protected $table = "user_information_migration";
    protected $filable = ['nombre','apellido_paterno','apellido_materno','rut','email','profesion','direccion','region'];

    public function sendForm($arrayData)
    {
        // query para preguntar si el usuario existe antes de insertarlo
        $queryForAskIfExist =  DB::table($this->table)
        ->where([
            'rut'=>$arrayData['rut'],
            'email'=>$arrayData['email']
        ])->count();

        // si el usuario no existe procede a insertarlo
        if($queryForAskIfExist < 1)
        {
            $response = false;
            try
            {
                DB::beginTransaction();

                DB::table($this->table)->insert([
                    'nombre'=>$arrayData['nombre'],
                    'apellido_paterno'=>$arrayData['apellido_paterno'],
                    'apellido_materno'=>$arrayData['apellido_materno'],
                    'rut'=>$arrayData['rut'],
                    'email'=>$arrayData['email'],
                    'profesion'=>$arrayData['profesion'],
                    'direccion'=>$arrayData['direccion'],
                    'region'=>$arrayData['region']
                ]);

                DB::commit();
            }
            catch(\Exception $e)
            {
                DB::rollBack();
            }

            $response = true;
    
        }
        else
        {
            return response()->json(['errorInsert'=>'el usuario ya existe, intente con otro']);
        }

        return $response;
    }

    
    public function askUsers()
    {
        
        $queryToAskForUsers = DB::table($this->table)->count();
       
        if($queryToAskForUsers == 0)
        {
            return response()->json(['error'=>'la coleccion no tiene usuarios']);
        }
        else
        {
            $queryToAskForUsers = DB::table($this->table)->get();
            return response()->json(['success'=>'existen usuarios','data'=>$queryToAskForUsers]);
            //dd("la coleccion tiene datos");
        }
    }

    public function allUsersToShow()
    {
        $queryGetAllUsers = DB::table($this->table)->get();
        
        if($queryGetAllUsers)
        {
            return $queryGetAllUsers;
        }   
        else
        {
            return response()->json(['error'=>'error al mostrar usuarios a la vista']);
        }
    }
}
