<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;

class AnalyzeController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->query->get('year') ?? date('Y');

        $patientCountByTumorSize = Patient::countByTumorSize($year);
        $patientMonthlyStatus = Patient::monthlyStatus($year);

        $countDataPerCategory = Patient::probabilityData($year);
        $probability = Patient::averageProbability($year);

        return view('admin-master.analyze.index', [
            'year' => $year,
            'count_by_tumor_size' => json_encode($patientCountByTumorSize),
            'monthly_status' => json_encode($patientMonthlyStatus),
            'count_data_per_category' => json_encode($countDataPerCategory),
            'probability' => $probability
        ]);
    }
}
