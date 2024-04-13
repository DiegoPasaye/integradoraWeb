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
    
        if ($usuario && $request->contraseña == $usuario->contraseña) {
            Auth::login($usuario);
    
            session(['zonasId' => $usuario->zonasId]);
    
            session()->flash('message', 'Inicio de sesión exitoso');
            return redirect('admin');
        } else {
            return back()->withErrors([
                'usuario' => 'Las credenciales son incorrectas.',
            ]);
        }
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
}
