<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make("user.create", [
            'ruta' => ['id' => 'users','route' => 'users.store'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
            DB::commit();

            return redirect('users')->with('status', 'Usuario Guardado Correctamente!');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return View::make("user.create", [
            'ruta' => [
                'id' => 'users',
                'method' => 'PUT',
                'route'  => ['users.update', $user->id], 'autocomplete' => 'on'],
                'user'   => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        DB::beginTransaction();

        try {
            User::where('id', $user->id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password)
            ]);

            DB::commit();

            return redirect('users')->with('status', 'Usuario Editado Correctamente!');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            User::find($id)->delete();

            DB::commit();

            return Response::json([
                'url' => env('APP_URL') . '/users',
                'message' => 'Usuario Eliminado Correctamente',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function ajaxUsers(Request $request)
    {
        return Datatables::of(User::all())
            ->addColumn('actions', function ($user) {
                return '
                <a href="' . route('users.edit', $user->id) . '" class="btn btn-warning fa fa-edit"></a>
                <a href="#" class="btn btn-success fa fa-eye"></a>
                <a href="#" class="btn btn-danger fa fa-trash" id="delete" data-url="/users/' . $user->id . '"></a>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
