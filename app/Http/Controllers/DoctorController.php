<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Mail\SelectedDoctor;
use Mail;

class DoctorController extends Controller
{
    /**
     * @index
     *
     *  Show all doctor list
     * @return void
     */
    public function index()
    {
        $doctors = Doctor::get();
        return view('Doctor.index', compact('doctors'));
    }

    /**
     * store
     *
     *  save data and send mail to the doctor
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $doctorEmails = explode(',', $request->doctor_email);
        foreach ($doctorEmails as $doctorEmail) {
            Mail::to($doctorEmail)->send(new SelectedDoctor($request));
        }
        return redirect()->back()->with('success', ' Email send all selected doctor successfully  !!');
    }
}
