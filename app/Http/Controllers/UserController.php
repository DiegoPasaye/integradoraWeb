<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Zona;
use Illuminate\Support\Facades\DB;
use App\Models\Acceso;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $usuario = User::where('usuario', $request->usuario)->first();
    
        if ($usuario) {
            if ($request->usuario == 'admin' && $request->contraseña == 'adminCodev') {
                Auth::login($usuario);
    
                session(['zonasId' => $usuario->zonasId]);
    
                session()->flash('message', 'Inicio de sesión exitoso');
                return redirect('administracion');
            }
    
            if ($request->contraseña == $usuario->contraseña) {
                Auth::login($usuario);
    
                session(['zonasId' => $usuario->zonasId]);
    
                session()->flash('message', 'Inicio de sesión exitoso');
                return redirect('admin');
            }
        }
    
        return back()->withErrors([
            'usuario' => 'Las credenciales son incorrectas.',
        ]);
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    public function show($id)
    {
        $id = intval($id);
        $accesos = Acceso::where('_idZona', $id)->get();
        error_log(print_r($accesos, true));
        return view('zona', ['accesos' => $accesos]);
    }

    public function showLoginForm(){
        $usuario = User::first();
        return view('login', ['usuario' => $usuario]);
    }    
    public function toggleZonaStatus($id)
    {
        $id = intval($id);
        $zona = Zona::findOrFail($id);
        $zona->encendido = !$zona->encendido;
        $zona->save();
    
        return redirect()->route('admin')->with('success', 'Estado de la zona actualizado');
    }


    //administracion ----------------------------------------------------------------------------
    public function showZonas(){
        $zonas = Zona::all();
        return view('administracion/zonas', ['zonas' => $zonas]);
    }
    public function showUsers(){
        $zonas = Zona::all();
        $users = User::all();
        return view('administracion.users', ['users' => $users, 'zonas' => $zonas]);
    }
    public function destroyUser($id)
    {
        User::destroy($id);
        return redirect('/administracion/users');
    }
    public function editUserFull($id)
    {
        $user = User::find($id);
        $zonas = Zona::all();
        return view('administracion.editUser', ['user' => $user, 'zonas' => $zonas]);
    }
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->usuario = $request->input('usuario');
        $user->contraseña = $request->input('contraseña');
    
        $zonasId = array_map('intval', $request->input('zonasId'));

        $user->zonasId = $zonasId;
        $user->save();
    
        return redirect('/administracion/users');
    }
    public function createUser(Request $request)
    {
        $user = new User;
        $user->usuario = $request->input('usuario');
        $user->contraseña = $request->input('contraseña');
        $user->zonasId = array_map('intval', $request->input('zonasId'));
        $user->save();

        return redirect('/administracion/users');
    }

    




    public function createZona(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'encendido' => 'required|boolean',
        ]);
        $maxId = Zona::max('id');
        $newId = is_null($maxId) ? 1 : $maxId + 1;
        $encendido = $request->encendido == '1';
        $zona = Zona::create([
            'id' => $newId,
            'nombre' => $request->nombre,
            'encendido' => $request->encendido,
        ]);
        return redirect('/administracion/zonas');
    }

    public function destroyZona($id)
    {
        Zona::destroy($id);
        return redirect('/administracion/zonas');
    }
    public function editZona($id)
    {
        $zona = Zona::where('id', intval($id))->first();
        return view('administracion.edit', ['zona' => $zona]);
    }
    
    public function updateZona(Request $request, $id)
    {
        $zona = Zona::where('id', intval($id))->first();
        $zona->nombre = $request->input('nombre');
        $zona->encendido = $request->input('encendido') == '1' ? true : false;
        $zona->save();

    
        return redirect('/administracion/zonas');
    }
    
    




    //SECCION APII -------------------------------------------------------------------------------

    public function apiLogin(Request $request)
    {
        $usuario = User::where('usuario', $request->usuario)->first();
    
        if (!$usuario) {
            error_log('No se encontró el usuario: ' . $request->usuario);
            return response()->json([
                'message' => 'Las credenciales son incorrectas.',
            ], 401);
        }
        if ($request->contraseña != $usuario->contraseña) {
            error_log('Contraseña incorrecta para el usuario: ' . $request->usuario);
            return response()->json([
                'message' => 'Las credenciales son incorrectas.',
            ], 401);
        }
        error_log('Inicio de sesión exitoso para el usuario: ' . $request->usuario);
        return response([
            'message' => 'Inicio de sesión exitoso',
            'usuario' => $usuario->zonasId,
        ]);
    }
    
    public function apiLogout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    public function getZonas(Request $request)
    {
        $ids = explode(',', $request->query('ids'));
        $ids = array_map('intval', $ids);
        $zonas = Zona::whereIn('id', $ids)->get();
        return response()->json(['zonas' => $zonas]);
    }
    public function getAccesos(Request $request)
    {
        $idZona = intval($request->query('idZona'));
        $accesos = Acceso::where('_idZona', $idZona)->get();
        return response()->json(['accesos' => $accesos]);
    }   

    //sin funcionar
    public function changePassword(Request $request)
    {
        $user = $request->user();
    
        if ($request->oldPassword !== $user->contraseña) {
            return response()->json(['message' => 'La contraseña actual es incorrecta'], 401);
        }
    
        $user->contraseña = $request->newPassword;
        $user->save();
    
        return response()->json(['message' => 'Contraseña cambiada exitosamente'], 200);
    }

    public function updateUserImage(Request $request)
    {
        $user = $request->user();
        $imageUrl = $request->imageUrl;
    
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageUrl));
    
        $imageName = time() . '.png';
    
        file_put_contents(public_path() . '/' . $imageName, $image);
    
        $user->imageUrl = $imageName;
        $user->save();
    
        return response()->json(['message' => 'Imagen actualizada exitosamente'], 200);
    }
    


}
