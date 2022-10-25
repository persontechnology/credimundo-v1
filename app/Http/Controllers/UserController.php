<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data = array('roles' => Role::whereNotIn('name',[config('app.ROLE_ADMIN')])->get() );
        return view('users.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user=User::create($request->all());
            $user->assignRole($request->roles);
        
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $path = Storage::putFileAs(
                    'users/fotos', $request->file('foto'), $user->id.'.'.$request->file('foto')->getClientOriginalExtension()
                );
                $user->foto=$path;
                $user->save();
            }

            if ($request->hasFile('foto_identificacion') && $request->file('foto_identificacion')->isValid()) {
                $path_identificacion = Storage::putFileAs(
                    'users/identificacion', $request->file('foto_identificacion'), $user->id.'.'.$request->file('foto_identificacion')->getClientOriginalExtension()
                );
                $user->foto_identificacion=$path_identificacion;
                $user->save();
            }
            DB::commit();
            return redirect()->route('usuarios.index')->with('success','Usuario guardado.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->with('danger','Ocurrio un error, vuelva intentar o consulte con administrador.'.$th->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($userId)
    {
        
        $user=User::findOrFail($userId);
        $data = array(
            'user' => $user,
            'roles'=>Role::whereNotIn('name',[config('app.ROLE_ADMIN')])->get()
        );

        return view('users.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $userId)
    {
        $user=User::findOrFail($userId);
        return $user;
        try {
            DB::beginTransaction();
        
            $path_anterior_foto=$user->foto;
            $path_anterior_foto_identificacion=$user->foto_identificacion;
            $user->update($request->all());
            $user->syncRoles($request->roles);
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                Storage::delete($path_anterior_foto);
                $path = Storage::putFileAs(
                    'users/fotos', $request->file('foto'), $user->id.'.'.$request->file('foto')->getClientOriginalExtension()
                );
                $user->foto=$path;
                $user->save();
            }

            if ($request->hasFile('foto_identificacion') && $request->file('foto_identificacion')->isValid()) {
                Storage::delete($path_anterior_foto_identificacion);
                $path_identificacion = Storage::putFileAs(
                    'users/identificacion', $request->file('foto_identificacion'), $user->id.'.'.$request->file('foto_identificacion')->getClientOriginalExtension()
                );
                $user->foto_identificacion=$path_identificacion;
                $user->save();
            }

            

            DB::commit();
            return redirect()->route('usuarios.index')->with('success','Usuario actualizado.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->with('danger','Ocurrio un error, vuelva intentar o consulte con administrador.'.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId)
    {
        try {
            $user = User::findOrFail($userId);
            if($user->delete()){
                Storage::delete($user->foto_identificacion);
                Storage::delete($user->foto);
            }
            Session::flash('success','Usuario eliminado.!');
        } catch (\Throwable $th) {
            Session::flash('info','Usuario no eliminado.!');
        }
        return redirect()->route('usuarios.index');

    }

    public function verArchivo($idUser,$tipo)
    {
        $user=User::findOrFail($idUser);
        switch ($tipo) {
            case 'foto':
                return Storage::get($user->foto);        
                break;
            case 'foto_identificacion':
                return Storage::get($user->foto_identificacion);        
                break;
            default:
                return '';
                break;
        }
    }
    public function descargarArchivo($idUser,$tipo)
    {
        $user=User::findOrFail($idUser);
        switch ($tipo) {
            case 'foto':
                return Storage::download($user->foto);        
                break;
            case 'foto_identificacion':
                return Storage::download($user->foto_identificacion);        
                break;
            default:
                return '';
                break;
        }
    }
}
