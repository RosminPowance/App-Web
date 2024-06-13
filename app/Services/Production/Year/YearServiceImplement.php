<?php

namespace App\Services\Production\Year;

use App\Repositories\MvAgen\MvAgenRepository;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;

class YearServiceImplement extends Service implements YearService
{

  protected $mvAgenRepository;

  public function __construct(MvAgenRepository $mvAgenRepository)
  {
    $this->mvAgenRepository = $mvAgenRepository;
  }

  public function getDataset($query = null)
  {
    $columns = array(
      "SOURCE_DATA"                 => "SOURCE_DATA",
      "THNBLN"                      => "CONVERT(CHAR(4),LEFT(A.TGL_PROD,4)) + CONVERT(CHAR(4),RIGHT(A.TGL_PROD,2))",
      "PRODUCTION_DATE"             => "SUBSTRING(A.TGL_PROD, 1, LEN(A.TGL_PROD)-3)",
      "BEGIN_DATE"                  => "SUBSTRING(A.B_DATE_TH, 1, LEN(A.B_DATE_TH)-3)",
      "END_DATE"                    => "SUBSTRING(A.E_DATE_TH, 1, LEN(A.E_DATE_TH)-3)",
      "MO"                          => "MO.NM_MO",
      "CLIENT_NAME"                 => "MC.MCL_NAME",
      "KANWIL"                      => "LC.KANWIL",
      "CABANG"                      => "LC.CABANG",
      "PERWAKILAN"                  => "LC.PERWAKILAN",
      "SUB_PERWAKILAN"              => "LC.SUB_PERWAKILAN",
      "JNNER"                       => "JNN.DESCRIPTION",
      "JENIS_PRODUKSI"              => "LJP.LJP_NOTE",
      "JENIS_PAKET"                 => "A.MSP_JN_PAKET",
      "KETERANGAN"                  => "JN_COAS.KETERANGAN",
      "NAMA_CEDING"                 => "A.NAMA_CEDING",
      "NAMALEADER0"                 => "MA.NAMALEADER0",
      "NAMALEADER1"                 => "MA.NAMALEADER1",
      "NAMALEADER2"                 => "MA.NAMALEADER2",
      "NAMALEADER3"                 => "MA.NAMALEADER3",
      "GROUPBUSINESS"               => "LGB.LGB_NOTE",
      "BUSINESS"                    => "LB.LBU_NOTE",
      "NO_POLIS"                    => "A.NO_POLIS",
      "NO_CIF"                      => "A.NO_CIF",
      "PROD_KE"                     => "A.PROD_KE",
      "NAMA_DEALER"                 => "A.NAMA_DEALER",
      "TSI"                         => "A.TSI",
      "GROSS_PREMIUM_WRITTEN"       => "A.GPW",
      "DISC"                        => "A.DISC",
      "DISC2"                       => "A.DISC2",
      "COMM"                        => "A.COMM",
      "OC"                          => "A.OC",
      "NETTO_GROSS_WRITTEN_PREMIUM" => "A.GPW + A.DISC + A.DISC2 + A.COMM + A.OC",
      "BIAYA_KANTOR_PUSAT"          => "A.BIAYA_KANTOR_PUSAT",
      "REINSURANCE"                 => "A.RI",
      "RICOM"                       => "A.RICOM",
      "NETTO_WRITTEN_PREMIUM"       => "A.GPW + A.DISC + A.DISC2 + A.COMM + A.OC + A.RI + A.RICOM + A.BIAYA_KANTOR_PUSAT",
    );

    $builder = DB::table("Warehouse_Asm_SPK.dbo.PRODUCTION_TAHUNAN_ACC_GABUNGAN_VIEW AS A");

    foreach ($columns as $alias => $column)
    {
      $builder->addSelect(DB::raw($column . " AS " . "[$alias]"));
    }
    $builder->join("Warehouse_Asm_SPK.dbo.MV_AGEN AS MA", "A.LAG_ID", "=", "MA.LAG_AGEN_ID");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_CABANG AS LC", "A.LDC_ID", "=", "LC.LDC_ID");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_BUSINESS AS LB", "A.LBU_ID", "=", "LB.LBU_ID");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_GRP_BUSINESS AS LGB", "LB.LGB_ID", "=", "LGB.LGB_ID");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_JN_PRODUKSI AS LJP", "LJP.LJP_ID", "=", "A.LJP_ID");
    $builder->join("Warehouse_Asm_SPK.dbo.JNNER AS JNN", "JNN.JN_NER", "=", "A.JN_NER");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_MO AS MO", "A.LMO_ID", "=", "MO.LMO_ID", "LEFT OUTER");
    $builder->join("Warehouse_Asm_SPK.dbo.MST_CLIENT AS MC", "A.CLIENT_ID", "=", "MC.MCL_ID", "LEFT OUTER");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_JENIS_COAS AS JN_COAS", "A.MDS_JN_COAS", "=", "JN_COAS.MDS_JN_COAS", "LEFT OUTER");

    $beginDate = isset($query['BEGIN_DATE']) ? dmYtoYmd($query['BEGIN_DATE']) : null;
    $endDate   = isset($query['END_DATE']) ? dmYtoYmd($query['END_DATE']) : null;

    if ($beginDate && ! $endDate)
    {
      $raw = "CONVERT(DATE, SUBSTRING(A.B_DATE_TH, 1, LEN(A.B_DATE_TH)-3), 23) >= ?";
      $builder->whereRaw($raw, [$beginDate]);
    }
    else if (! $beginDate && $endDate)
    {
      $raw = "CONVERT(DATE, SUBSTRING(A.E_DATE_TH, 1, LEN(A.E_DATE_TH)-3), 23) <= ?";
      $builder->whereRaw($raw, [$endDate]);
    }
    else if ($beginDate && $endDate)
    {
      $beginRaw = "CONVERT(DATE, SUBSTRING(A.B_DATE_TH, 1, LEN(A.B_DATE_TH)-3), 23)";
      $endRaw   = "CONVERT(DATE, SUBSTRING(A.E_DATE_TH, 1, LEN(A.E_DATE_TH)-3), 23)";
      $builder->where(function ($qq) use ($beginDate, $endDate, $beginRaw, $endRaw)
      {
        $qq->where(function ($qqy) use ($beginDate, $endDate, $beginRaw, $endRaw)
        {
          $qqy->whereRaw("($beginRaw >= ? AND $beginRaw <= ?)", [$beginDate, $endDate]);
          $qqy->whereRaw("($endRaw >= ?  AND $endRaw <= ?)", [$beginDate, $endDate]);
        });

        // $qq->Orwhere(function ($qqy) use ($beginDate, $endDate, $beginRaw, $endRaw)
        // {
        //   $qqy->whereRaw("(? >= $beginRaw AND ? <= $endRaw)", [$beginDate, $beginDate]);
        //   $qqy->whereRaw("(? >= $beginRaw AND ? <= $endRaw)", [$endDate, $endDate]);
        // });

        // $qq->Orwhere(function ($qqy) use ($beginDate, $endDate, $beginRaw, $endRaw)
        // {
        //   $qqy->whereRaw("(? >= $beginRaw AND ? < $endRaw)", [$beginDate, $beginDate]);
        //   $qqy->whereRaw("(? > $beginRaw AND ? <= $endRaw)", [$beginDate, $endDate]);
        // });
      });
    }

    $dataset = $builder->limit(2000)->get();
    return $dataset;
  }
}
