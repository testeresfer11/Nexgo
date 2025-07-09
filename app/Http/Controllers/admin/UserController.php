<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\{User, Rides, Bookings, Cars, Reviews, Messages,Notifications,Country,BankDetail};
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator,Hash,Storage};
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class UserController extends Controller
{
    /**
     * functionName : getList
     * createdDate  : 30-05-2024
     * purpose      : Get the list for all the user
    */
   public function getList(Request $request)
{
    try {
        $query = User::whereNot('role_id', 2)->orderBy('user_id', 'desc');

        // Filter by search keyword
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                  ->orWhere('last_name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
       if ($request->filled('start_date') && $request->filled('end_date')) {
    // Both dates are filled, filter between the range
    $startDate = $request->start_date . ' 00:00:00'; // Ensure it's at the start of the day
    $endDate = $request->end_date . ' 23:59:59'; // Ensure it's at the end of the day

    $query->whereBetween('created_at', [$startDate, $endDate]);


        } elseif ($request->filled('start_date')) {
            // Only start date is filled, filter from start_date onwards
                $query->where('created_at', '>=', $request->start_date);

        } elseif ($request->filled('end_date')) {
            // Only end date is filled, filter up to end_date
            $query->where('created_at', '<=', $request->end_date);
        }

        // Paginate results
        $users = $query->paginate(10);

        return view("admin.user.list", compact("users"));
    } catch (\Exception $e) {
        return redirect()->back()->with("error", $e->getMessage());
    }
}

	
public function deletedUser(Request $request){
    try{    

        $search = $request->input('search');

        // Get all column names of the users table
        $columns = Schema::getColumnListing('users');

        // Start the query for users where role_id is not 2 (assuming role 2 is excluded)
        $query = User::onlyTrashed();

        // Apply the search condition across columns
        if($search){
            $query->where(function ($q) use ($columns, $search) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', "%{$search}%");
                }

                // Additional condition: combine first_name and last_name for a full name search
                $q->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"]);
            });
        }

        // Paginate the results
        $users = $query->paginate(10);

        //$users = User::onlyTrashed()->paginate(10);
        return view("admin.user.deleted_list",compact("users"));
    }catch(\Exception $e){
        return redirect()->back()->with("error", $e->getMessage());
    }
}
    
    
    
    public function restore($id){
    $user = User::withTrashed()->findOrFail($id);
    $user->restore();

    return response()->json(['success' => true]);
}

   public function search(Request $request)
{
    try {
        $search = $request->input('search');

        // Get all column names of the users table
        $columns = Schema::getColumnListing('users');

        // Start the query for users where role_id is not 2 (assuming role 2 is excluded)
        $query = User::where('role_id', '!=', 2);

        // Apply the search condition across columns
        $query->where(function ($q) use ($columns, $search) {
            foreach ($columns as $column) {
                $q->orWhere($column, 'LIKE', "%{$search}%");
            }

            // Additional condition: combine first_name and last_name for a full name search
            $q->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"]);
        });

        // Paginate the results
        $users = $query->paginate(10);

        return view("admin.user.list", compact("users"));
    } catch (\Exception $e) {
        return redirect()->back()->with("error", $e->getMessage());
    }
}


    /**End method getList**/

    /**
     * functionName : add
     * createdDate  : 31-05-2024
     * purpose      : add the user
    */
  public function add(Request $request) 
{
    try {
        if ($request->isMethod('get')) {
            return view("admin.user.add");
        }

        if ($request->isMethod('post')) {
            // Validate input data
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name'  => 'required|string|max:255',
                'email' => 'required|email:rfc,dns|unique:users,email',
                'phone_number' => 'nullable|numeric|digits_between:8,15|unique:users,phone_number',
                'password' => 'required|min:8|confirmed',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'license' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
                'national_id' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
                'technical_inspection_certificate' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
                'registration_certificate' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
                'insurance' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // File fields
            $files = [
                'profile_picture',
                'license',
                'national_id',
                'technical_inspection_certificate',
                'registration_certificate',
                'insurance',
            ];

            $uploaded = [];

            foreach ($files as $field) {
                if ($request->hasFile($field)) {
                    $filename = $field . '_' . time() . '.' . $request->file($field)->extension();
                    $request->file($field)->storeAs('public/users', $filename);
                    $uploaded[$field] = $filename;
                } else {
                    $uploaded[$field] = null;
                }
            }

            // Create user
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'bio' => $request->bio,
                'country_code' => $request->country_code,
                'phone_number' => $request->phone_number ?? '',
                'profile_picture' => $uploaded['profile_picture'],
                'license' => $uploaded['license'],
                'national_id' => $uploaded['national_id'],
                'technical_inspection_certificate' => $uploaded['technical_inspection_certificate'],
                'registration_certificate' => $uploaded['registration_certificate'],
                'insurance' => $uploaded['insurance'],
                'join_date' => Carbon::now()
            ]);

            return redirect()->route('admin.user.list')->with('success', 'User added successfully.');
        }

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}

    /**End method add**/

    /**
     * functionName : view
     * createdDate  : 31-05-2024
     * purpose      : Get the detail of specific user
    */
    public function view($id){
        try{
            $user = User::findOrFail($id);

            if($user && $user->verify_id != "")
            {
                $user->verify_id=$this->getStatusString($user->verify_id);
                // $age= $this->calculateAge($user->dob);
                // if($age != 0)
                // {
                //     $user->dob=$age;
                // }
                // else
                // {
                //     $user->dob='-'; 
                // }

            }

            
            // print_r($user);
            // die();
            $cars = Cars::join('users', 'users.user_id', '=', 'cars.user_id')
            ->select('cars.*')
            ->where('users.user_id',$id)
            ->orderBy('cars.car_id', 'desc')
            ->paginate(10);

            $rides = Rides::join('users', 'users.user_id', '=', 'rides.driver_id')
            ->select('users.*', 'rides.*')
            ->where('rides.driver_id',$id)
            ->orderBy('rides.ride_id', 'desc')
            ->paginate(10);

            $bankDetails = BankDetail::where('user_id',$id)->first();

          
            $requests = Bookings::join('users', 'users.user_id', '=', 'bookings.passenger_id')
                    ->join('rides', 'rides.ride_id', '=', 'bookings.ride_id')
                    ->select('users.*', 'rides.*', 'bookings.*')
                    ->where('bookings.passenger_id',$id)
                    ->orderBy('bookings.booking_id', 'desc')
                    ->paginate(10);

                    

          $reviews = Reviews::join('rides', 'rides.ride_id', '=', 'reviews.ride_id')
                    ->join('users as driver', 'rides.driver_id', '=', 'driver.user_id') // Join for driver information
                    ->join('users as reviewer', 'reviews.reviewer_id', '=', 'reviewer.user_id') // Join for reviewer information
                    ->select(
                        'driver.first_name as driver_first_name',
                        'reviewer.first_name as reviewer_first_name', 
                        'reviewer.last_name as reviewer_id',// Select reviewer first name
                        'rides.*',
                        'reviews.*'
                    )
                    ->where('reviews.reviewer_id', $id) // Filtering by receiver_id matching authenticated user
                    ->orderBy('reviews.reviewer_id', 'desc')
                    ->paginate(10);

            
            $messages = Messages::join('users as sender', 'sender.user_id', '=', 'messages.sender_id')
                    ->join('users as receiver', 'receiver.user_id', '=', 'messages.receiver_id')
                    ->select('sender.first_name as sender_name','receiver.first_name as receiver_name','messages.*')
                    ->where('messages.sender_id',$id)
                    ->orderBy('messages.message_id', 'desc')
                    // ->orWhere('messages.sender_id', $request->p_id)
                    // ->orWhere('messages.receiver_id', $request->p_id)
                    ->paginate(10);
                 
            return view("admin.user.view",compact("user",'rides','requests','cars','reviews','messages','bankDetails'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    /**End method view**/

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

    /**
     * functionName : edit
     * createdDate  : 31-05-2024
     * purpose      : edit the user detail
    */
public function edit(Request $request, $id)
{
    try {
        if ($request->isMethod('get')) {
            $user = User::findOrFail($id);
            $country_shortname = 'au'; // Default

            if ($user->country_code) {
                $code = str_replace("+", "", $user->country_code);
                $country = Country::where('phonecode', $code)->first();
                if ($country) {
                    $country_shortname = $country->shortname;
                }
            }

            return view("admin.user.edit", compact('user', 'country_shortname'));
        }

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone_number' => 'nullable|numeric|digits_between:8,15|unique:users,phone_number,' . $id . ',user_id',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'license' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
                'national_id' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
                'technical_inspection_certificate' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
                'registration_certificate' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
                'insurance' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = User::findOrFail($id);

            $fileFields = [
                'profile_picture',
                'license',
                'national_id',
                'technical_inspection_certificate',
                'registration_certificate',
                'insurance',
            ];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    // Delete old file
                    $oldFile = $user->{$field};
                    if ($oldFile && Storage::exists('public/users/' . $oldFile)) {
                        Storage::delete('public/users/' . $oldFile);
                    }

                    // Upload new file
                    $filename = $field . '_' . time() . '.' . $request->file($field)->extension();
                    $request->file($field)->storeAs('public/users', $filename);
                    $user->{$field} = $filename;
                }
            }

            // Update user fields
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->country_code = $request->country_code;
            $user->phone_number = $request->phone_number;
            $user->bio = $request->bio;
            $user->save();

            return redirect()->route('admin.user.list')->with('success', 'User updated successfully.');
        }
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}



    /**End method edit**/

    /**
     * functionName : delete
     * createdDate  : 31-05-2024
     * purpose      : Delete the user by id
    */
    public function delete($id){
        try{
            // $ImgName = User::find($id)->userDetail->profile;

            // if($ImgName != null){
            //     deleteFile($ImgName,'images/');
            // }
            User::where('user_id',$id)->delete();

            return response()->json(["status" => "success","message" => "User ".config('constants.SUCCESS.DELETE_DONE')], 200);
        }catch(\Exception $e){
            return response()->json(["status" =>"error", $e->getMessage()],500);
        }
    }
    /**End method delete**/

    /**
     * functionName : changeStatus
     * createdDate  : 31-05-2024
     * purpose      : Update the user status
    */
    public function changeStatus(Request $request){
        try{
            
            $validator = Validator::make($request->all(), [
                'id'        => 'required',
                "status"    => "required|in:0,1",
            ]);
            if ($validator->fails()) {
                if($request->ajax()){
                    return response()->json(["status" =>"error", "message" => $validator->errors()->first()],422);
                }
            }
           
            User::where('user_id',$request->id)->update(['status' => $request->status]);

            return response()->json(["status" => "success","message" => "User status ".config('constants.SUCCESS.CHANGED_DONE')], 200);
        }catch(\Exception $e){
            return response()->json(["status" =>"error", $e->getMessage()],500);
        }
    }
    /**End method changeStatus**/

    private function getStatusString($status)
    {
        switch ($status) {
            case 1:
                return 'Pending';
            case 2:
                return 'Approved';
            case 3:
                return 'Rejected';
            default:
                return 'Unknown';
        }
    }

    public function getNotifications(Request $request){
        try{
                 
        }catch(\Exception $e){
            return response()->json(["status" =>"error", $e->getMessage()],500);
        }
    }


   public function notifications(Request $request){
    try{
        // Get all notifications ordered by created_at
        $notifications = Notifications::orderBy('created_at', 'desc')->paginate(10);

        // Mark all notifications as read
        Notifications::where('read_status', 0)->update(['read_status' => 1]);

        return view('admin.notifications.list', compact('notifications'));
    } catch (\Exception $e) {
        return response()->json(["status" => "error", $e->getMessage()], 500);
    }
}


    public function notificationsView(Request $request,$notify, $id)
    {
        try{

            $notifications= Notifications::where('notification_id', $notify)->first();

            $notifications->read_status=1;

            $notifications->update();

            $user = User::where('user_id', $id)->first();

            return redirect()->route("admin.user.view", ['id' => $id] );
        }catch(\Exception $e){
            return response()->json(["status" =>"error", $e->getMessage()],500);
        }
    }



}
