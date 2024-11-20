<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientRegistryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return
        [ 'id'=> $this->id,
         'name'=> $this->name,
         'date_of_birth'=> $this->date_of_birth,
         'national_id'=> $this->national_id,
        'address'=>$this->address_id,
        ];
    }
}
