<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PatientPostRequest;
use App\{
    User,
    Patient
};
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Patient::with('user', 'doctor');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = "
                    <div class='row'>
                        <a href='" . route('patient.show', $row->id) . "' class='btn btn-success ml-2'>Detail</a>
                        <a href='" . route('patient.edit', $row->id) . "' class='btn btn-primary ml-2'>Edit</a>
                        <form method='POST' action='" . route('patient.destroy', $row->id) . "' class='col-md-4'>
                            <div class='row'>
                                " . csrf_field() . "
                                <input type='hidden' name='_method' value='DELETE'>
                                <button type='submit' class='btn btn-danger ml-2'>Hapus</button>
                            </div>
                        </form>
                    </div>
                    ";
                    return $button;
                })
                ->addColumn('status', function ($row) {
                    $labelType = $row->status == 'MENINGGAL' ? 'danger' : 'success';

                    return "<label class='badge badge-{$labelType}'> {$row->status} </label>";
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin-master.patient.data-pasien');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-master.patient.input-pasien', [
            'doctor' => User::where('role', 'ADMIN')->get(),
            'medicalNumber' => Patient::all()->count() + 1
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientPostRequest $request)
    {
        DB::beginTransaction();

        try {
            $patientData = $request->validated();
            Patient::create($patientData);

            DB::commit();

            flash('Data pasien berhasil ditambah!')->success();
            return redirect()->route('patient.index');
        } catch (\Exception $e) {
            DB::rollback();
            flash('Data gagal ditambah!')->error();
            return redirect()->back();
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
        return view('admin-master.patient.view-pasien', [
            'patient' => Patient::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin-master.patient.input-pasien', [
            'patient' => Patient::findOrFail($id),
            'doctor' => User::where('role', 'admin')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatientPostRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            Patient::where('id', $id)->update($request->validated());
            DB::commit();

            flash('Data berhasil diupdate')->success();
            return redirect()->route('patient.index')
                ->with('message', 'Data Berhasil Diupdate');
        } catch (\Exception $e) {
            DB::rollback();

            flash('Data gagal diupdate')->error();
            return redirect()->back();
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
        Patient::destroy($id);
        flash('Data berhasil dihapus')->error();
        return redirect()->route('patient.index');
    }
}
