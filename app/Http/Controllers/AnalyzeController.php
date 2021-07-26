<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;

class AnalyzeController extends Controller
{
    public function index(Request $request)
    {
        $patientCountStadiumType = Patient::countByStadiumType();
        $patientCountByGender = Patient::countByGender();
        $patientCountByTreatmentType = Patient::countByTreatmentType();
        $patientCountByStatus = Patient::countByStatus();
        $patientCountByTumorSize = Patient::countByTumorSize();
        $patientMonthlyStatus = Patient::monthlyStatus(date('Y'));

        return view('admin-master.analyze.index', [
            'patient_stadium_type' => json_encode($patientCountStadiumType),
            'count_by_gender' => json_encode($patientCountByGender),
            'count_by_treatment_type' => json_encode($patientCountByTreatmentType),
            'count_by_status' => json_encode($patientCountByStatus),
            'count_by_tumor_size' => json_encode($patientCountByTumorSize),
            'monthly_status' => json_encode($patientMonthlyStatus)
        ]);
    }
}
