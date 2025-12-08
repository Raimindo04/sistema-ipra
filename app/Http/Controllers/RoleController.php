<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'check.active']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);
        return view('roles.index',[
            "roles" => Role::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Role::class);
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255|unique:roles,name',
            'description' => 'nullable|string|max:2500',
        ]);
        $this->authorize('create', Role::class);
        try {
            Role::create($data);
        } catch (\Exception $e) {
            throw $e;
        }

        return redirect()->route('roles.index')->with('success', 'Perfil adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $this->authorize('view',$role);
        return view('roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $this->authorize('update',$role);
        return view('roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {



        $role = Role::findOrFail($id);
        $request->merge([
            'active' => $request->has('active') ? 'true' : 'false',
        ]);

        // Validação dos dados
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|string|max:2500',
            'active'      => 'sometimes|in:true,false',
        ]);
        // dd( $request->all());
        $this->authorize('update', $role);


        // Actualiza o perfil

        $role->update($validated);

        //    dd( $validated);
        // Redireciona com mensagem de sucesso
        return redirect()->route('roles.show',$role->id)->with('success', 'Perfil Actualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);
        Role::destroy($role->id);
        return redirect()->route('role');
    }

    public function syncPermission (Role $role)
    {
        $permissions = Permission::all();
        $this->authorize('sync',$role);
        return view('roles.sync', compact('role','permissions'));
    }

    public function  sync (Role $role, Request $request)
    {
        // dd($request->all());
        $this->authorize('sync', $role);
        $role->permissions()->sync(request()->input('permission_id',[]));

        return redirect()->route('roles.sync',['role' => $role->id])->with('success', 'Permissões sincronizadas com sucesso!');
    }

}
