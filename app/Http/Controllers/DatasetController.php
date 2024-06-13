<?php

namespace App\Http\Controllers;

use App\Livewire\ConsolidatedSurplusUw\SurplusUwYear;
use App\Services\Claim\AcceptedClaim\AcceptedClaimService;
use App\Services\Claim\OutstandingClaim\OutstandingClaimService;
use App\Services\Claim\RejectClaim\RejectClaimService;
use App\Services\ConsolidatedSurplusUw\ProfitLoss\LongTerm\LongTermService as ProfitLossLongTermService;
use App\Services\ConsolidatedSurplusUw\ProfitLoss\Year\YearService as ProfitLossYearService;
use App\Services\ConsolidatedSurplusUw\SurplusUw\LongTerm\LongTermService as SurplusUwLongTermService;
use App\Services\ConsolidatedSurplusUw\SurplusUw\Year\YearService as SurplusUwYearService;
use App\Services\Production\LongTerm\LongTermService as ProductionLongTermService;
use App\Services\Production\Year\YearService as ProductionYearService;
use Illuminate\Http\Request;

class DatasetController extends Controller
{
    protected $productionLongTermService;
    protected $productionYearService;
    protected $surplusUwLongTermService;
    protected $surplusUwYearService;
    protected $profitLossLongTermService;
    protected $profitLossYearService;
    protected $acceptedClaimService;
    protected $rejectClaimService;
    protected $outstandingClaimService;

    public function __construct(
        ProductionLongTermService $productionLongTermService,
        ProductionYearService $productionYearService,
        SurplusUwLongTermService $surplusUwLongTermService,
        SurplusUwYearService $surplusUwYearService,
        ProfitLossLongTermService $profitLossLongTermService,
        ProfitLossYearService $profitLossYearService,
        AcceptedClaimService $acceptedClaimService,
        RejectClaimService $rejectClaimService,
        OutstandingClaimService $outstandingClaimService,

    ) {
        $this->productionLongTermService = $productionLongTermService;
        $this->productionYearService     = $productionYearService;
        $this->surplusUwLongTermService  = $surplusUwLongTermService;
        $this->surplusUwYearService      = $surplusUwYearService;
        $this->profitLossLongTermService = $profitLossLongTermService;
        $this->profitLossYearService     = $profitLossYearService;
        $this->acceptedClaimService      = $acceptedClaimService;
        $this->rejectClaimService        = $rejectClaimService;
        $this->outstandingClaimService   = $outstandingClaimService;
    }

    public function getDatasetProductionLongTerm(Request $request)
    {
        $query   = array_filter($request->query());
        $dataset = $this->productionLongTermService->getDataset($query);
        return response()->json($dataset, 200, [], JSON_NUMERIC_CHECK);
    }
    public function getDatasetProductionYear(Request $request)
    {
        $query   = array_filter($request->query());
        $dataset = $this->productionYearService->getDataset($query);
        return response()->json($dataset, 200, [], JSON_NUMERIC_CHECK);
    }
    public function getDatasetConsolidatedSurplusUwLongTerm(Request $request)
    {   
        $query   = array_filter($request->query());
        $dataset = $this->surplusUwLongTermService->getDataset($query);
        return response()->json($dataset, 200, [], JSON_NUMERIC_CHECK);
    }
    public function getDatasetConsolidatedSurplusUwYear(Request $request)
    {
        $query   = array_filter($request->query());
        $dataset = $this->surplusUwYearService->getDataset($query);
        return response()->json($dataset, 200, [], JSON_NUMERIC_CHECK);
    }
    public function getDatasetConsolidatedProfitLossLongTerm(Request $request)
    {
        $query   = array_filter($request->query());
        $dataset = $this->profitLossLongTermService->getDataset($query);
        return response()->json($dataset, 200, [], JSON_NUMERIC_CHECK);
    }
    public function getDatasetConsolidatedProfitLossYear(Request $request)
    {
        $query   = array_filter($request->query());
        $dataset = $this->profitLossYearService->getDataset($query);
        return response()->json($dataset, 200, [], JSON_NUMERIC_CHECK);
    }
    public function getDatasetAcceptedClaim(Request $request)
    {
        $query   = array_filter($request->query());
        $dataset = $this->acceptedClaimService->getDataset($query);
        return response()->json($dataset, 200, [], JSON_NUMERIC_CHECK);
    }
    public function getDatasetRejectClaim(Request $request)
    {
        $query   = array_filter($request->query());
        $dataset = $this->rejectClaimService->getDataset($query);
        return response()->json($dataset, 200, [], JSON_NUMERIC_CHECK);
    }
    public function getDatasetOutstandingClaim(Request $request)
    {
        $query   = array_filter($request->query());
        $dataset = $this->outstandingClaimService->getDataset($query);
        return response()->json($dataset, 200, [], JSON_NUMERIC_CHECK);
    }
}
