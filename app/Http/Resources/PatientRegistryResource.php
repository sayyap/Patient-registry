<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientRegistryResource extends JsonResource
{
    // private mixed $id;
    // private mixed $name;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'date_of_birth' => $this->date_of_birth,
            'national_id' => $this->national_id,
            'address' => [
                'island_id' => $this->address->island_id,
                'street' => $this->address->street,
                'city' => $this->address->city,
                'house_name' => $this->address->house_name,
            ],
        ];
    }
}
