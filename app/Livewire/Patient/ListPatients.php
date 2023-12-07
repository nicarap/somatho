<?php

namespace App\Livewire\Patient;

use Livewire\Component;
use App\Models\User;

class ListPatients extends Component
{
    public $patients;

    public function mount($patients)
    {
        $this->patients = $patients;
    }

    public function showPatient(User $patient)
    {
        dd("test");
        return redirect(route('filament.admin.resources.patients.edit', ["record" => $patient]));
    }

    public function render()
    {
        return view('livewire.patient.list-patients');
    }
}
