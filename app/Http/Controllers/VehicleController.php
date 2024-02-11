<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Driver;
use App\Models\log;
use App\Models\Type;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::select("vehicles.*",
            "types.type_desc",
            "categories.category_desc",
            "statuses.status_desc",
            "drivers.*",
        )
            ->leftjoin('types', 'vehicles.type_id', '=', 'types.type_id')
            ->leftjoin('categories', 'vehicles.category_id', '=', 'categories.category_id')
            ->leftjoin('statuses', 'vehicles.status_id', '=', 'statuses.status_id')
            ->leftjoin("drivers", "vehicles.driver_id", "=", "drivers.driver_id")
            ->distinct('vehicle_id')
            ->orderBy('vehicles.vehicle_id', 'desc')
            ->get();

        // change $vehicles to array of objects wich have logs and drivers more than one
        $vehicles = $vehicles->map(function ($vehicle) {
            $vehicle->logs = Log::where('vehicle_id', $vehicle->vehicle_id)
                ->orderBy('log_id', 'desc')
                ->first();
            return $vehicle;
        });

        $types = Type::all();
        $categories = Category::all();
        $drivers = Driver::all();
        $user = session()->get('user');

        return view('pages/vehicle', compact(
            'vehicles',
            'types',
            'categories',
            "drivers",
            'user'
        ));
    }

    public function store()
    {
        $data = request()->validate([
            'vehicle_name' => 'required',
            'vehicle_vin' => 'required',
            'vehicle_picture' => 'required|image',
            'vehicle_year' => 'required|numeric|regex:/^[0-9]{4}$/',
            'vehicle_price' => 'required|numeric|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
            'vehicle_fuel' => 'required',
            'type_id' => 'required',
            'category_id' => 'required',
            'log_desc' => 'required',
            "driver_id" => "required",
        ]);

        $imagePath = request('vehicle_picture')->store('images', 'public');
        $fileName = explode('/', $imagePath)[1];

        $v = Vehicle::create([
            'vehicle_name' => $data['vehicle_name'],
            'vehicle_picture' => $fileName,
            'vehicle_vin' => $data['vehicle_vin'],
            'vehicle_year' => $data['vehicle_year'],
            'vehicle_price' => $data['vehicle_price'],
            'vehicle_fuel' => $data['vehicle_fuel'],
            'type_id' => $data['type_id'],
            'status_id' => 1,
            'category_id' => $data['category_id'],
            'driver_id' => $data['driver_id'],
        ]);

        $l = Log::create([
            'vehicle_id' => $v->vehicle_id,
            'log_desc' => $data['log_desc'],
        ]);

        return back()->with('vehicle.store.success', 'Vehicle added successfully');
    }

    public function update($vId)
    {

        $data = request()->validate([
            'vehicle_name' => 'required',
            'vehicle_vin' => 'required',
            'vehicle_picture' => 'image',
            'vehicle_year' => 'required|numeric|regex:/^[0-9]{4}$/',
            'vehicle_price' => 'required|numeric|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
            'vehicle_fuel' => 'required',
            'type_id' => 'required',
            'category_id' => 'required',
            'log_desc' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            "driver_id" => "required",
        ]);

        $v = Vehicle::select("vehicles.*",
            "types.type_desc",
            "categories.category_desc",
            "statuses.status_desc",
            "drivers.*",
            "logs.log_id",
            "logs.log_desc",
        )
            ->leftjoin('types', 'vehicles.type_id', '=', 'types.type_id')
            ->leftjoin('categories', 'vehicles.category_id', '=', 'categories.category_id')
            ->leftjoin('statuses', 'vehicles.status_id', '=', 'statuses.status_id')
            ->leftjoin("drivers", "vehicles.driver_id", "=", "drivers.driver_id")
            ->leftjoin("logs", "vehicles.vehicle_id", "=", "logs.vehicle_id")
            ->distinct('vehicle_id')
            ->orderBy('vehicles.vehicle_id', 'desc')
            ->where('vehicles.vehicle_id', $vId)
            ->first();

        // if there is a new image
        if (request('vehicle_picture')) {
            $imagePath = request('vehicle_picture')->store('images', 'public');
            $fileName = explode('/', $imagePath)[1];

            // update the vehicle with the new image
            $v->update([
                'vehicle_name' => $data['vehicle_name'],
                'vehicle_picture' => $fileName,
                'vehicle_vin' => $data['vehicle_vin'],
                'vehicle_year' => $data['vehicle_year'],
                'vehicle_price' => $data['vehicle_price'],
                'vehicle_fuel' => $data['vehicle_fuel'],
                'type_id' => $data['type_id'],
                'category_id' => $data['category_id'],
                'driver_id' => $data['driver_id'],
            ]);

            if ($v->logs) {
                $v->logs->update([
                    'log_desc' => $data['log_desc'],
                ]);
            } else {
                $l = Log::create([
                    'vehicle_id' => $v->vehicle_id,
                    'log_desc' => $data['log_desc'],
                ]);
            }

        } else {
            // update the vehicle with the old image
            $v->update([
                'vehicle_name' => $data['vehicle_name'],
                'vehicle_vin' => $data['vehicle_vin'],
                'vehicle_year' => $data['vehicle_year'],
                'vehicle_price' => $data['vehicle_price'],
                'vehicle_fuel' => $data['vehicle_fuel'],
                'type_id' => $data['type_id'],
                'status_id' => 1,
                'category_id' => $data['category_id'],
                'driver_id' => $data['driver_id'],
            ]);

            if ($v->logs) {
                $v->logs->update([
                    'log_desc' => $data['log_desc'],
                ]);
            } else {
                $l = Log::create([
                    'vehicle_id' => $v->vehicle_id,
                    'log_desc' => $data['log_desc'],
                ]);
            }

        }

        return back()->with('vehicle.update.success', 'Vehicle updated successfully');

    }

    public function destroy($vId)
    {
        $v = Vehicle::where('vehicle_id', $vId)->first();

        //  delete the vehicle image
        $imagePath = public_path('storage/images/' . $v->vehicle_picture);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $v->delete();

        // delete the vehicle logs
        Log::where('vehicle_id', $vId)->delete();

        return back()->with('vehicle.destroy.success', 'Vehicle deleted successfully');

    }

    public function approval($vId)
    {
        $data = request()->validate([
            'status_id' => 'required',
        ]);

        $v = Vehicle::where('vehicle_id', $vId)->first();

        $user = session()->get('user');

        if (!$user) {
            return back()->with('vehicle.approval.error', 'You are not authorized to approve vehicles');
        }

        if ($v->status_id != 3 && $v->status_id != 4 && $v->status_id == 1) {
            if ($user["role_id"] == 2) {
                if ($data["status_id"] == 1) {
                    $v->update([
                        'status_id' => 2,
                    ]);
                    return back()->with('vehicle.approval.success', 'Vehicle approval successfully');
                } else {
                    $v->update([
                        'status_id' => 4,
                    ]);
                    return back()->with('vehicle.approval.success', 'Vehicle approval successfully');
                }
            } else {
                return back()->with('vehicle.approval.error', 'You are not authorized to approve vehicles');
            }
        } else {
            if ($user["role_id"] == 3) {
                if ($data["status_id"] == 1) {
                    $v->update([
                        'status_id' => 3,
                    ]);
                    return back()->with('vehicle.approval.success', 'Vehicle approval successfully');
                } else {
                    $v->update([
                        'status_id' => 4,
                    ]);
                    return back()->with('vehicle.approval.success', 'Vehicle approval successfully');
                }
            } else {
                return back()->with('vehicle.approval.error', 'You are not authorized to approve vehicles');
            }
        }

    }
}