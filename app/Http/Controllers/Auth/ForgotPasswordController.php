<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\{User, UserDetail,OtpManagement};
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\{Auth, DB, Hash, Validator, Mail, Session};
use App\Traits\SendResponseTrait;
use Carbon\Carbon;


class ForgotPasswordController extends Controller
{
    use SendResponseTrait;
    public function forgetPassword(Request $request)
    {
        try {
            if ($request->isMethod('get')) {
                return view('admin.auth.forget-password');
            } else {
                $validator = Validator::make($request->all(), [
                    'email' => [
                        'required',
                        'email',
                        Rule::exists('users', 'email')
                    ],
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('error', $validator->errors()->first());
                }

                $user = User::where('email', $request->email)->first();

                $this->sendOtp($request->email);

                $email = $request->email;
                session()->flash('success', 'OTP has been sent to your mail successfully');
                return view('admin.auth.verify-otp', compact('email'));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    /**End method forgetPassword**/


    /**
     * functionName : forgetPassword
     * createdDate  : 04-07-2024
     * purpose      : Forgot password
     */
    public function verifyOtp(Request $request)
    {
        try {
            if ($request->isMethod('get')) {
                return view('admin.auth.verify-otp');
            }

            // POST method: handle OTP verification
            $validator = Validator::make($request->all(), [
                'email'                 => 'required|email:rfc,dns|exists:otp_management,email',
                'otp'                   => 'required|exists:otp_management,otp',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', $validator->errors()->first());
            }

            $email = $request->email;
            if (!$email) {
                return redirect()->route('login')->with('error', 'Session expired. Please request a new code.');
            }

            $otp = OtpManagement::where('email', $request->email)
                ->where('otp', $request->otp)
                ->first();

            if (!$otp) {
                return redirect()->back()->with('error', 'Invalid email or OTP.');
            }

            $startTime = Carbon::parse($otp->updated_at);
            $finishTime = Carbon::now();
            $difference = $startTime->diffInMinutes($finishTime);

            if ($difference > 60) {
                return redirect()->back()->with('error', config('constants.ERROR.TOKEN_EXPIRED'));
            }

            $otp->delete();

            $token = Str::random(64);
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $email],
                ['token' => $token, 'created_at' => now()]
            );

            return redirect()->route('user.reset-password', ['token' => $token]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**End method forgetPassword**/

    /**
     * functionName : resend
     * createdDate  : 04-07-2024
     * purpose      : resend Otp to  mail
     */
    public function resend(Request $request)
    {
        try {
            $userEmail = Session::get('otp_email'); // Store this in session when requesting OTP originally

            if (!$userEmail) {
                return redirect()->route('login')->with('error', 'Session expired. Please start over.');
            }

            $otp = rand(100000, 999999); // Generate new OTP

            // Store in session or DB as needed
            Session::put('otp_code', $otp);

            // You can use your existing mail system or Mailable class
            $this->sendOtp($userEmail);

            return back()->with('success', 'A new OTP has been sent to your email address.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong while resending OTP.');
        }
    }

    /**End method resend**/

    /**
     * functionName : resetPassword
     * createdDate  : 04-07-2024
     * purpose      : Reset your password
     */
    public function resetPassword(Request $request, $token)
    {
        try {
            if ($request->isMethod('get')) {
                $reset = DB::table('password_reset_tokens')->where('token', $token)->first();
                if (!$reset)
                    return redirect()->route('login')->with('error', config('constants.ERROR.SOMETHING_WRONG'));
                $startTime = Carbon::parse($reset->created_at);
                $finishTime = Carbon::parse(now());
                $differnce = $startTime->diffInMinutes($finishTime);

                if ($differnce > 60) {
                    return redirect()->route('forget-password')->with('error', config('constants.ERROR.TOKEN_EXPIRED'));
                }
                return view('admin.auth.reset-password', compact('token'));
            } else {

                $validator = Validator::make($request->all(), [
                    "password"              => "required|confirmed|min:8",
                    "password_confirmation" => "required",
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('error', $validator->errors()->first());
                }

                $reset =  DB::table('password_reset_tokens')->where('token', $token)->first();

                User::where('email', $reset->email)->update(['password' => Hash::make($request->password)]);
                DB::table('password_reset_tokens')->where('token', $token)->delete();

                return redirect()->route('login')->with('success', 'Password ' . config('constants.SUCCESS.UPDATE_DONE'));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    /**End method resetPassword**/

    /**
     * functionName : verifyEmail
     * createdDate  : 04-07-2024
     * purpose      : verify email
     */
    public function verifyEmail($token)
    {
        try {
            $reset = DB::table('password_reset_tokens')->where('token', $token)->first();
            if (!$reset)
                return redirect()->route('company.login')->with('error', config('constants.ERROR.SOMETHING_WRONG'));

            $startTime = Carbon::parse($reset->created_at);
            $finishTime = Carbon::parse(now());
            $differnce = $startTime->diffInMinutes($finishTime);

            if ($differnce > 60) {
                return redirect()->route('company.login')->with('error', config('constants.ERROR.TOKEN_EXPIRED'));
            }

            $reset =  DB::table('password_reset_tokens')->where('token', $token)->first();

            User::where('email', $reset->email)->update(['is_email_verified' => 1, 'email_verified_at' => date('Y-m-d H:i:s')]);
            DB::table('password_reset_tokens')->where('token', $token)->delete();

            $user = User::where('email', $reset->email)->first();

            if ($user->role_id == 3) {
                return redirect()->route('company.login')->with('success', 'Password reset email has been sent successfully');
            } else if ($user->role_id == 1) {
                return redirect()->route('admin.login')->with('success', 'Password reset email has been sent successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    /**End method loginForm**/


    /**
     * functionName : sendOtp
     * createdDate  : 12-04-2025
     * purpose      : send otp email
     */
    public function sendOtp($email)
    {
        try {
            $user = User::where('email', $email)->first();
            do {
                $otp  = rand(1000, 9999);
            } while (OtpManagement::where('otp', $otp)->count());

            OtpManagement::updateOrCreate(['email' => $user->email], ['otp'   => $otp,]);

            $template = $this->getTemplateByName('Forget_password');
            if ($template) {
                $stringToReplace    = ['{{$name}}', '{{$otp}}'];
                $stringReplaceWith  = [$user->full_name, $otp];
                $newval             = str_replace($stringToReplace, $stringReplaceWith, $template->template);
                $emailData          = $this->mailData($user->email, $template->subject, $newval, 'Forget_password', $template->id);
                $this->mailSend($emailData);
            }
            Session::put('otp_email', $email);
            Session::put('otp_code', $otp);

            return true;
        } catch (\Exception $e) {
            return $this->apiResponse('error', 400, $e->getMessage());
        }
    }

    /*end method sendOtp */
}
