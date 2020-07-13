<?php

namespace App\Http\Controllers;

use App\Donation;
use App\Patient;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    //
    public function getDonations(){
        $nombrePagina= 'Pacientes';
        $donations = Donation::get();
    
        return view('donations.donations', compact('donations','nombrePagina'));
    }

    public function patientDonate($patient_id){
        $patient = Patient::findOrFail($patient_id);
        
        $newDonator= new Donation;
        $newDonator->dni=$patient->dni;
        $newDonator->surname= $patient->surname;
        $newDonator->name= $patient->name;
        $newDonator->age=$patient->age;
        $newDonator->save();

        return redirect()->route('patients')->with('info','Donacion exitosa');
    }
}
