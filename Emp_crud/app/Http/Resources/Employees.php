<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Employees extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'emp_id' => $this->emp_id,
            'user' => $this->user,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname,
            'dob' => $this->dob,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'address' => $this->address,
            'state' => $this->state,
            'city' => $this->city,
            'image' => $this->image,
            'file' => $this->file,
            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),

        ];
    }
}
