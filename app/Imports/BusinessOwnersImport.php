<?php

namespace GoFunCrm\Imports;

use GoFunCrm\BusinessOwner;
use Maatwebsite\Excel\Concerns\ToModel;
//use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BusinessOwnersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new BusinessOwner([
        	'name' => $row[0],
	        'slug' => $row[1],
	        'user_id' => $row[2],
	        'email' => $row[3],
	        'contact_number' => $row[4],
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
