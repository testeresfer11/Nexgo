<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash,Validator,Storage};
use App\Traits\SendResponseTrait;
use App\Models\{User, OtpManagement,Cars,GeneralSetting,Notifications,UserNotifications,ContentPage,Rides,Reviews};
use App\Mail\{OtpMail,WelcomeRegistration,PasswordUpdated,AccountCloseMail};
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str; 
use Session;
use Log;
use Twilio\Rest\Client;
use Illuminate\Validation\Rule;


class AuthController extends Controller
{
    use SendResponseTrait;

   public function register(Request $request)
{
    try {
        $request->merge([
            'email' => $request->email ?: null,
            'phone_number' => $request->phone_number ?: null,
            'country_code' => $request->country_code ?: null,
            'country_short' => $request->country_short ?: null,
        ]);

        $validator = Validator::make($request->all(), [
            'email' => 'nullable|email|max:255|required_without:phone_number|unique:users,email',
            'phone_number' => 'nullable|string|max:15|required_without:email|unique:users,phone_number',
            'country_code' => 'nullable|required_with:phone_number',
            'country_short' => 'nullable|required_with:phone_number',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse('error', 422, $validator->errors()->first());
        }

        // Create a user without email/phone (only password and blank profile)
        $user = User::create([
            'password' => Hash::make(Str::random(10)),

            'phone_otp_expires_at' => now()->addMinutes(10),
        ]);

        // Generate unique OTP
        do {
            $otp = rand(1000, 9999);
        } while (OtpManagement::where('otp', $otp)->exists());

        // Save OTP and temporary contact info
       OtpManagement::updateOrCreate(
            array_filter([
                'email'        => $request->email,
                'phone_number' => $request->phone_number,
                'country_code' => $request->phone_number ? $request->country_code : null,
            ]),
            [
                'user_id'=>$user->user_id,
                'otp' => $otp,
            ]
        );


        // Send OTP via mail/sms
        if (!empty($request->email)) {

            Mail::to($request->email)->send(new OtpMail($otp));
        }

        // Example for SMS
        // SmsService::send($request->phone_number, "Your OTP is $otp");

        return $this->apiResponse('success', 200, 'OTP has been sent for verification', [
            'user_id' => $user->user_id,
            'email' => $request->email,
            'otp' => $otp,
            'phone_number' => $request->phone_number,
            'country_code' => $request->country_code,
            'country_short' => $request->country_short,
        ]);

    } catch (\Exception $e) {
        return $this->apiResponse('error', 500, $e->getMessage(), $e->getLine());
    }
}

    

   public function resendOtp(Request $request)
    {
        try {
            // Validate request
            $validator = Validator::make($request->all(), [
                'email' => 'nullable|email|required_without:phone_number',
                'phone_number' => 'nullable|string|required_without:email',
                'country_code' => 'nullable|required_with:phone_number',
                'user_id' => 'required',
               
            ]);

            if ($validator->fails()) {
                return $this->apiResponse('error', 422, $validator->errors()->first());
            }

            // Fetch user by email or phone
            $user = User::where('user_id',$request->user_id)->first();

            if (!$user) {
                return $this->apiResponse('error', 404, 'User not found.');
            }

            // Generate unique OTP
            do {
                $otp = rand(1000, 9999);
            } while (OtpManagement::where('otp', $otp)->exists());

            // Save OTP
             OtpManagement::updateOrCreate(
                array_filter([
                    'email'        => $request->email,
                    'phone_number' => $request->phone_number,
                    'country_code' => $request->phone_number ? $request->country_code : null,
                ]),
                [
                    'user_id'=>$user->user_id,
                    'otp' => $otp,
                ]
            );
            // Send OTP
            if (!empty($request->email)) {
                Mail::to($request->email)->send(new OtpMail($otp));
            }

            if (!empty($request->phone_number)) {
                // Replace with actual SMS logic
                // SmsService::send($user->phone_number, "Your OTP is $otp");
            }

            return $this->apiResponse('success', 200, 'OTP has been resent successfully.', [
                'email' => $request->email,
                'user_id' => $request->user_id,
                'phone_number' => $request->phone_number,
                'country_code' => $request->country_code,
                'otp'          => $otp
            ]);

        } catch (\Exception $e) {
            return $this->apiResponse('error', 500, $e->getMessage());
        }
    }



    public function updateContactAndSendOtp(Request $request)
    {
        try {
            // Validate email or phone
            $validator = Validator::make($request->all(), [
                'email'        => 'nullable|required_without:phone_number',
                'phone_number' => 'nullable|string|required_without:email',
                'country_code' => 'nullable|required_with:phone_number',
            ]);

            if ($validator->fails()) {
                return $this->apiResponse('error', 422, $validator->errors()->first());
            }

            // Get current authenticated user
            $user = auth()->user();
            if (!$user) {
                return $this->apiResponse('error', 401, 'Unauthorized');
            }

            // Update user details
           if ($request->filled('email')) {
                $exists = User::where('email', $request->email)
                              ->where('user_id', '!=', auth()->id()) // exclude current user
                              ->exists();

                if ($exists) {
                   return $this->apiResponse('error', 422, 'Email is Already in use');
                }

                //$user->email = $request->email;
            }

            if ($request->filled('phone_number')) {
                $exists = User::where('phone_number', $request->phone_number)
                              ->where('user_id', '!=', auth()->id())
                              ->exists();

                if ($exists) {
                      return $this->apiResponse('error', 422, 'Phone number is Already in use');
                }

                //$user->phone_number = $request->phone_number;
                //$user->country_code = $request->country_code;
            }

            //$user->save();



            do {
                $otp = rand(1000, 9999);
            } while (OtpManagement::where('otp', $otp)->exists());

           OtpManagement::updateOrCreate(
                [
                    'email' => $request->email,
                    'phone_number' => $request->phone_number
                ],
                ['otp' => $otp,'country_code' => $request->country_code]
            );


            if ($request->filled('email')) {
                Mail::to($request->email)->send(new OtpMail($otp));
            }

            if ($request->filled('phone_number')) {
                // Example SMS Service call
                // SmsService::send($user->country_code.$user->phone_number, "Your OTP is $otp");
            }

            return $this->apiResponse('success', 200, 'OTP has been sent successfully.', [
                'email'        => $request->email,
                'phone_number' => $request->phone_number,
                'otp'          => $otp 
            ]);

        } catch (\Exception $e) {
            return $this->apiResponse('error', 500, $e->getMessage());
        }
    }





    /*end method register */

    /**
     * functionName : verifyOtp
     * createdDate  : 12-06-2024
     * purpose      : To verify the email via otp
    */
    public function verifyOtp(Request $request)
   {
    try {
        // Validate request - require either email or phone
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|email|required_without:phone_number',
            'phone_number' => 'nullable|string|required_without:email',
            'country_code'        => 'nullable|required_with:phone_number',
            'otp'   => 'required|numeric',
            'user_id'   => 'required'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse('error', 422, $validator->errors()->first());
        }

        // Find the user
        $user = User::where('user_id',$request->user_id)->first();

        if (!$user) {
            return $this->apiResponse('error', 404, 'User not found.');
        }

        // Check OTP existence
      $otpExists = OtpManagement::where('user_id', $request->user_id)
        ->where('otp', $request->otp)
        ->first();
        if (!$otpExists) {
            return $this->apiResponse('error', 422, 'OTP is invalid');
        }


        // Update verification timestamp
        if($request->phone_number){
                 $user->update([
                'phone_number'=>$request->phone_number,
                'country_code'=>$request->country_code,
                'country_short' => $request->country_short,
                'phone_verfied_at' => now()
            ]);
        }

         if($request->email){
                 $user->update([
                'email'=>$request->email,
                'email_verified_at' => now()
            ]);
        }
       
       

        // Delete OTP after successful verification
        OtpManagement::where('user_id',$request->user_id)->where('otp', $request->otp)->delete();

        // Generate API token
        $accessToken = $user->createToken('AuthToken')->plainTextToken;

        return $this->apiResponse('success', 200, 'OTP has been verified successfully', [
            'token' => $accessToken,
            'user'  => $user
        ]);
        
    } catch (\Exception $e) {
        return $this->apiResponse('error', 500, $e->getMessage(), $e->getLine());
    }
}


   public function verifyOtpAfterLogin(Request $request)
   {
    try {
        // Validate request - require either email or phone
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|email|required_without:phone_number',
            'phone_number' => 'nullable|string|required_without:email',
            'country_code'        => 'nullable|required_with:phone_number',
            'otp'   => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse('error', 422, $validator->errors()->first());
        }

         $user = Auth::user();

        if (!$user) {
            return $this->apiResponse('error', 401, 'Unauthorized user.');
        }

        // Check OTP existence
        $otpExists = OtpManagement::where(function($query) use ($request) {
                $query->when($request->email, fn($q) => $q->where('email', $request->email))
                      ->when($request->phone_number, fn($q) => $q->where('phone_number', $request->phone_number)->where('country_code', $request->country_code));
            })
            ->where('otp', $request->otp)
            ->exists();

        if (!$otpExists) {
            return $this->apiResponse('error', 422, 'OTP is invalid');
        }

        // Update verification timestamp
        if($request->email){
                 $user->update([
                 'email'   =>$request->email,
                'email_verified_at' => now()
            ]);
        }

         if($request->phone_number){
                 $user->update([
                'phone_number'   =>$request->phone_number,
                 'country_code'   =>$request->country_code,
                'phone_verfied_at' => now()
            ]);
        }
       
       

        // Delete OTP after successful verification
        OtpManagement::where(function($query) use ($request) {
                $query->when($request->email, fn($q) => $q->where('email', $request->email))
                      ->when($request->phone_number, fn($q) => $q->where('phone_number', $request->phone_number)->where('country_code', $request->country_code));
            })
            ->where('otp', $request->otp)
            ->delete();

        
      

        return $this->apiResponse('success', 200, 'OTP has been verified successfully', [
           
            'user'  => $user
        ]);
        
    } catch (\Exception $e) {
        return $this->apiResponse('error', 500, $e->getMessage(), $e->getLine());
    }
    }

 

    /*end method verifyOtp */
    
    /**
     * functionName : login
     * createdDate  : 12-06-2024
     * purpose      : login the user
    */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email'        => 'nullable|email|exists:users,email',
                'phone_number' => 'nullable|string|exists:users,phone_number',
                'country_code' => 'nullable|required_with:phone_number',
            ]);

            $validator->after(function ($validator) use ($request) {
                // Require at least email or phone
                if (!$request->filled('email') && !$request->filled('phone_number')) {
                    $validator->errors()->add('email', 'Either email or phone is required.');
                    $validator->errors()->add('phone_number', 'Either email or phone is required.');
                }

                // Check email verification
                if ($request->filled('email')) {
                    $user = User::where('email', $request->email)->first();
                    if ($user && is_null($user->email_verified_at)) {
                        $validator->errors()->add('email', 'Your email is not verified.');
                    }
                }

                // Check phone verification
                if ($request->filled('phone_number')) {
                    $user = User::where('phone_number', $request->phone_number)->first();
                    if ($user && is_null($user->phone_verfied_at)) {
                        $validator->errors()->add('phone_number', 'Your phone number is not verified.');
                    }
                }
            });

            if ($validator->fails()) {
                return $this->apiResponse('error', 422, $validator->errors()->first());
            }

    
            // Step 2: Fetch user by email or phone
            $user = User::when($request->email, fn($q) => $q->where('email', $request->email))
                        ->when($request->phone_number, fn($q) => $q->where('phone_number', $request->phone_number)->where('country_code', $request->country_code))
                        ->whereNull('deleted_at')
                        ->first();
    
            if (!$user) {
                return $this->apiResponse('error', 404, 'User not found.');
            }
    
            if ($user->status == 0) {
                return $this->apiResponse('error', 403, 'Your account has been blocked. Contact Administrator.');
            }
    
            // Step 3: Generate unique OTP
            do {
                $otp = rand(1000, 9999);
            } while (OtpManagement::where('otp', $otp)->exists());
    
            // Step 4: Save OTP
            OtpManagement::updateOrCreate(
                ['email' => $user->email, 'phone_number' => $user->phone_number],
                ['otp' => $otp,'country_code' => $user->country_code]
            );
    
            // Step 5: Send OTP
            if (!empty($request->email)) {
                Mail::to($user->email)->send(new OtpMail($otp));
                $sentTo = 'email';
            }
    
            if (!empty($request->phone)) {
                // Replace with your SMS service
                // SmsService::send($user->phone, "Your OTP is $otp");
                $sentTo = 'phone_number';
            }
    
            return $this->apiResponse('success', 200, 'OTP has been sent for verification.', [
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'user_id' => $user->user_id,
                'country_code' => $user->country_code,
                'is_profile_updated'=>$user->is_profile_updated,
                'otp_sent_to' => $sentTo ?? null,
                'otp' =>$otp
            ]);
    
        } catch (\Exception $e) {
            return $this->apiResponse('error', 500, $e->getMessage(), $e->getLine());
        }
    }
    


  public function handleSocialLogin(Request $request){
    // Validate the incoming request
    $validator = Validator::make($request->all(), [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|string|email', // Ensure email is also required
        'provider' => 'required|string',
        'provider_id' => 'required|string',
        'fcm_token' => 'required|string',
        'device_type' => 'required|string',
    ]);

    // Return validation errors if any
    if ($validator->fails()) {
        return $this->apiResponse('error', 422, $validator->errors()->first());
    }

    // Check if the user already exists by email
    $user = User::where('email',$request->email)->first();
  
    if ($user) {
        // User exists, update their fcm_token and device_type
        $user->fcm_token = $request->fcm_token;
        $user->device_type = $request->device_type;
        $user->save();

        // Generate access token for existing user
        $accessToken = $user->createToken('AuthToken')->plainTextToken;

        // Return successful login response
        return $this->apiResponse('success', 200, 'Login successful', [
            'access_token' => $accessToken,
            
                'id' => $user->user_id,
                'name' => $user->first_name . ' ' . $user->last_name,
                'email' => $user->email,
            
        ]);
    }

    // If user does not exist, create a new one
    $user = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'email_verified_at' => Carbon::now(),
        'password' => Hash::make(Str::random(10)), // Generate a random password
        'provider' => $request->provider,
        'provider_id' => $request->provider_id,
        'fcm_token' => $request->fcm_token,
        'device_type' => $request->device_type,
    ]);

    // Generate access token for new user
    $accessToken = $user->createToken('AuthToken')->plainTextToken;

    // Return successful registration response
    return $this->apiResponse('success', 200, 'Registration successful', [
        'access_token' => $accessToken,
        
            'id' => $user->user_id,
            'name' => $user->first_name . ' ' . $user->last_name,
            'email' => $user->email,
        
    ]);
}

    /*end method login */

    /**
     * functionName : forgetPassword
     * createdDate  : 12-06-2024
     * purpose      : send the email for the forget password
    */
    public function forgetPassword(Request $request){
    try {
        // Validate the incoming request
        $validate = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
        ]);

        // Return validation errors if any
        if ($validate->fails()) {
            return $this->apiResponse('error', 422, $validate->errors()->first());
        }

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists
        if (!$user) {
            return $this->apiResponse('error', 404, 'User not found.');
        }

        // Generate a unique OTP
        do {
            $otp = rand(1000, 9999);
        } while (OtpManagement::where('otp', $otp)->count());

        // Save or update the OTP in the OtpManagement table
        OtpManagement::updateOrCreate(['email' => $user->email], ['otp' => $otp]);

        // Send the OTP via email
        Mail::to($user->email)->send(new OtpMail($otp));

        return $this->apiResponse('success', 200, 'Password reset email ' . config('constants.SUCCESS.SENT_DONE'), $user);
    } catch (\Exception $e) {
        // Log the error message for debugging purposes
        Log::error('Error in forgetPassword: ' . $e->getMessage());
        return $this->apiResponse('error', 500, 'An error occurred while processing your request.');
    }
}

    /*end method forgetPassword */

    /**
     * functionName : setNewPassword
     * createdDate  : 12-06-2024
     * purpose      : change the password
    */
    public function setNewPassword(Request $request)
{
    
    try {
        // Validate incoming request data
        $validate = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|exists:users,email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
        ]);

        // Return validation errors if any
        if ($validate->fails()) {
            return $this->apiResponse('error', 422, $validate->errors()->first());
        }
        $timezone = 'Australia/Sydney';

    
        // Get the current date and time in the specified timezone
        $currentDateTime = now()->timezone($timezone)->format('F d, Y \a\t h:i A');

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // If user is not found, return error response
        if (!$user) {
            return $this->apiResponse('error', 404, 'User not found.');
        }

        // Update the user's password
        $user->update(['password' => Hash::make($request->password)]);

        // Prepare email content
        $subject = 'Your password has been updated';
       $content = '<p style="font-size: 18px; color: #808080;">Your password has been updated on ' . $currentDateTime . '</p>';


        // Send the email notification
        Mail::to($user->email)->send(new PasswordUpdated($user, $subject, $content));

        return $this->apiResponse('success', 200, 'Password has been successfully updated.', $user);
    } catch (\Exception $e) {
        // Log the error message for debugging purposes
        Log::error('Error updating password: ' . $e->getMessage());
        return $this->apiResponse('error', 500, 'An error occurred while updating your password.');
    }
}

    /*end method changePassword */
    
    /**
     * functionName : logOut
     * createdDate  : 12-06-2024
     * purpose      : Logout the login user
    */
    public function logOut(Request $request) {
    try {
        // Get the authenticated user ID
        $user = Auth::user();
        $id = $user->user_id;

        // Revoke all tokens for the user (Laravel Passport or Sanctum)
        $user->tokens()->where('tokenable_id', $id)->delete();

        // Log out from web guard
        Auth::guard('web')->logout();

        // Remove FCM token and device type from the user's record
        $user->fcm_token = null; // Or set to an empty string, depending on your preference
        $user->device_type = null; // Or set to an empty string
        $user->save();

        // You can also log this for debugging purposes
        \Log::info("FCM token and device type cleared for user ID: {$id}");

        // Response upon successful logout
        return $this->apiResponse('success', 200, config('constants.SUCCESS.LOGOUT_DONE'));

    } catch (\Exception $e) {
        // Handle errors and return error response
        return $this->apiResponse('error', 500, $e->getMessage());
    }
}

    /*end method logOut */

    public function edit_picture(Request $request){
        try{
                $validate = Validator::make($request->all(), [
                    'profile_picture'    => 'required',
                ]);

                if ($validate->fails()) {
                    return $this->apiResponse('error',422,$validate->errors()->first());
                }

                $data= [];
                
                if($request->hasFile('profile_picture'))
                {
                    $imageName='';
                    $user_id=Auth::id();
                    $userDetail = User::where('user_id', $user_id)->first();

                    $ImgName = $userDetail ? $userDetail->profile_picture : '';

                    /** delete old image from storage path */
                    if ($ImgName) {
                        $deleteImage = 'public/users/' . $ImgName;
                        if (Storage::exists($deleteImage)) {
                            Storage::delete($deleteImage);
                        }
                    }

                    /* end of delete image */

                    $imageName = time().'.'.$request->profile_picture->extension();  

                    $request->profile_picture->storeAs('public/users', $imageName);

                    User::where('user_id' , $user_id)->update([
                        'profile_picture'  => $imageName
                    ]);

                    $data= [
                        'profile_picture' => URL::to('/').'/storage/users/'.$imageName
                     ];
                }

                

                
                return $this->apiResponse('success',200, 'Update Image successfully',$data);

        }catch(\Exception $e){
            return $this->apiResponse('error',422, $e->getMessage());
        }
    }

    public function bio(Request $request){
        try{
                $validate = Validator::make($request->all(), [
                    'bio'    => 'nullable',
                ]);

                if ($validate->fails()) {
                    return $this->apiResponse('error',422,$validate->errors()->first());
                }

                $user_id=Auth::id();

                
                User::where('user_id' , $user_id)->update([
                    'bio'  => $request->bio
                ]);

                
                return $this->apiResponse('success',200, 'Update Bio successfully');

        }catch(\Exception $e){
            return $this->apiResponse('error',422, $e->getMessage());
        }
    }

   

    public function personalDetails(Request $request){
        try {
            $user_id = Auth::id();

            // Validation
            $validate = Validator::make($request->all(), [
                'first_name'    => 'required|string',
                'last_name'     => 'required|string',
                'dob'           => 'required|date',
                'email'         => [
                    'nullable',
                    'email',
                    Rule::unique('users')->ignore(Auth::user()->user_id, 'user_id'), // unique except current user
                ],
                'phone_number'  => [
                    'nullable',
                    'numeric',
                    'digits_between:8,12',
                    Rule::unique('users')->ignore(Auth::user()->user_id, 'user_id'), // unique except current user
                ],
                'country_code'  => 'nullable|string',
                'profile_picture' => 'nullable|string',
            ]);

            if ($validate->fails()) {
                return $this->apiResponse('error', 422, $validate->errors()->first());
            }

            // Fetch the current user data
            $user = User::where('user_id', $user_id)->first();

            // Track changes
            $phoneNumberChanged = $request->phone_number && $request->phone_number !== $user->phone_number;
            $emailChanged       = $request->email && $request->email !== $user->email;

            // Prepare update data
            $updateData = [
                'first_name'       => $request->first_name,
                'last_name'        => $request->last_name,
                'dob'              => $request->dob,
                'country_code'     => $request->country_code,
                'phone_number'     => $request->phone_number,
                'email'            => $request->email,
                'profile_picture'  => $request->profile_picture,
                'is_profile_updated' => 1,
            ];

            // Reset verification fields if values changed
            if ($phoneNumberChanged) {
                $updateData['phone_verfied_at'] = null;
            }
            if ($emailChanged) {
                $updateData['email_verified_at'] = null;
            }

            // Perform update
            User::where('user_id', $user_id)->update($updateData);

            // Fetch updated user data
            $data = User::where('user_id', $user_id)->first();

            return $this->apiResponse('success', 200, 'Updated personal details successfully', $data);

        } catch (\Exception $e) {
            return $this->apiResponse('error', 422, $e->getMessage());
        }
    }

    public function uploadDocument(Request $request){
    try {
       $validate = Validator::make($request->all(), [
            'document_type' => 'required|in:license_front,license_back,national_id_front,national_id_back,technical_inspection_certificate_front,technical_inspection_certificate_back,registration_certificate_front,registration_certificate_back,insurance_front,insurance_back',
            'document'      => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);


        if ($validate->fails()) {
            return $this->apiResponse('error', 422, $validate->errors()->first());
        }

        $user_id = Auth::id();
        $user = User::where('user_id', $user_id)->first();

        if (!$user) {
            return $this->apiResponse('error', 404, 'User not found');
        }

        $documentType = $request->document_type; 
        $oldFile = $user->$documentType ?? null;

        // delete old file if exists
        if ($oldFile && Storage::exists("public/$documentType/$oldFile")) {
            Storage::delete("public/$documentType/$oldFile");
        }

        // save new file
        $fileName = time() . '.' . $request->document->extension();
        $path = $request->document->storeAs("public/$documentType", $fileName);

          $storageUrl = Storage::url($path); 

            $fileUrl = url($storageUrl); 
            $user->update([
                $documentType => $fileUrl,
                'verify_id'   => 4
            ]);

            Notifications::create([
                'user_id'   => $user_id,
                'type'      => 'Document Approval Request',
                'message'   => ucfirst(str_replace('_',' ', $documentType)) . ' uploaded and verification requested.',
                'timestamp' => now(),
            ]);

        return $this->apiResponse('success', 200, ucfirst($documentType) . ' uploaded successfully', $user);

    } catch (\Exception $e) {
        return $this->apiResponse('error', 500, $e->getMessage());
    }
}

    public function userDetails(Request $request){
        try{
            $user_id=Auth::id();
            $userDetail = User::with('cars')->where('user_id', $user_id)->first();

            if($userDetail->dob != "")
            {
                $userDetail->age=$this->calculateAge($userDetail->dob);
            }

            $userDetail->country_code=$userDetail->country_code;

            if($userDetail->profile_picture != ""||$userDetail->profile_picture != null)
            {  
                $userDetail->profile_picture=$userDetail->profile_picture;
            }
            $userDetail->verify_id=$this->getStatusString($userDetail->verify_id);

             $reviewsData = \DB::table('reviews')
            ->select(
                \DB::raw('AVG(rating) as average_rating'), // Calculate average rating
                \DB::raw('COUNT(review_id) as reviews_count') // Count the number of reviews
            )
            ->where('receiver_id', $user_id)
            ->first();

        // Attach reviews data to the user details
        $userDetail->average_rating = round($reviewsData->average_rating, 1); // Round average rating to 1 decimal
        $userDetail->reviews_count = $reviewsData->reviews_count;
        $rideCount = \DB::table('rides')
            ->where('driver_id', $user_id)
            ->count();

        // Attach ride count to the user details
        $userDetail->publish_ride_count = $rideCount;
        $userDetail->profile_picture =  URL::to('/').'/storage/users/'.$userDetail->profile_picture;
        return $this->apiResponse('success',200, 'Fetched User Details successfully', $userDetail );


        }catch(\Exception $e){
            return $this->apiResponse('error',422, $e->getMessage());
        }
    }


   public function passangerDetails(Request $request) {
    try {
        $user_id = $request->user_id;

        // Fetch user details along with their cars
        $userDetail = User::with('cars')->where('user_id', $user_id)->first();
        


        // Check if user detail exists
        if (!$userDetail) {
            return $this->apiResponse('error', 404, 'User not found');
        }

        // Calculate age if date of birth is available
        if (!empty($userDetail->dob)) {
            $userDetail->age = $this->calculateAge($userDetail->dob);
        }

        // Update the profile picture URL if it exists
        if (!empty($userDetail->profile_picture)) {
            $userDetail->profile_picture = URL::to('/') . '/storage/users/' . $userDetail->profile_picture;
        }

        // Get the status string for verify_id
        $userDetail->verify_id = $this->getStatusString($userDetail->verify_id);

        // Fetch the average rating and reviews count from the reviews table
        $reviewsData = \DB::table('reviews')
            ->select(
                \DB::raw('AVG(rating) as average_rating'), // Calculate average rating
                \DB::raw('COUNT(review_id) as reviews_count') // Count the number of reviews
            )
            ->where('receiver_id', $user_id)
            ->first();

        // Attach reviews data to the user details
        $userDetail->average_rating = round($reviewsData->average_rating, 1); // Round average rating to 1 decimal
        $userDetail->reviews_count = $reviewsData->reviews_count;

        // Fetch the ride count where driver_id is the user's id
        $rideCount = \DB::table('rides')
            ->where('driver_id', $user_id)
            ->count();

        // Attach ride count to the user details
        $userDetail->publish_ride_count = $rideCount;

        // Return success response with user details, reviews, and ride count
        return $this->apiResponse('success', 200, 'Fetched User Details successfully', $userDetail);

    } catch (\Exception $e) {
        // Return error response if an exception occurs
        return $this->apiResponse('error', 422, $e->getMessage());
    }
}



    private function getStatusString($status)
    {
        switch ($status) {
            case 1:
                return 'pending';
            case 2:
                return 'confirmed';
            case 3:
                return 'rejected';
            case 4:
                return 'requested';
            default:
                return 'unknown';
        }
    }

    private function calculateAge($dob)
    {
        // Create DateTime object for date of birth
        $dobCarbon = Carbon::parse($dob); // Parse date of birth to a Carbon instance
        $now = Carbon::now(); // Get current date and time
        
        $age = $dobCarbon->diffInYears($now);

        $integerPart = (int) $age;
        
        // Return the difference in years
        return $integerPart;
    }

    public function companyDetails(Request $request){
        try{
            $data= GeneralSetting::get();
            return $this->apiResponse('success',200, 'Fetched company details successfully',$data);

        }catch(\Exception $e){
            return $this->apiResponse('error',422, $e->getMessage());
        }
    }

   public function changePassword(Request $request){
    try {

       $timezone ='Australia/Sydney';

    
        // Get the current date and time in the specified timezone
        $currentDateTime = now()->timezone($timezone)->format('F d, Y \a\t h:i A');


        // Custom validation rule to check that new password is not the same as current password
        $validate = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                function ($attribute, $value, $fail) use ($request) {
                    if (Hash::check($value, Auth::user()->password)) {
                        $fail('The new password must be different from the current password.');
                    }
                },
            ],
            'password_confirmation' => 'required',
        ]);

        if ($validate->fails()) {
            return $this->apiResponse('error', 422, $validate->errors()->first());
        }

        $user = User::find(Auth::id());

        if ($user && Hash::check($request->current_password, $user->password)) {
            $changePassword = User::where("user_id", $user->user_id)->update([
                "password" => Hash::make($request->password_confirmation),
            ]);

            if ($changePassword) {
                $subject = 'Your password has been updated';
                $content = '<p style="font-size: 18px; color: #808080;">Your password has been updated on ' . $currentDateTime . '</p>';


                // Send the email notification
                Mail::to($user->email)->send(new PasswordUpdated($user, $subject, $content));

                return response()->json(["status" => "success", "message" => "Password " . config('constants.SUCCESS.CHANGED_DONE')], 200);
            }
        } else {
            return response()->json([
                'status' => 'error',
                "message" => "Current Password is invalid."
            ], 422);
        }
    } catch (\Exception $e) {
        return $this->apiResponse('error', 422, $e->getMessage());
    }
}

    public function closeAccount(Request $request){
        $user=Auth::user();
        $user_id =$user->user_id;
          Mail::to($user->email)->send(new AccountCloseMail($user));
        $user= User::where('user_id',$user_id)->delete();

        if($user)
        {
            return response()->json(["status" => "success","message" => "Account ".config('constants.SUCCESS.DELETE_DONE')], 200);
        }
        else
        {
            return response()->json([
                'status'    => 'error',
                "message"   => "User not valid in our record."
            ],422);
        }
    }

    public function userPreferences(Request $request){
        try{
            // $validate = Validator::make($request->all(),[
            //     'chattiness' => 'required',
            //     'music'  => 'required|confirmed|min:8',
            //     'smoking' => 'required',
            // ]);
            // if ($validate->fails()) {
            //     return $this->apiResponse('error',422,$validate->errors()->first());
            // }

            $user = User::find(Auth::id());

            $user->chattiness=$request->chattiness;
            $user->music=$request->music;
            $user->smoking=$request->smoking;
            $user->pets=$request->pets;

            $user->update();

            if($user)
            {
                return response()->json(["status" => "success","message" => "User Prefrences ".config('constants.SUCCESS.UPDATE_DONE')], 200);
            }
            else
            {
                return response()->json([
                    'status'    => 'error',
                    "message"   => "User not valid in our record."
                ],422);
            }

        }catch(\Exception $e){
            return $this->apiResponse('error',422, $e->getMessage());
        }

    }

    public function notifications(Request $request){
        try{
            $Notifications = Notifications::where('user_id', Auth::id())->get();
            // print_r($Notifications);
            // die();

            if($Notifications)
            {
                return $this->apiResponse('success', 200, 'Notifications fetched successfully', $Notifications);
                
            }
            else
            {
                return response()->json([
                    'status'    => 'error',
                    "message"   => "No notifications yet."
                ],422);
            }



        }catch(\Exception $e){
            return $this->apiResponse('error',422, $e->getMessage());
        }

    }

    public function userpushNotifications(Request $request){
        try{
            $validate = Validator::make($request->all(),[
                'your_rides' => 'required',
                'news_gifts'  => 'required',
                'messages' => 'required',
            ]);
            if ($validate->fails()) {
                return $this->apiResponse('error',422,$validate->errors()->first());
            }

            $user = User::find(Auth::id());

            $Notifications= UserNotifications::updateOrCreate(['user_id' => Auth::id(), 'type' => 'push'], [
                'your_rides' => $request->your_rides,
                'news_gifts' => $request->news_gifts,
                'messages' => $request->messages,
            ]);

            if($Notifications)
            {
                return $this->apiResponse('success', 200, 'Notifications Setting updated successfully', $Notifications);
                
            }
            


        }catch(\Exception $e){
            return $this->apiResponse('error',422, $e->getMessage());
        }

    }

    public function userEmailNotifications(Request $request){
        try{
            $validate = Validator::make($request->all(),[
                'your_rides' => 'required',
                'news_gifts'  => 'required',
                'messages' => 'required',
            ]);
            if ($validate->fails()) {
                return $this->apiResponse('error',422,$validate->errors()->first());
            }

            $user = User::find(Auth::id());

            $Notifications= UserNotifications::updateOrCreate(['user_id' => Auth::id(), 'type' => 'email'], [
                'your_rides' => $request->your_rides,
                'news_gifts' => $request->news_gifts,
                'messages' => $request->messages,
            ]);

            if($Notifications)
            {
                return $this->apiResponse('success', 200, 'Notifications Setting updated successfully', $Notifications);
                
            }
            


        }catch(\Exception $e){
            return $this->apiResponse('error',422, $e->getMessage());
        }

    }


   public function generateOtp(Request $request)
{
    try {
        // Validate the request data
        $validate = Validator::make($request->all(), [
          'phone_number' => [
                'required', 
                'numeric', // Ensure it's a numeric value
                'digits_between:8,12', // Optional: adjust if needed
                       Rule::unique('users')->ignore(Auth::user()->user_id, 'user_id') 
            ], 
            'country_code' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validate->errors()->first()
            ], 422);
        }

        // Generate a 4-digit OTP
        $otpCode = rand(1000, 9999);

        // Update the authenticated user's phone number and OTP
        $user = Auth::user();
      
        $user->phone_otp = $otpCode;
        $user->phone_otp_expires_at = Carbon::now()->addMinutes(5);
        $user->save();

        // Initialize Twilio Client using Account SID and Auth Token
       /* $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = env('TWILIO_PHONE_NUMBER'); // Your Twilio phone number

        $client = new Client($sid, $token);

        // Send OTP via SMS
        $client->messages->create(
            $request->country_code . $request->phone_number,
            [
                'from' => $twilioNumber,
               'body' => "Nexgo has sent you an OTP for verification. Your OTP is $otpCode. It is valid for the next 5 minutes. Please use it before it expires."
            ]
        );*/

        return response()->json([
            'data' =>   $otpCode,
            'status' => 'success',
            'message' => 'OTP sent via SMS successfully.'
        ], 201);

    } catch (\Exception $e) {
       
        \Log::error('Error generating OTP: ' . $e->getMessage());
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 400);
    }
}



public function verifyPhoneOtp(Request $request)
{
    try {
        // Validate incoming request
        $validate = Validator::make($request->all(), [
            'otp' => 'required|digits:4',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validate->errors()->first()
            ], 422);
        }

        // Fetch the authenticated user
        $user = Auth::user();

        // Parse phone_otp_expires_at to a Carbon instance if needed
       $phoneOtpExpiresAt = Carbon::parse($user->phone_otp_expires_at);

        // Get current time
        $now = $phoneOtpExpiresAt;
        
        // Check if OTP matches and is not expired
        if ($user->phone_otp == $request->otp && $now <= $phoneOtpExpiresAt) {
            // OTP is valid, reset OTP fields
            $user->phone_otp = null;
            $user->phone_verfied_at = Carbon::now();
            $user->phone_number = $request->phone_number;
            $user->country_code = $request->country_code;
            $user->phone_otp_expires_at = null;
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'OTP verified successfully',
            ], 200);
        }

        // If OTP does not match or is expired
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid or expired OTP',
        ], 400);

    } catch (\Exception $e) {
        
        return response()->json([
            'status' => 'error',
            'message' => $e,
        ], 500);
    }
}


public function getTermsAndConditions()
    {
        $termsAndConditions = ContentPage::where('name', 'terms_and_conditions')->first();
         return $this->apiResponse('success', 200, 'Terms and conditions get successfully', $termsAndConditions);
       
    }

    public function getPrivacyPolicy()
    {
        $privacyPolicy = ContentPage::where('name', 'privacy_policy')->first();
        return $this->apiResponse('success', 200, 'Privacy policy get successfully', $privacyPolicy);
        
    }



public function resetPassword(Request $request)
{
    $user =Auth::user();
    try {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|exists:users,email',
            'otp'      => 'required',
            'password' => 'required|min:8', // It's a good practice to add a minimum length for passwords
        ]);

        if ($validator->fails()) {
            return $this->apiResponse('error', 422, $validator->errors()->first());
        }

        $otp = OtpManagement::where('email', $request->email)
                            ->where('otp', $request->otp)
                            ->first();

        if (!$otp) {
            return $this->apiResponse('error', 422, 'Invalid OTP',$user);
        }

        // Update the user password
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        // Delete the used OTP
        $otp->delete();

        return $this->apiResponse('success', 200, 'Password updated successfully',$user);
    } catch (\Exception $e) {
        return $this->apiResponse('error', 500, $e->getMessage());
    }
}


 public function updateNotificationSettings(Request $request) {
    $user = Auth::user();

    try {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'is_notification_ride'    => 'nullable|boolean',
            'is_notification_plan'    => 'nullable|boolean',
            'is_notification_message' => 'nullable|boolean',
            'is_email_plan'           => 'nullable|boolean',
            'is_email_message'        => 'nullable|boolean',
        ]);

        // Return validation error if validation fails
        if ($validator->fails()) {
            return $this->apiResponse('error', 422, $validator->errors()->first());
        }

        // Update user notification settings
        $user->update([
            'is_notification_ride'    => $request->input('is_notification_ride', 0),
            'is_notification_plan'    => $request->input('is_notification_plan', 0),
            'is_notification_message' => $request->input('is_notification_message', 0),
            'is_email_plan'           => $request->input('is_email_plan', 0),
            'is_email_message'        => $request->input('is_email_message', 0),
        ]);

        // Return a success response
        return $this->apiResponse('success', 200, 'Notification settings updated successfully.', $user->only([
            'is_notification_ride',
            'is_notification_plan',
            'is_notification_message',
            'is_email_plan',
            'is_email_message',
        ]));

    } catch (\Exception $e) {
        // Return a generic error response in case of an exception
        return $this->apiResponse('error', 500, $e->getMessage());
    }
}



public function deleteAccount(Request $request) {
    try {
        // Get the authenticated user's ID
        $user = Auth::user();
        $user_id =$user->user_id;

        // Delete rides associated with the driver
        Rides::where('driver_id', $user_id)->delete();
        
        // Delete bookings associated with the passenger
        Bookings::where('passenger_id', $user_id)->delete();
        
        // Delete reviews where the user is either the reviewer or the receiver
        Reviews::where('reviewer_id', $user_id)
                ->orWhere('receiver_id', $user_id)
                ->delete();
        
        // Delete user reports where the user is the driver or passenger
        UserReport::where('driver_id', $user_id)
                  ->orWhere('passenger_id', $user_id)
                  ->delete();
        
        // Finally, delete the user account
        User::where('user_id', $user_id)->delete();
        Mail::to($user->email)->send(new AccountCloseMail($user));

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Account and related data deleted successfully'
        ], 200);

    } catch (\Exception $e) {
        // If any exception occurs, return an error response
        return response()->json([
            'success' => false,
            'message' => 'Failed to delete account. Please try again later.',
            'error' => $e->getMessage()
        ], 500);
    }
}





public function testSendSms()
{
    try {
        // Example phone number (replace with a test number)
        $testPhoneNumber = '+917009951618'; // Use E.164 format
        $testMessage = "Nexgo has sent you an OTP for verification. Your OTP is 1234. It is valid for the next 5 minutes. Please use it before it expires.";

        // Retrieve Twilio credentials from the environment
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = env('TWILIO_PHONE_NUMBER');

        // Initialize Twilio Client
        $client = new Client($sid, $token);

        // Send SMS
        $message = $client->messages->create(
            $testPhoneNumber,
            [
                'from' => $twilioNumber,
                'body' => $testMessage,
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Test SMS sent successfully.',
            'twilio_message_sid' => $message->sid, // Twilio's unique message ID
        ], 200);

    } catch (\Exception $e) {
        return $e;
        \Log::error('Error sending test SMS: ' . $e->getMessage());
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to send test SMS.'
        ], 500);
    }
}





}
