<?php

namespace GoFunCrm\Imports;

use GoFunCrm\QuantitySold;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuantitySoldImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

//	    dd($row) ;

        return new QuantitySold([
	        'site_id' => $row['id'],
	        'site_name' => $row['site_name'],
	        'quantity_sold' => $row['quantity_sold'],
	        'date_captured' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date']),
	        'captured_by' => Auth::id(),
        ]);
    }

	public function batchSize(): int
	{
		return 1000;
	}

	public function chunkSize(): int
	{
		return 1000;
	}

}
