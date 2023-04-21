<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZoneRate;
use App\Models\ShippingZone;

class ShipmentController extends Controller
{
    public function ZoneIndex()
    {
        $zones = ShippingZone::get();
        $data['FEDEX'] = $zones->whereNotNull('fedex_zone')->count();
        $data['DHL'] = $zones->whereNotNull('dhl_zone')->count();
        $data['UPS'] = $zones->whereNotNull('ups_zone')->count();
        $data['ARAMEX'] = $zones->whereNotNull('aramex_zone')->count();
        $data['DPD'] = $zones->whereNotNull('dpd_zone')->count();
        return view('shipment.zone.index', compact('data'));
    }
    public function CarrierZone($carrierType)
    {
        $zones = ZoneRate::where('carrier_type', $carrierType)->get();
        $data = [];
        foreach ($zones as $value) {
            $id = ['id' => $value->id];
            $weight = ['weight' => $value->weight];
            $carrierType = ['carrier_type' => $value->carrier_type];
            $zone = json_decode($value->rate, true);
            $data[] = array_merge($id, $weight, $carrierType, $zone);
        }
        if (empty($zone)) {
            $zone = [];
        }
        $zone = array_keys($zone);
        return view('shipment.zone.zone_carrier', compact('data', 'zone'));
    }
    public function ZoneEdit($id)
    {
        $zone = ZoneRate::find($id);
        $carrierType = ['carrier_type' => $zone->carrier_type];
        $weight = ['weight' => $zone->weight];
        $zone = json_decode($zone->rate, true);
        $data[] = array_merge($weight, $carrierType, $zone);
        return view('shipment.zone.edit', compact('data'));
    }
    public function ZoneUpdate(Request $request)
    {
        $data = $request->all();
        $update = ZoneRate::where('id', $request->id)->first();
        $update->weight = $request->weight;
        unset($data['_token'], $data['id'], $data['carrier_type'], $data['weight']);
        $update->rate = json_encode($data);
        $update->save();
        return redirect()->route('zone.index')->with('success', 'Zone rates updated successfully');
    }
    public function ImportRates()
    {
        return view('shipment.zone.import');
    }
    public function DoImportRates(Request $request)
    {
        $file = $request->file('csv-file');
        $filename = $file->getClientOriginalName();
        $location = 'uploads';
        $file->move($location, $filename);
        $filepath = public_path($location . "/" . $filename);
        $file = fopen($filepath, "r");

        $arr = $this->csvToArray($filepath);

        for ($i = 0; $i < count($arr); $i++) {
            $weight = $arr[$i]['Weight'];
            unset($arr[$i]['Weight']);
            $Edata = json_encode($arr[$i]);
            ZoneRate::updateOrCreate(
                ['weight' => $weight, 'carrier_type' => $request->carrier],
                ['rate' => $Edata]
            );
        }
        return redirect()->route('zone.index')->with('success', 'Zone rates updated successfully');
    }
    public function ExportRates()
    {
        $index = ZoneRate::get();
        $data = [];
        $columns = [];
        foreach ($index as $value) {
            $weight = ['weight' => $value->weight];
            $carrierType = ['carrier_type' => $value->carrier_type];
            $zone = json_decode($value->rate, true);
            $data[] = array_merge($weight, $carrierType, $zone);
            $columns = array_keys($zone);
        }
        array_unshift($columns, 'carrier_type');
        array_unshift($columns, 'weight');
        // dd($columns);
        $headers = array(
            'Content-Type' => 'text/csv'
        );

        $filename = public_path("uploads/download.csv");
        $handle = fopen($filename, 'w');
        fputcsv($handle, $columns);

        foreach ($data as $obj) {
            $row = [];
            $row['weight'] = $obj['weight'];
            $row['carrier_type'] = $obj['carrier_type'];
            foreach ($columns as $value) {
                $row[$value] = $obj[$value];
            }
            fputcsv($handle, $row);
        }
        fclose($handle);

        return \Response::download($filename, "download.csv", $headers);
    }
    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            fseek($handle, 3);
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }
}