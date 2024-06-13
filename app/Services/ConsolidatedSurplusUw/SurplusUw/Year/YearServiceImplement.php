<?php

namespace App\Services\ConsolidatedSurplusUw\SurplusUw\Year;

use App\Repositories\MvAgen\MvAgenRepository;
use LaravelEasyRepository\Service;
use App\Repositories\SurplusUwYear\SurplusUwYearRepository;
use Illuminate\Support\Facades\DB;

class YearServiceImplement extends Service implements YearService
{
  public function __construct(MvAgenRepository $mvAgenRepository)
  {
    $this->mvAgenRepository = $mvAgenRepository;
  }

  public function getFilterProdDateTime($query = [])
  {
    $builder = $this->builder();
    $builder->addSelect(DB::raw("
    A.PRODDATETIME as PRODDATETIME"));
    $builder->groupBy(
      DB::raw('A.PRODDATETIME'),
    );
    $builder->orderBy('PRODDATETIME', 'desc');
    return $builder->get()->toArray();
  }
  public function getFilterBusiness($query = [])
  {
    $builder = $this->builder();
    $builder->addSelect(DB::raw("
    LB.LBU_NOTE as BUSINESS"));
    $builder->groupBy(
      DB::raw('LB.LBU_NOTE'),
    );
    $builder->orderBy('BUSINESS', 'asc');
    return $builder->get()->toArray();
  }
  public function getFilterCabang($query = [])
  {
    $builder = $this->builder();
    $builder->addSelect(DB::raw("
    LC.CABANG as CABANG"));
    $builder->groupBy(
      DB::raw('LC.CABANG'),
    );
    $builder->orderBy('CABANG', 'asc');
    return $builder->get()->toArray();
  }
  public function getFilterClientName($query = [])
  {
    $builder = $this->builder();
    $builder->addSelect(DB::raw("
    MC.MCL_NAME as CLIENT_NAME"));
    $builder->groupBy(
      DB::raw('MC.MCL_NAME'),
    );
    $builder->orderBy('CLIENT_NAME', 'asc');
    return $builder->get()->toArray();
  }
  public function getFilterNoCif($query = [])
  {
    $builder = $this->builder();
    $builder->addSelect(DB::raw("
    A.NO_CIF as NO_CIF"));
    $builder->groupBy(
      DB::raw('A.NO_CIF'),
    );
    $builder->orderBy('NO_CIF', 'asc');
    return $builder->get()->toArray();
  }
  public function getFilterNoPolis($query = [])
  {
    $builder = $this->builder();
    $builder->addSelect(DB::raw("
    A.NO_POLIS as NO_POLIS"));
    $builder->groupBy(
      DB::raw('A.NO_POLIS'),
    );
    $builder->orderBy('NO_POLIS', 'asc');
    return $builder->get()->toArray();
  }


  public function getDataset($query = [])
  {

    if (isset($query['FILTER']) && count($query) == 1)
    {
      return collect();
    }

    $columns = array(
      "SOURCE_DATA"                   => "SOURCE_DATA",
      "PRODDATETIME"                  => "A.PRODDATETIME",
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
      "CLIENT_NAME"                   => "mc.mcl_name",
      "NO_POLIS"                      => "A.NO_POLIS ",
      "NO_CIF"                        => "A.NO_CIF",
      "JENIS_PAKET"                   => "A.MSP_JN_PAKET",
      "KETERANGAN"                    => "JN_COAS.KETERANGAN",
      "NAMA_CEDING"                   => "A.NAMA_CEDING",
      "OKUPASI"                       => "OKUPASI",
      "NAMA_DEALER"                   => "A.NAMA_DEALER",
      "TSI"                           => "A.TSI",
      "GROSS_PREMIUM_WRITTEN"         => "A.GPW",
      "DISC"                          => "A.DISC",
      "DISC2"                         => "A.DISC2",
      "COMM"                          => "A.COMM",
      "OC"                            => "A.OC",
      "NETTO_GROSS_WRITTEN_PREMIUM"   => "A.GPW+A.DISC+A.DISC2+A.COMM+A.OC",
      "BIAYA_KANTOR_PUSAT"            => "A.BIAYA_KANTOR_PUSAT",
      "REINSURANCE"                   => "A.RI",
      "RICOM"                         => "A.RICOM",
      "NETTO_WRITTEN_PREMIUM"         => "A.GPW+A.DISC+A.DISC2+A.COMM+A.OC+A.RI+A.RICOM + A.BIAYA_KANTOR_PUSAT",
      "CADANGAN_PREMI_TAHUN_LALU"     => "A.CADPREMI",
      "CADANGAN_PREMI_TAHUN_BERJALAN" => "A.CADPREMI1",
      "PREMIUM_RESERVE"               => "A.PREMIUM_RESERVE",
      "NET_PREMIUM_EARNED"            => "A.GPW+A.DISC+A.DISC2+A.COMM+A.OC+A.RI+A.RICOM+A.PREMIUM_RESERVE+ A.BIAYA_KANTOR_PUSAT",
      "ACCEPTED_CLAIM"                => "A.ACCEPTEDCLAIM",
      "REJECT_CLAIM"                  => "A.REJECTCLAIM",
      "OUTSTANDING_CLAIM"             => "A.OUTSTANDINGCLAIM",
      "REVERSED_CLAIM"                => "A.REVERSEDCLAIM",
      "SURPLUS_DEFICIT_UW"            => "A.GPW+A.DISC+A.DISC2+A.COMM+A.OC+A.RI+A.RICOM+A.PREMIUM_RESERVE - (A.ACCEPTEDCLAIM+A.REJECTCLAIM+A.REVERSEDCLAIM+A.OUTSTANDINGCLAIM) + A.BIAYA_KANTOR_PUSAT",
    );


    $builder = $this->builder();

    foreach ($columns as $alias => $column)
    {
      $builder->addSelect(DB::raw($column . " AS " . "[$alias]"));
    }

    if (isset($query['filterProdDateTime']))
    {
      $builder->where(DB::raw("A.PRODDATETIME"), "=", "$query[filterProdDateTime]");
    }

    if (isset($query['filterCabang']))
    {
      $builder->where("MC.MCL_NAME", "=", "$query[filterCabang]");
    }
    
    if (isset($query['filterBusiness']))
    {
      $builder->where("LB.LBU_NOTE", "=", "$query[filterBusiness]");
    }
    
    if (isset($query['filterClientName']))
    {
      $builder->where("MC.MCL_NAME", "=", "$query[filterClientName]");
    }

    if (isset($query['filterNoCif']))
    {
      $builder->where("A.NO_CIF", "=", "$query[filterNoCif]");
    }

    if (isset($query['filterNoPolis']))
    {
      $builder->where("A.NO_POLIS", "=", "$query[filterNoPolis]");
    }

    $dataset = $builder->limit(2000)->get();

    return $dataset;
  }


  public function builder()
  {
    $builder = DB::table("Warehouse_Asm_SPK.dbo.prodclaimuwmththn_GABUNGAN_view AS A");

    $builder->join("Warehouse_Asm_SPK.dbo.MV_AGEN AS MA", "A.LAG_ID", "=", "MA.LAG_AGEN_ID");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_CABANG AS LC", "A.LDC_ID", "=", "LC.LDC_ID");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_BUSINESS AS LB", "A.LBU_ID", "=", "LB.LBU_ID");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_GRP_BUSINESS AS LGB", "LB.LGB_ID", "=", "LGB.LGB_ID");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_MO AS MO", "A.LMO_ID", "=", "MO.LMO_ID", "LEFT OUTER");
    $builder->join("Warehouse_Asm_SPK.dbo.MST_CLIENT AS MC", "A.CLIENT_ID", "=", "MC.MCL_ID", "LEFT OUTER");
    $builder->join("Warehouse_Asm_SPK.dbo.LST_JENIS_COAS AS JN_COAS", "A.MDS_JN_COAS", "=", "JN_COAS.MDS_JN_COAS", "LEFT OUTER");
    $builder->limit(2000);
    return $builder;
  }
}
