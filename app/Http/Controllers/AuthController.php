<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendOtpEmail;
use App\Mail\OtpMail;
use App\Models\Doctor;
use App\Models\OtpVerification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['login', 'signup', 'sendOTP', 'passwordResetOtpCheck', 'resetPassword']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'admin_email' => 'required',
    //         'password' => 'required'
    //     ]);

    //     $credentials = request(['admin_email', 'password']);

    //     if (!$token = auth()->attempt($credentials)) {
    //         return response()->json(['error' => 'Email or password is invalid'], 401);
    //     }
    //     return $this->respondWithToken($token);
    // }
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'admin_email' => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     $credentials = $request->only('admin_email', 'password');

    //     // Try User login
    //     if ($user = User::where('admin_email', $credentials['admin_email'])->first()) {
    //         if (Hash::check($credentials['password'], $user->password)) {
    //             $token = auth('user_api')->login($user);
    //             return $this->respondWithToken($token, 'user');
    //         }
    //     }

    //     // Try Doctor login
    //     if ($doctor = Doctor::where('email', $credentials['admin_email'])->first()) {
    //         if (Hash::check($credentials['password'], $doctor->password)) {
    //             $token = auth('doctor_api')->login($doctor);
    //             return $this->respondWithToken($token, 'doctor');
    //         }
    //     }

    //     return response()->json(['error' => 'Email or password is invalid'], 401);
    // }
    public function login(Request $request)
    {
        $request->validate([
            'admin_email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('admin_email', 'password');

        // Try User login
        if ($user = User::where('admin_email', $credentials['admin_email'])->first()) {
            if (Hash::check($credentials['password'], $user->password)) {
                $token = auth('user_api')->login($user);
                return $this->respondWithToken($token, 'user');
            }
        }

        // Try Doctor login
        if ($doctor = Doctor::where('email', $credentials['admin_email'])->first()) {
            if (Hash::check($credentials['password'], $doctor->password)) {
                $token = auth('doctor_api')->login($doctor);
                return $this->respondWithToken($token, 'doctor');
            }
        }

        return response()->json(['error' => 'Email or password is invalid'], 401);
    }

    // public function sendOTP(Request $request)
    // {

    //     $request->validate([
    //         'admin_email' => 'required|email',
    //     ]);
    //     $otp = rand(100000, 999999);
    //     OtpVerification::updateOrCreate(
    //         ['email' => $request->admin_email],
    //         [
    //             'otp' => $otp,
    //             'expires_at' => null,
    //             'expires_at' => Carbon::now()->addMinutes(2),
    //         ]
    //     );
    //     // SendOtpEmail::dispatch($request->admin_email, $otp);
    //     Mail::to($request->admin_email)->send(new OtpMail($otp, $request->admin_email));
    //     return response()->json([
    //         'message' => 'OTP sent to your email',
    //         'otp' => $otp, // Include the OTP in the response
    //     ], 200);
    // }

    // public function passwordResetOtpCheck(Request $request)
    // {
    //     $request->validate([
    //         'admin_email' => 'required|email',
    //         'otp_check' => 'required'
    //     ]);
    //     $otpVerification = OtpVerification::where('email', $request->admin_email)->first();
    //     if (!$otpVerification) {
    //         return response()->json(['otpMessage' => 'OTP not found'], 404);
    //     }
    //     if (Carbon::now()->greaterThan($otpVerification->expires_at)) {
    //         return response()->json(['otpMessage' => 'OTP has expired'], 400);
    //     }
    //     if ($otpVerification->otp !== $request->otp_check) {
    //         return response()->json(['otpMessage' => 'Invalid OTP'], 400);
    //     } else {
    //         return response()->json(['otpMessage' => 'OTP Check successfully done']);
    //     }
    // }

    // public function resetPassword(Request $request)
    // {
    //     $request->validate([
    //         'admin_email' => 'required|email',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     $user = User::where('admin_email', $request->admin_email)->first();
    //     if (!$user) {
    //         return response()->json(['message' => 'User not found'], 404);
    //     }

    //     $user->password = Hash::make($request->password);
    //     $user->save();

    //     return response()->json(['message' => 'Password updated successfully']);
    // }

    public function sendOTP(Request $request)
    {
        // Validate input
        $request->validate([
            'admin_email' => 'required|email',
        ]);

        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);

        // Store or update OTP with optional expiry (commented if not used)
        OtpVerification::updateOrCreate(
            ['email' => $request->admin_email],
            [
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(5), // You can enable/disable expiry
            ]
        );

        // Send the OTP via email
        Mail::to($request->admin_email)->send(new OtpMail($otp, $request->admin_email));

        return response()->json([
            'message' => 'OTP sent to your email.',
            // 'otp' => $otp, // You can include this for testing; remove in production
        ], 200);
    }

    public function passwordResetOtpCheck(Request $request)
    {
        // Validate input
        $request->validate([
            'admin_email' => 'required|email',
            'otp_check' => 'required'
        ]);
    
        // Retrieve OTP record
        $otpVerification = OtpVerification::where('email', $request->admin_email)->first();
    
        // OTP not found
        if (!$otpVerification) {
            return response()->json(['otpMessage' => 'OTP not found.'], 404);
        }
    
        // Check expiry
        if ($otpVerification->expires_at && Carbon::now()->greaterThan($otpVerification->expires_at)) {
            return response()->json(['otpMessage' => 'OTP has expired.'], 400);
        }
    
        // Check OTP match
        if ($otpVerification->otp !== $request->otp_check) {
            return response()->json(['otpMessage' => 'Invalid OTP.'], 400);
        }
    
        // ✅ OTP matched – delete the OTP record
        $otpVerification->delete();
    
        return response()->json(['otpMessage' => 'OTP verified successfully.']);
    }
    

    public function resetPassword(Request $request)
    {
        // Validate input
        $request->validate([
            'admin_email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Try to find user by email in User model
        $user = User::where('admin_email', $request->admin_email)->first();

        // If not found, try Doctor model
        if (!$user) {
            $user = Doctor::where('email', $request->admin_email)->first();
        }

        // If still not found, return error
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully.']);
    }


    public function signup(Request $request)
    {
        // $validated = $request->validate([
        //     'hospital_name' => 'required|string|max:255',
        //     'reg_number' => 'required|string|max:255',
        //     'establish' => 'required|date',
        //     'country' => 'required|string|max:255',
        //     'division' => 'required|string|max:255',
        //     'district' => 'required|string|max:255',
        //     'sub_district' => 'required|string|max:255',
        //     'location_details' => 'required|string',
        //     'mobile_number_1' => 'required|string|max:15',
        //     'mobile_number_2' => 'required|string|max:15',
        //     'email' => 'required|email|unique:hospitals,email',
        //     'admin_name' => 'required|string|max:255',
        //     'admin_mobile' => 'required|string|max:15',
        //     'admin_email' => 'required|email|unique:hospitals,admin_email',
        //     'password' => 'required|string|min:8|confirmed',
        //     'logo' => 'nullable|image|max:2048',
        //     'front_picture' => 'nullable|image|max:2048',
        // ]);
        $otpVerification = OtpVerification::where('email', $request->admin_email)->first();
        if (!$otpVerification) {
            return response()->json(['otpMessage' => 'OTP not found'], 404);
        }
        if (Carbon::now()->greaterThan($otpVerification->expires_at)) {
            return response()->json(['otpMessage' => 'OTP has expired'], 400);
        }
        if ($otpVerification->otp !== $request->otp) {
            return response()->json(['otpMessage' => 'Invalid OTP'], 400);
        }

        $user = new User();
        $user->hospital_name = $request->hospital_name;
        $user->reg_number = $request->reg_number;
        $user->establish = $request->establish;
        $user->country = $request->country;
        $user->division = $request->division;
        $user->district = $request->district;
        $user->sub_district = $request->sub_district;
        $user->location_details = $request->location_details;
        $user->mobile_number_1 = $request->mobile_number_1;
        $user->mobile_number_2 = $request->mobile_number_2;
        $user->email = $request->email;
        $user->admin_name = $request->admin_name;
        $user->admin_mobile = $request->admin_mobile;
        $user->admin_email = $request->admin_email;
        $user->password = Hash::make($request->password);

        $imageLogoName = '';
        if ($request->logo) {
            $position = strpos($request->logo, ';');
            $sub = substr($request->logo, 0, $position);
            $ext = explode('/', $sub)[1];
            $imageLogoName = rand(1, 1000) . '_' . $request->hospital_name . '.' . $ext;
            $image = str_replace('data:image/' . $ext . ';base64,', '', $request->logo);
            $image = str_replace(' ', '+', $image);

            $imagePath = public_path('hospital/backend/img/users/logo/' . $imageLogoName);
            if (!File::isDirectory(public_path('hospital/backend/img/users/logo'))) {
                File::makeDirectory(public_path('hospital/backend/img/users/logo'), 0755, true, true);
            }
            File::put($imagePath, base64_decode($image));
            $user->logo = $imageLogoName;
        }

        $imagefrontName = '';
        if ($request->front_picture) {
            $position = strpos($request->front_picture, ';');
            $sub = substr($request->front_picture, 0, $position);
            $ext = explode('/', $sub)[1];
            $imagefrontName = rand(1, 1000) . '_' . $request->hospital_name . '.' . $ext;
            $image = str_replace('data:image/' . $ext . ';base64,', '', $request->front_picture);
            $image = str_replace(' ', '+', $image);

            $imagePath = public_path('hospital/backend/img/users/front_image/' . $imagefrontName);
            if (!File::isDirectory(public_path('hospital/backend/img/users/front_image'))) {
                File::makeDirectory(public_path('hospital/backend/img/users/front_image'), 0755, true, true);
            }
            File::put($imagePath, base64_decode($image));
            $user->front_picture = $imagefrontName;
        }
        $user->save();
        $otpVerification->delete();

        // return response()->json(['message' => 'User created successfully']);
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user, // Include the saved user data
        ], 201);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function me()
    // {
    //     return response()->json(auth()->user());
    // }
    public function me()
    {
        try {
            // Check and return authenticated User
            if (auth('user_api')->check()) {
                return response()->json([
                    'user' => auth('user_api')->user(),
                    'role' => 'Admin'
                ]);
            }

            // Check and return authenticated Doctor
            if (auth('doctor_api')->check()) {
                return response()->json([
                    'user' => auth('doctor_api')->user(),
                    'role' => 'Doctor'
                ]);
            }

            // If no user is authenticated
            return response()->json(['message' => 'Not authenticated.'], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve authenticated user.'], 500);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            auth()->logout();
            return response()->json(['message' => 'Successfully logged out']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to log out'], 500);
        }
    }

    // public function logout()
    // {
    //     try {
    //         // Determine which guard is authenticated (user_api or doctor_api)
    //         if (auth('user_api')->check()) {
    //             auth('user_api')->logout();
    //             return response()->json(['message' => 'User logged out successfully.']);
    //         } elseif (auth('doctor_api')->check()) {
    //             auth('doctor_api')->logout();
    //             return response()->json(['message' => 'Doctor logged out successfully.']);
    //         } else {
    //             return response()->json(['message' => 'No authenticated user found.'], 401);
    //         }
    //     } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
    //         return response()->json(['error' => 'Failed to log out.'], 500);
    //     }
    // }


    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function refresh()
    // {
    //     return $this->respondWithToken(JWTAuth::refresh(JWTAuth::getToken()));
    // }

    public function refresh(Request $request)
    {
        // Check if a valid token is provided
        $token = JWTAuth::getToken();

        // Check if the token is valid
        if (!$token) {
            return response()->json(['error' => 'Token not provided or invalid'], 401);
        }

        // Try refreshing the token based on user type (user or doctor)
        try {
            $user = JWTAuth::authenticate($token);

            // Check user type from the authenticated token
            if ($user instanceof User) {
                // If it's a User, use the user guard for refreshing the token
                $refreshedToken = auth('user_api')->refresh();  // Using auth helper for refreshing
                return $this->respondWithToken($refreshedToken, 'user');
            } elseif ($user instanceof Doctor) {
                // If it's a Doctor, use the doctor guard for refreshing the token
                $refreshedToken = auth('doctor_api')->refresh();  // Using auth helper for refreshing
                return $this->respondWithToken($refreshedToken, 'doctor');
            } else {
                return response()->json(['error' => 'Unknown user type'], 400);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Token expired'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Token invalid'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Could not parse token'], 500);
        }
    }



    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // protected function respondWithToken($token)
    // {
    //     // Fetch the TTL from the config, multiplied by 60 to convert minutes to seconds
    //     $ttl = config('jwt.ttl') * 60;

    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => $ttl,
    //         'user_id' => auth()->user()->id,
    //     ]);
    // }
    protected function respondWithToken($token, $type)
    {
        // Fetch the TTL from the config, multiplied by 60 to convert minutes to seconds
        $ttl = config('jwt.ttl') * 60;

        // Determine the user object based on the login type (user or doctor)
        if ($type == 'user') {
            $user = auth('user_api')->user();
        } elseif ($type == 'doctor') {
            $user = auth('doctor_api')->user();
        } else {
            return response()->json(['error' => 'Invalid user type'], 400);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $ttl,
            'user_id' => $user->id,
            'user_type' => $type, // Either 'user' or 'doctor'
        ]);
    }
}
