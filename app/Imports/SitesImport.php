<?php

namespace GoFunCrm\Imports;

use GoFunCrm\Site;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Geocoder\Facades\Geocoder;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class SitesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

//		HeadingRowFormatter::default('none');

    public function model(array $row)
    {

        return new Site([

			$address = Geocoder::getCoordinatesForAddress($row['physical_address']),

	        'address' => $row['physical_address'],
	        'name' => $row['site_name'],
	        'city' => $row['town_city'],
	        'province' => $row['province'],
	        'surburb' => $row['suburb'],
	        'landline' => $row['land_line_no'],
	        'cellphone' => $row['cell_number'],
	        'email_1' => $row['e_mail_address_1'],
	        'email_2' => $row['e_mail_address_2'],
	        'retail_group_bc' => $row['retail_group_bc'],
	        'gofun_bc' => $row['gofun_bc'],
	        'retailer' => $row['retailer1'],
	        'retailer_contact_no' => $row['retailer_contact_no'],
	        'manager_1' => $row['manager1'],
	        'manager_2' => $row['manager2'],
	        'alternative' => $row['alternative'],
	        'franchise_id' => $row['franchise_id'],
	        'on_board' => $row['on_board'],
//	        'retailer_name' => $row['ALTERNATIVE '],
	        'notes' => $row['notes'],
	        'user_id' => Auth::id() ,
	        'address_latitude' => $address['lat'] ,
	        'address_longitude' => $address['lng'] ,
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
