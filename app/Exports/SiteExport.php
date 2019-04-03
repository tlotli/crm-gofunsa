<?php

namespace GoFunCrm\Exports;

use GoFunCrm\Site;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class SiteExport implements FromCollection , WithHeadings , ShouldAutoSize, WithEvents
{
	use Exportable;
	protected $id;

    /**
    * @return \Illuminate\Support\Collection
    */

	public function __construct( $id)
	{
		$this->id = $id;
	}


    public function collection()
    {
    	$franchise_id = $this->id ;

    	$sites = DB::table('franchises')
		         ->join('sites' ,'sites.franchise_id' , '=' , 'franchises.id')
		         ->where('franchises.id' , $franchise_id)
		         ->select( 'sites.id' , 'sites.name'  )
		         ->get();
        return $sites;
    }

    public function headings(): array {
	    // TODO: Implement headings() method.
	    return [
		    'Id',
		    'Site Name',
		    'Quantity Sold',
		    'Date',
	    ];
    }

	public function registerEvents(): array
	{
		return [
			AfterSheet::class    => function(AfterSheet $event) {
				$cellRange = 'A1:W1'; // All headers
				$event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
			},
		];
	}


//	public function query()
//	{
//		$franchise_id = $this->id ;
//
//		$sites = DB::table('franchises')
//		           ->join('sites' ,'sites.franchise_id' , '=' , 'franchises.id')
//		           ->where('franchises.id' , $franchise_id)
//		           ->select( 'sites.id' , 'sites.name'  )
//		           ->query();
//		return $sites;
//	}

}
