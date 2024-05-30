<?php

namespace App\Services\ConsolidatedSurplusUw\ProfitLoss\LongTerm;

use App\Repositories\MvAgen\MvAgenRepository;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;

class LongTermServiceImplement extends Service implements LongTermService
{

 
  protected $mvAgenRepository;

  public function __construct(MvAgenRepository $mvAgenRepository)
  {
    $this->mvAgenRepository = $mvAgenRepository;
  }

  public function getDataset()
  {


    $columns = array(
      "SOURCE_DATA"                   => "SOURCE_DATA",
      "PERIODE"                       => "SUBSTRING(A.MTHNAME, 1, LEN(A.MTHNAME)-3)",
      "KANWIL"                        => "LC.KANWIL",
      "CABANG"                        => "LC.CABANG",
      "PERWAKILAN"                    => "LC.PERWAKILAN",
      "SUB_PERWAKILAN"                => "LC.SUB_PERWAKILAN",
      "NAMALEADER0"                   => "MA.NAMALEADER0",
      "NAMALEADER1"                   => "MA.NAMALEADER1",
      "NAMALEADER2"                   => "MA.NAMALEADER2",
      "NAMALEADER3"                   => "MA.NAMALEADER3",
      "MO"                            => "MO.NM_MO",
      "GROUPBUSINESS"                 => "LGB.LGB_NOTE",
      "BUSINESS"                      => "LB.LBU_NOTE",
      "CLIENT_NAME"                   => "MC.MCL_NAME",
      "NO_POLIS"                      => "A.NO_POLIS",
      "NO_CIF"                        => "A.NO_CIF",
      "JENIS_PAKET"                   => "A.MSP_JN_PAKET",
      "KETERANGAN"                    => "JN_COAS.KETERANGAN",
      "NAMA_CEDING"                   => "A.NAMA_CEDING",
      "NAMA_DEALER"                   => "A.NAMA_DEALER",
      "TSI"                           => "A.TSI",
      "GROSS_PREMIUM_WRITTEN"         => "A.GPW",
      "DISC"                          => "A.DISC",
      "DISC2"                         => "A.DISC2",
      "COMM"                          => "A.COMM",
      "OC"                            => "A.OC",
      "NETTO_GROSS_WRITTEN_PREMIUM"   => "A.GPW + A.DISC + A.DISC2 + A.COMM + A.OC",
      "BIAYA_KANTOR_PUSAT"            => "A.BIAYA_KANTOR_PUSAT",
      "REINSURANCE"                   => "A.RI",
      "RICOM"                         => "A.RICOM",
      "NETTO_WRITTEN_PREMIUM"         => "A.GPW + A.DISC + A.DISC2 + A.COMM + A.OC + A.RI + A.RICOM + A.BIAYA_KANTOR_PUSAT",
      "CADANGAN_PREMI_TAHUN_LALU"     => "A.CADPREMI",
      "CADANGAN_PREMI_TAHUN_BERJALAN" => "A.CADPREMI1",
      "PREMIUM_RESERVE"               => "A.PREMIUM_RESERVE",
      "NET_PREMIUM_EARNED"            => "A.GPW+A.DISC+A.DISC2+A.COMM+A.OC+A.RI+A.RICOM+A.PREMIUM_RESERVE+ A.BIAYA_KANTOR_PUSAT",
      "ACCEPTED_CLAIM"                => "A.ACCEPTEDCLAIM",
      "REJECT_CLAIM"                  => "A.REJECTCLAIM",
      "OUTSTANDING_CLAIM"             => "A.OUTSTANDINGCLAIM",
      "REVERSED_CLAIM"                => "A.REVERSEDCLAIM",
      "SURPLUS_DEFICIT_UW"            => "A.GPW+A.DISC+A.DISC2+A.COMM+A.OC+A.RI+A.RICOM+A.PREMIUM_RESERVE - (A.ACCEPTEDCLAIM+A.REJECTCLAIM-A.REVERSEDCLAIM+A.OUTSTANDINGCLAIM) + A.BIAYA_KANTOR_PUSAT",


    );


    $builder = DB::table("Warehouse_Asm_SPK.dbo.PRODCLAIMMONTH_GABUNGAN_VIEW AS A");

    foreach ($columns as $alias => $column)
    {
      $builder->addSelect(DB::raw($column . " AS " . "[$alias]"));
    }
    $builder->join("Warehouse_Asm_SPK.dbo.MV_AGEN AS MA", "A.LAG_AGEN_ID", "=", "MA.LAG_AGEN_ID");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_CABANG AS LC", "A.LDC_ID", "=", "LC.LDC_ID");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_BUSINESS AS LB", "A.LBU_ID", "=", "LB.LBU_ID");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_GRP_BUSINESS AS LGB", "LB.LGB_ID", "=", "LGB.LGB_ID");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_MO AS MO", "A.LMO_ID", "=", "MO.LMO_ID", "LEFT OUTER");
    $builder->join("Warehouse_Asm_SPK.dbo.MST_CLIENT AS MC", "A.CLIENT_ID", "=", "MC.MCL_ID", "LEFT OUTER");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_JENIS_COAS AS JN_COAS", "A.MDS_JN_COAS", "=", "JN_COAS.MDS_JN_COAS", "LEFT OUTER");

    $dataset = $builder->limit(2000)->get();
    return $dataset;
  }
}

