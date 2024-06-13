<?php

namespace App\Services\Claim\RejectClaim;

use App\Repositories\MvAgen\MvAgenRepository;
use Illuminate\Database\Query\Builder;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\DB;

class RejectClaimServiceImplement extends Service implements RejectClaimService
{

  protected $mvAgenRepository;

  public function __construct(MvAgenRepository $mvAgenRepository)
  {
    $this->mvAgenRepository = $mvAgenRepository;
  }

  public function getDataset($query = null)
  {
    $columns = array(
      "SOURCE_DATA"     => "SOURCE_DATA",
      "KANWIL"          => "LC.KANWIL",
      "CABANG"          => "LC.CABANG",
      "PERWAKILAN"      => "LC.PERWAKILAN",
      "SUB_PERWAKILAN"  => "LC.SUB_PERWAKILAN",
      "NAMALEADER0"     => "MA.NAMALEADER0",
      "NAMALEADER1"     => "MA.NAMALEADER1",
      "NAMALEADER2"     => "MA.NAMALEADER2",
      "NAMALEADER3"     => "MA.NAMALEADER3",
      "GROUPBUSINESS"   => "LGB.LGB_NOTE",
      "BUSINESS"        => "LB.LBU_NOTE",
      "TAHUN_POLIS"     => "LEFT(A.B_DATE,4)",
      "ACCEPTED_NO"     => "A.ACCEPTED_NO",
      "NO_POLIS"        => "A.NO_POLIS",
      "NO_CIF"          => "A.NO_CIF",
      "CLIENT_NAME"     => "MC.MCL_NAME",
      "MO"              => "A.MO",
      "PREPARE_DATE"    => "SUBSTRING(A.PREPARE_DATE,1,LEN(A.PREPARE_DATE)-3)",
      "DATE_OF_LOSS"    => "SUBSTRING(A.DATE_OF_LOSS,1,LEN(A.DATE_OF_LOSS)-3)",
      "REJECTED_DATE"   => "SUBSTRING(A.REJECTED_DATE,1,LEN(A.REJECTED_DATE)-3)",
      "BEGIN_DATE"      => "SUBSTRING(A.B_DATE,1,LEN(A.B_DATE)-3)",
      "END_DATE"        => "SUBSTRING(A.E_DATE,1,LEN(A.E_DATE)-3)",
      "NAMA_DEALER"     => "A.NAMA_DEALER",
      "TSI"             => "A.TSI_CUMM",
      "REJECT_CLAIM"    => "A.REJECT_CLAIM",
      "REJECT_CLAIM_RP" => "A.REJECT_CLAIM_RP",
      "OWN_RETENTION"   => "A.OWN_RETENTION ",
      "CO_INS"          => "A.CO_INS",
      "PSRSPL"          => "A.PSRSPL",
      "QS_RI"           => "A.QS_RI",
      "ER1"             => "A.ER1",
      "SURPLUS1"        => "A.SURPLUS1",
      "SURPLUS2"        => "A.SURPLUS2",
      "ER2"             => "A.ER2",
      "PSRQS_RI"        => "A.PSRQS_RI",
      "PSRQS_OR"        => "A.PSRQS_OR",
      "ORS"             => "A.ORS",
      "FACULTATIVE"     => "A.FACULTATIVE",
      "FACOBLIG"        => "FACOBLIG",
      "BPPDAN"          => "A.BPPDAN",
      "XL"              => "A.XL",
      "PFRA"            => "A.PFRA",
    );

    $builder = DB::table("Warehouse_Asm_SPK.dbo.Rejectclaim_GABUNGAN_VIEW AS A");

    foreach ($columns as $alias => $column)
    {
      $builder->addSelect(DB::raw($column . " AS " . "[$alias]"));
    }
    $builder->join("Warehouse_Asm_SPK.dbo.MV_AGEN AS MA", "A.LAG_AGEN_ID", "=", "MA.LAG_AGEN_ID");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_CABANG AS LC", "A.LDC_ID", "=", "LC.LDC_ID");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_BUSINESS AS LB", "A.LBU_ID", "=", "LB.LBU_ID");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_GRP_BUSINESS AS LGB", "LB.LGB_ID", "=", "LGB.LGB_ID");
    $builder->join("Warehouse_Asm_SPK.dbo.MST_CLIENT AS MC", "A.CLIENT_ID", "=", "MC.MCL_ID", "LEFT OUTER");

    
    $beginDate = isset($query['REJECTED_DATE']) ? dmYtoYmd($query['REJECTED_DATE']) : null;
    $endDate   = isset($query['END_DATE']) ? dmYtoYmd($query['END_DATE']) : null;

    if ($beginDate && ! $endDate)
    {
      $raw = "CONVERT(DATE, SUBSTRING(A.REJECTED_DATE,1,LEN(A.REJECTED_DATE)-3), 23) >= ?";
      $builder->whereRaw($raw, [$beginDate]);
    }
    else if (! $beginDate && $endDate)
    {
      $raw = "CONVERT(DATE, SUBSTRING(A.E_DATE,1,LEN(A.E_DATE)-3), 23) <= ?";
      $builder->whereRaw($raw, [$endDate]);
    }
    else if ($beginDate && $endDate)
    {
      $beginRaw = "CONVERT(DATE, SUBSTRING(A.REJECTED_DATE,1,LEN(A.REJECTED_DATE)-3), 23)";
      $endRaw   = "CONVERT(DATE, SUBSTRING(A.E_DATE,1,LEN(A.E_DATE)-3), 23)";
      $builder->where(function ($qq) use ($beginDate, $endDate, $beginRaw, $endRaw)
      {
        $qq->where(function ($qqy) use ($beginDate, $endDate, $beginRaw, $endRaw)
        {
          $qqy->whereRaw("($beginRaw >= ? AND $beginRaw <= ?)", [$beginDate, $endDate]);
          $qqy->whereRaw("($endRaw >= ?  AND $endRaw <= ?)", [$beginDate, $endDate]);
        });
      });
    }

    $dataset = $builder->limit(2000)->get();
    return $dataset;

  }
}
