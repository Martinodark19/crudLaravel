<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\crudModel;
use App\Models\formModel;

class crudController extends Controller
{
    public function delete(Request $request)
    {

        $response = $request->all()['values'];

        if(!empty($response))
        {
            foreach($response as $user)
            {
                $objModel = new crudModel();
                $sendToModel = $objModel->deleteUsers($user);
            }
            if($sendToModel)
            {
                return response()->json(['success'=>'usuario eliminado correctamente']);
                
            }
            else
            {
                return response()->json(['error'=>'hubo un error al eliminar el usuario, intente nuevamente']);
            }
        }
        else
        {
           return response()->json(['error'=>'error al eliminar el usuario']);
        }
    }

    // funcion para mostrar vista donde editar los usuarios
    public function edit(Request $request)
    {
       $objModel = new crudModel();
       $sendToModel = $objModel->showUsersToEdit();

        if(!empty($sendToModel))
        {
            return view('editUsers',['usersToEdit'=>$sendToModel]);
        }
        else
        {
            return response()->json(['error'=>'no hay usuarios para editar']);
        }
    }

    public function updateUsers(Request $request)
    {
        $response = $request->all();

      
        
        if(!empty($response))
        {
            $objModel = new crudModel();
            $sendToModel = $objModel->updateUsers($response);

            if($sendToModel)
            {
                return response()->json(['success'=>'datos actualizados correctamente']);
            }
            else
            {
                return response()->json(['error'=>'hubo un error al actualizar los datos, reintente nuevamente']);
            }

        }
        else
        {
            return response()->json(['error'=>'no llegaron los datos']);
        }
    }
}
