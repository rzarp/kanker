<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PatientProgressPostRequest;
use App\{
    Patient,
    PatientProgress
};

class PatientProgressController extends Controller
{
    public function index($patientId)
    {
        return view('admin-master.patient-progress.index', [
            'patient' => Patient::findOrfail($patientId),
            'patientprogress' => PatientProgress::where('patient_id', $patientId)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function create(PatientProgressPostRequest $request, $patientId)
    {
        Patient::findOrFail($patientId);

        $data = $request->validated();
        $data['patient_id'] = $patientId;

        PatientProgress::create($data);

        flash('Data berhasil ditambah')->success();
        return redirect()->route('patient.progress', [
            'patientId' => $patientId
        ]);
    }

    public function delete(Request $request)
    {
        PatientProgress::destroy($request->get('id'));

        flash('Data berhasil dihapus')->error();
        return redirect()->back();
    }
}
