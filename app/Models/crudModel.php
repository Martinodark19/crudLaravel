<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Else_;

class crudModel extends Model
{
    use HasFactory;
    protected $table = "user_information_migration";
    protected $filable = ['nombre','apellido_paterno','apellido_materno','rut','email','profesion','direccion','region'];



    public function deleteUsers($user)
    {
        $queryDelete = DB::table($this->table)->where('rut',$user)->delete();
        // preguntaremos por las filas afectadas por la eliminacion
        if($queryDelete > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function showUsersToEdit()
    {
        $queryToGetUsers = DB::table($this->table)->get();

        if(!empty($queryToGetUsers))
        {
            return $queryToGetUsers;
        }
        else
        {
            return false;
        }
    }

    public function updateUsers($users)
    {
        dd($users);
        foreach($users as $user)
        {
            $queryToGetUsers = DB::table($this->table)->update([
                'nombre'=>$user['nombre'],
                'apellido_paterno'=>$user['apellido_paterno'],
                'apellido_materno'=>$user['apellido_materno'],
                'rut'=>$user['rut'],
                'email'=>$user['email'],
                'profesion'=>$user['profesion'],
                'direccion'=>$user['direccion'],
                'region'=>$user['region']
            ]);
        }

        if($queryToGetUsers > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
      

    }
}
