<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function hospitalAll()
    {
        $hospitalNames = User::pluck('hospital_name');
        $doctorDepartment = Doctor::distinct()->pluck('deparment_category')->toArray();
        return response()->json([
            'hospitalNames' => $hospitalNames,
            'doctorDepartments' => $doctorDepartment,
        ], 200);
    }
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $doctor = Doctor::where('user_id', $user->id)
            ->with('user')
            ->get();

        return response()->json($doctor, 200);
    }


    public function activeDoctor()
    {
        $user = Auth::user();
        if ($user) {
            $doctor = Doctor::where('user_id', $user->id)->where('status', 1)->get();
            return response()->json($doctor, 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function dactiveDoctor()
    {
        $user = Auth::user();
        if ($user) {
            $doctor = Doctor::where('user_id', $user->id)->where('status', 0)->get();
            return response()->json($doctor, 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function store(Request $request)
    {

        $user = Auth::user();

        // return response()->json($request->all());
        // $request->validate([
        //     'deparment_category' => 'required|string|max:255',
        //     'regnum' => 'required|string|max:255',
        //     'doctorName' => 'required|string|max:255',
        //     'email' => 'nullable|email|max:255',
        //     'age' => 'nullable|string',
        //     'gender' => 'required|string|in:male,female,other',
        //     'details' => 'nullable|string',
        //     'experience' => 'nullable|string',
        //     'rows' => 'nullable|array',
        //     'selects' => 'nullable|array',
        //     'symptom' => 'nullable|string',
        //     'mobile' => 'required|string|max:15',
        //     'mobile_optional' => 'nullable|string|max:15',
        //     'visitfee' => 'required|string|min:0',
        //     'second_day' => 'nullable|string',
        //     'second_dayFee' => 'nullable|string',
        //     'thired_day' => 'nullable|string',
        //     'thired_dayFee' => 'nullable|string',
        //     'payment_type' => 'nullable|string|max:255',
        //     'room_number' => 'nullable|string|max:255',
        //     'appoinment_mobile' => 'nullable|string|max:15',
        //     'appoinment_mobileOptional' => 'nullable|string|max:15',
        //     'doctor_image' => 'nullable|string',
        //     'signature_image' => 'nullable|string',
        //     'prescription_signature_style' => 'nullable|string',
        // ]);

        if ($user) {
            $doctor_imageName = '';
            $imageURL = '';
            if ($request->doctor_image) {
                $position = strpos($request->doctor_image, ';');
                $sub = substr($request->doctor_image, 0, $position);
                $ext = explode('/', $sub)[1];
                $doctor_imageName = rand(1, 1000) . '_' . $request->doctorName . '.' . $ext;
                $image = str_replace('data:image/' . $ext . ';base64,', '', $request->doctor_image);
                $image = str_replace(' ', '+', $image);

                $imagePath = public_path('backend/images/doctor_image/' . $doctor_imageName);
                if (!File::isDirectory(public_path('backend/images/doctor_image'))) {
                    File::makeDirectory(public_path('backend/images/doctor_image'), 0755, true, true);
                }
                File::put($imagePath, base64_decode($image));
                $imageURL = url('backend/images/doctor_image/' . $doctor_imageName);
            }


            $doctor_signatureImageName = '';
            $doctor_signatureImageURL = '';

            if ($request->signature_image) {
                $position = strpos($request->signature_image, ';');
                $sub = substr($request->signature_image, 0, $position);
                $ext = explode('/', $sub)[1];
                $doctor_signatureImageName = rand(1, 1000) . '_' . $request->doctorName . '.' . $ext;
                $image = str_replace('data:image/' . $ext . ';base64,', '', $request->signature_image);
                $image = str_replace(' ', '+', $image);

                $imagePath = public_path('backend/images/doctor_signatureimage/' . $doctor_signatureImageName);
                if (!File::isDirectory(public_path('backend/images/doctor_signatureimage'))) {
                    File::makeDirectory(public_path('backend/images/doctor_signatureimage'), 0755, true, true);
                }
                File::put($imagePath, base64_decode($image));
                $doctor_signatureImageURL = url('backend/images/doctor_signatureimage/' . $doctor_signatureImageName);
            }

            $schedule = json_encode($request->rows);
            $specialist = json_encode($request->selects);

            $doctor = Doctor::create([
                'deparment_category' => $request->deparment_category,
                'regnum' => $request->regnum,
                'password' => Hash::make('12345'),
                'doctorName' => $request->doctorName,
                'email' => $request->email,
                'age' => $request->age,
                'gender' => $request->gender,
                'details' => $request->details,
                'experience' => $request->experience,
                'Specialist' => $request->selects,
                'Shedule' => $schedule,
                'symptom' => $request->symptom,
                'mobile' => $request->mobile,
                'mobile_optional' => $request->mobile_optional,
                'visitfee' => $request->visitfee,
                'second_day' => $request->second_day,
                'second_dayFee' => $request->second_dayFee,
                'thired_day' => $request->thired_day,
                'thired_dayFee' => $request->thired_dayFee,
                'payment_type' => $request->payment_type,
                'room_number' => $request->room_number,
                'appoinment_mobile' => $request->appoinment_mobile,
                'appoinment_mobileOptional' => $request->appoinment_mobileOptional,
                'doctor_image' => $imageURL,
                'signature_image' => $doctor_signatureImageURL,
                'prescription_signature_style' => $request->prescription_signature_style,
                'user_id' => $user->id,
            ]);
            return response()->json(['message' => 'Doctor created successfully', 'doctor' => $doctor], 201);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function changeStatus(Request $request)
    {
        // $request->validate([
        //     'doctorId' => 'required|exists:doctors,id',
        //     'status' => 'required|in:0,1',
        // ]);
        $user = Auth::user();
        if ($user) {
            $doctorId = $request->doctorId;
            $status = $request->status;

            $doctor = Doctor::findOrFail($doctorId);
            $doctor->status = $status;
            $doctor->save();
            return response()->json(['message' => 'Doctor Status updated successfully', 'doctor' => $doctor], 201);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function deleteDoctor(Request $request)
    {
        // $request->validate([
        //     'doctorId' => 'required|exists:doctors,id',
        // ]);
        $user = Auth::user();
        if ($user) {
            $doctorId = $request->doctorId;
            $doctor = Doctor::findOrFail($doctorId);
            $doctor->delete();
            return response()->json([
                'message' => 'Doctor deleted successfully',
                'doctor' => $doctor,
            ], 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function viewDoctor($doctor_id)
    {
        $user = Auth::user();
        if ($user) {
            $doctor = Doctor::find($doctor_id);
            if (!$doctor) {
                return response()->json(['message' => 'Doctor not found'], 404);
            }

            return response()->json(['message' => 'Doctor Data retrive successfully', 'doctor' => $doctor], 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function viewDoctorOffline($doctor_id)
    {
        $doctor = Doctor::find($doctor_id);
        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        return response()->json(['message' => 'Doctor Data retrive successfully', 'doctor' => $doctor], 200);
    }

    public function update(Request $request)
    {
        // return response()->json($request->all());
        // $request->validate([
        //      'doctor_id'=> 'required',
        //     'deparment_category' => 'required|string|max:255',
        //     'regnum' => 'required|string|max:255',
        //     'doctorName' => 'required|string|max:255',
        //     'email' => 'nullable|email|max:255',
        //     'age' => 'nullable|string',
        //     'gender' => 'required|string|in:male,female,other',
        //     'details' => 'nullable|string',
        //     'experience' => 'nullable|string',
        //     'rows' => 'nullable|array',
        //     'selects' => 'nullable|array',
        //     'symptom' => 'nullable|string',
        //     'mobile' => 'required|string|max:15',
        //     'mobile_optional' => 'nullable|string|max:15',
        //     'visitfee' => 'required|string|min:0',
        //     'second_day' => 'nullable|string',
        //     'second_dayFee' => 'nullable|string',
        //     'thired_day' => 'nullable|string',
        //     'thired_dayFee' => 'nullable|string',
        //     'payment_type' => 'nullable|string|max:255',
        //     'room_number' => 'nullable|string|max:255',
        //     'appoinment_mobile' => 'nullable|string|max:15',
        //     'appoinment_mobileOptional' => 'nullable|string|max:15',
        //     'doctor_image' => 'nullable|string',
        //     'signature_image' => 'nullable|string',
        //     'prescription_signature_style' => 'nullable|string',
        // ]);
        $user = Auth::user();
        if ($user) {
            $doctor_id = $request->doctor_id;
            $doctor = Doctor::findOrFail($doctor_id);

            $doctor_imageName = '';
            $imageURL = '';
            if ($request->doctor_image) {

                $imagePath = public_path('backend/images/doctor_image/' . $doctor->doctor_image);
                if ($doctor->doctor_image && file_exists($imagePath)) {
                    unlink($imagePath);
                }

                $position = strpos($request->doctor_image, ';');
                $sub = substr($request->doctor_image, 0, $position);
                $ext = explode('/', $sub)[1];
                $doctor_imageName = rand(1, 1000) . '_' . $request->doctorName . '.' . $ext;
                $image = str_replace('data:image/' . $ext . ';base64,', '', $request->doctor_image);
                $image = str_replace(' ', '+', $image);

                $imagePath = public_path('backend/images/doctor_image/' . $doctor_imageName);
                if (!File::isDirectory(public_path('backend/images/doctor_image'))) {
                    File::makeDirectory(public_path('backend/images/doctor_image'), 0755, true, true);
                }
                File::put($imagePath, base64_decode($image));
                $imageURL = url('backend/images/doctor_image/' . $doctor_imageName);
            }


            $doctor_signatureImageName = '';
            $doctor_signatureImageURL = '';

            if ($request->signature_image) {
                $imagePath = public_path('backend/images/doctor_signatureimage/' . $doctor->signature_image);
                if ($doctor->signature_image && file_exists($imagePath)) {
                    unlink($imagePath);
                }

                $position = strpos($request->signature_image, ';');
                $sub = substr($request->signature_image, 0, $position);
                $ext = explode('/', $sub)[1];
                $doctor_signatureImageName = rand(1, 1000) . '_' . $request->doctorName . '.' . $ext;
                $image = str_replace('data:image/' . $ext . ';base64,', '', $request->signature_image);
                $image = str_replace(' ', '+', $image);

                $imagePath = public_path('backend/images/doctor_signatureimage/' . $doctor_signatureImageName);
                if (!File::isDirectory(public_path('backend/images/doctor_signatureimage'))) {
                    File::makeDirectory(public_path('backend/images/doctor_signatureimage'), 0755, true, true);
                }
                File::put($imagePath, base64_decode($image));
                $doctor_signatureImageURL = url('backend/images/doctor_signatureimage/' . $doctor_signatureImageName);
            }

            $schedule = json_encode($request->rows);
            $specialist = json_encode($request->selects);
            $doctor->update([
                'deparment_category' => $request->deparment_category,
                'regnum' => $request->regnum,
                'doctorName' => $request->doctorName,
                'email' => $request->email,
                'age' => $request->age,
                'gender' => $request->gender,
                'details' => $request->details,
                'experience' => $request->experience,
                'Specialist' => $request->selects,
                'Shedule' => $schedule,
                'symptom' => $request->symptom,
                'mobile' => $request->mobile,
                'mobile_optional' => $request->mobile_optional,
                'visitfee' => $request->visitfee,
                'second_day' => $request->second_day,
                'second_dayFee' => $request->second_dayFee,
                'thired_day' => $request->thired_day,
                'thired_dayFee' => $request->thired_dayFee,
                'payment_type' => $request->payment_type,
                'room_number' => $request->room_number,
                'appoinment_mobile' => $request->appoinment_mobile,
                'appoinment_mobileOptional' => $request->appoinment_mobileOptional,
                'doctor_image' => $imageURL,
                'signature_image' => $doctor_signatureImageURL,
                'prescription_signature_style' => $request->prescription_signature_style,
            ]);

            return response()->json(['message' => 'Doctor updated successfully'], 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function DoctorAppoinmentPatient(Request $request)
    {
        $doctor = Auth::guard('doctor_api')->user();
        if (!$doctor) {
            return response()->json(['error' => 'Unauthorized – doctor access only'], 401);
        }

        $query = Appointment::with(['user', 'reference'])
            ->where('doctor_id', $doctor->id)
            ->where('status', 0);

        if (!empty($request->email_phone)) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('patient_mobile', 'like', '%' . $request->email_phone . '%');
            });
        }

        if (!empty($request->date)) {
            $query->whereDate('visit_date', $request->date);
        }

        $appointments = $query->get();

        return response()->json($appointments, 200);
    }
    public function DoctorPatientPrescription(Request $request)
    {
        $doctor = Auth::guard('doctor_api')->user();
        if (!$doctor) {
            return response()->json(['error' => 'Unauthorized – doctor access only'], 401);
        }

        $query = Appointment::with(['user', 'reference'])
            ->where('doctor_id', $doctor->id)
            ->where('status', 1);

        if (!empty($request->email_phone)) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('patient_mobile', 'like', '%' . $request->email_phone . '%');
            });
        }

        if (!empty($request->date)) {
            $query->whereDate('visit_date', $request->date);
        }

        $appointments = $query->get();

        return response()->json($appointments, 200);
    }

    // public function prescriptionStore(Request $request)
    // {
    //     return response()->json($request->all());
    //     $request->validate([
    //         'appoint_id' => 'required|exists:appointments,id',
    //         'blood_pressure_up' => 'nullable|string',
    //         'blood_pressure_down' => 'nullable|string',
    //         'medicineArray' => 'required|array',
    //         'medicineArray.*.medicine_name' => 'required|string',
    //         'medicineArray.*.capsul' => 'required|string',
    //         'medicineArray.*.indicate' => 'required|string',
    //         'medicineArray.*.narration' => 'required|string',
    //         'pathologyArray' => 'nullable|array',
    //         'patient_phone'=>'required|exists:appointments,patient_mobile'
    //     ]);
    //     $doctor = Auth::guard('doctor_api')->user();
    //     if (!$doctor) {
    //         return response()->json(['error' => 'Unauthorized – doctor access only'], 401);
    //     }

    //     $prescription = Prescription::create([
    //         'appointment_id' => $request->appoint_id,
    //         'doctor_id' => $doctor->id,
    //         'blood_pressure_up' => $request->blood_pressure_up,
    //         'blood_pressure_down' => $request->blood_pressure_down,
    //         'medicine' => $request->medicineArray,
    //         'pathologies' => $request->pathologyArray ?? [],
    //         'visit_date' => $request->visit_date,
    //         'patient_phone' => $request->patient_phone,

    //     ]);

    //     $appointmentUpdate = Appointment::find($request->appoint_id);
    //     $appointmentUpdate->status = false;
    //     $appointmentUpdate->save();

    //     $prescription->load(['doctor.user', 'appointment']);
    //     return response()->json([
    //         'message' => 'Prescription saved successfully',
    //         'data' => $prescription,
    //     ], 201);
    // }

    public function prescriptionStore(Request $request)
    {
        
        $request->validate([
            'prescriptionId' => $request->has('prescriptionId') ? 'required|exists:prescriptions,id' : 'nullable',
            'appoint_id' => 'required|exists:appointments,id',
            'blood_pressure_up' => 'nullable|string',
            'blood_pressure_down' => 'nullable|string',
            'medicineArray' => 'required|array',
            'medicineArray.*.medicine_name' => 'required|string',
            'medicineArray.*.capsul' => 'required|string',
            'medicineArray.*.indicate' => 'required|string',
            'medicineArray.*.narration' => 'required|string',
            'pathologyArray' => 'nullable|array',
            'patient_phone' => 'required|exists:appointments,patient_mobile'
        ]);

        $doctor = Auth::guard('doctor_api')->user();
        if (!$doctor) {
            return response()->json(['error' => 'Unauthorized – doctor access only'], 401);
        }

        $prescriptionData = [
            'appointment_id' => $request->appoint_id,
            'doctor_id' => $doctor->id,
            'blood_pressure_up' => $request->blood_pressure_up,
            'blood_pressure_down' => $request->blood_pressure_down,
            'medicine' => $request->medicineArray,
            'pathologies' => $request->pathologyArray ?? [],
            'visit_date' => $request->visit_date,
            'patient_phone' => $request->patient_phone,
        ];

        if ($request->filled('prescriptionId')) {
            // Update existing prescription (prescription_id is required here)
            $prescription = Prescription::find($request->prescriptionId);

            if (!$prescription) {
                return response()->json(['error' => 'Prescription not found'], 404);
            }

            $prescription->update($prescriptionData);

            $message = "Prescription updated successfully";
            $statusCode = 200;
        } else {
            $prescription = Prescription::create($prescriptionData);
            $message = "Prescription created successfully";
            $statusCode = 201;

            $appointmentUpdate = Appointment::find($request->appoint_id);

            if ($appointmentUpdate) {
                $appointmentUpdate->status = false;
                $appointmentUpdate->save();
            }
        }

        // Load related data
        $prescription->load(['doctor.user', 'appointment']);

        return response()->json([
            'message' => $message,
            'data' => $prescription,
        ], $statusCode);
    }

    public function prescription()
    {
        $prescriptions = Prescription::with(['doctor.user', 'appointment'])->get(); // removed latest()

        return response()->json($prescriptions, 200);
    }
    public function prescriptionFind(Request $request)
    {
        $patientPhone = $request->phone;
        $doctor = Auth::guard('doctor_api')->user();
        if (!$doctor) {
            return response()->json(['error' => 'Unauthorized – doctor access only'], 401);
        }
        $prescriptions = Prescription::with('appointment')
            ->where('patient_phone', $patientPhone)
            ->get();
        return response()->json($prescriptions, 200);
    }
    public function appoinmentFind(Request $request)
    {
        $patientId = $request->patientId;
        $visitDate = $request->today;
        $doctor = Auth::guard('doctor_api')->user();
        if (!$doctor) {
            return response()->json(['error' => 'Unauthorized – doctor access only'], 401);
        }

        $appointment = Appointment::where('id', $patientId)
            ->whereDate('visit_date', $visitDate)
            ->first();
        if (!$appointment) {
            return response()->json(['message' => 'No appointment found for today'], 404);
        }

        return response()->json($appointment, 200);
    }

    public function prescriptionpatient(Request $request)
    {
        $patientId = $request->id;
        $doctor = Auth::guard('doctor_api')->user();
        if (!$doctor) {
            return response()->json(['error' => 'Unauthorized – doctor access only'], 401);
        }

        $prescription = Prescription::with(['doctor.user', 'appointment'])->find($patientId);
        if (!$prescription) {
            return response()->json(['message' => 'No Prescription for this Patient'], 404);
        }

        return response()->json($prescription, 200);
    }
}
