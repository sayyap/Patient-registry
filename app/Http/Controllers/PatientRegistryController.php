<?php

namespace App\Http\Controllers;

use App\Http\Resources\PatientRegistryResource;
use App\Models\PatientRegistry;
use App\Models\Address; // Import the Address model
use Illuminate\Http\Request;

class PatientRegistryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = PatientRegistry::all();
        return PatientRegistryResource::collection($patients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message' => 'Create new patient form']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'national_id' => 'required|string|max:50|unique:patients',
            'address' => 'required|array', // Address is an array
            'address.island_id' => 'required|string|max:50',
            'address.street' => 'required|string|max:255',
            'address.city' => 'required|string|max:255',
            'address.house_name' => 'required|string|max:255',
        ]);


        $address = Address::create([
            'island_id' => $validatedData['address']['island_id'],
            'street' => $validatedData['address']['street'],
            'city' => $validatedData['address']['city'],
            'house_name' => $validatedData['address']['house_name'],
        ]);


        $patient = PatientRegistry::create([
            'name' => $validatedData['name'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'national_id' => $validatedData['national_id'],
            'address_id' => $address->id,  // Store the Address ID
        ]);


        return new PatientRegistryResource($patient);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $patient = PatientRegistry::findOrFail($id);


        return new PatientRegistryResource($patient);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $patient = PatientRegistry::findOrFail($id);
        return response()->json($patient);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'date_of_birth' => 'sometimes|required|date',
            'national_id' => 'sometimes|required|string|max:50|unique:patients,national_id,' . $id,
            'address' => 'sometimes|required|array',
            'address.island_id' => 'sometimes|required|string|max:50',
            'address.street' => 'sometimes|required|string|max:255',
            'address.city' => 'sometimes|required|string|max:255',
            'address.house_name' => 'sometimes|required|string|max:255',
        ]);


        $patient = PatientRegistry::findOrFail($id);


        if (isset($validatedData['name'])) {
            $patient->name = $validatedData['name'];
        }
        if (isset($validatedData['date_of_birth'])) {
            $patient->date_of_birth = $validatedData['date_of_birth'];
        }
        if (isset($validatedData['national_id'])) {
            $patient->national_id = $validatedData['national_id'];
        }


        if (isset($validatedData['address'])) {
            // Find the existing address or create a new one
            $address = $patient->address ?? new Address;
            $address->fill($validatedData['address']);
            $address->save();


            $patient->address_id = $address->id;
        }


        $patient->save();


        return new PatientRegistryResource($patient);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $patient = PatientRegistry::findOrFail($id);


        if ($patient->address) {
            $patient->address->delete();
        }


        $patient->delete();


        return response()->json(['message' => 'Patient and associated address deleted successfully']);
    }
}
