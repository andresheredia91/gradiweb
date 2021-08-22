<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Models\User;
use App\Models\Marca;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\VehiculoCreateRequest;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('vehiculos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make("vehiculos.create", [
            'ruta' => ['id' => 'vehiculos','route' => 'vehiculos.store'],
            'users' => User::pluck('name', 'id')->toArray(),
            'marcas' => Marca::pluck('description', 'id')->toArray(),
            'tipos' => Tipo::pluck('description', 'id')->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehiculoCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            Vehiculo::create([
                'placa' => $request->placa,
                'marca_id' => $request->marca,
                'tipo_id' => $request->tipo,
                'user_id' => $request->usuario,
            ]);
            DB::commit();

            return redirect('vehiculos')->with('status', 'Vehiculo Guardado Correctamente!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('vehiculos')->with('status', 'Vehiculo No Se Puedo Crear Correctamente!');
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
    public function edit(Vehiculo $vehiculo)
    {
        return View::make("vehiculos.create", [
            'ruta' => [
                'id' => 'vehiculos',
                'method' => 'PUT',
                'route'  => ['vehiculos.update', $vehiculo->id], 'autocomplete' => 'on'],
                'vehiculo' => $vehiculo,
                'users' => User::pluck('name', 'id')->toArray(),
                'marcas' => Marca::pluck('description', 'id')->toArray(),
                'tipos' => Tipo::pluck('description', 'id')->toArray(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        DB::beginTransaction();

        try {
            Vehiculo::where('id', $vehiculo->id)
                ->update([
                    'marca_id' => $request->marca,
                    'tipo_id' => $request->tipo,
                    'user_id' => $request->usuario,
            ]);

            DB::commit();

            return redirect('vehiculos')->with('status', 'Vehiculo Editado Correctamente!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('vehiculos')->with('status', 'Vehiculo No se Puede Editar Correctamente!');
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
            Vehiculo::find($id)->delete();

            DB::commit();

            return Response::json([
                'url' => env('APP_URL') . '/vehiculos',
                'message' => 'Vehiculo Eliminado Correctamente',
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
    public function ajaxVehiculos(Request $request)
    {
        return Datatables::of(
            Vehiculo::with('Marca', 'Tipo', 'User')
            ->get()
        )
            ->addColumn('actions', function ($vehiculo) {
                return '
                <a href="' . route('vehiculos.edit', $vehiculo->id) . '" class="btn btn-warning fa fa-edit"></a>
                <a href="#" class="btn btn-success fa fa-eye"></a>
                <a href="#" class="btn btn-danger fa fa-trash" id="delete" data-url="/vehiculos/' . $vehiculo->id . '"></a>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function ajaxCantidad(Request $request)
    {
        return Datatables::of(
            DB::table('marcas as m')
                ->join('vehiculos as v', 'm.id', '=', 'v.marca_id')
                ->select(DB::raw('initcap(m.description) AS marca'), DB::raw('count(v.id) as cantidad'))
                ->groupBy('m.description')
                ->get()
        )
            ->make(true);
    }
}
