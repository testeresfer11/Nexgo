<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\{Validator,Hash,Storage};
use Illuminate\Support\Facades\Schema;
use App\Traits\SendResponseTrait;

class DocumentController extends Controller
{
    use SendResponseTrait;

    public function getList(){
        try{

        $documents = User::where('role_id', '!=', 2)
            ->whereIn('verify_id', [4])
            ->latest() 
            ->get();

           

            foreach($documents as $value)
            {
                $value->verify_id = $this->getStatusString($value->verify_id);
            }
            
            // print_r($users);
            // die();

            return view("admin.document.list",compact("documents"));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function search(Request $request){
        try{

            $search = $request->input('search');

            // Get all column names of the vehicles table
            $columns = Schema::getColumnListing('users');

            // Query builder for the search
            $query = User::query();

            // Apply search to each column
        /*    
	foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', "%{$search}%");
                $query->whereNot('id_card','');
                $query->where('verify_id','1');
            }
*/

        // Apply the search condition across columns
        $query->where(function ($q) use ($columns, $search) {
            foreach ($columns as $column) {
                $q->orWhere($column, 'LIKE', "%{$search}%");
            }

            // Additional condition: combine first_name and last_name for a full name search
            $q->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"]);
        });

            

            $documents = $query->paginate(10);

            return view("admin.document.list",compact("documents"));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    private function getStatusString($status)
    {
        switch ($status) {
            case  1:
                return 'Pending';
            case 2:
                return 'Confirmed';
            case 3:
                return 'Rejected';
            default:
                return 'Pending';
        }
    }


        /**
     * functionName : changeStatus
     * createdDate  : 31-05-2024
     * purpose      : Update the user status
    */
 public function changeStatus(Request $request)
{
    try {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'id'     => 'required|exists:users,user_id',
            'status' => 'required', // Only allow 1 (Rejected) or 2 (Approved)
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status"  => "error",
                "message" => $validator->errors()->first()
            ], 422);
        }

        // Fetch user
        $user = User::where('user_id', $request->id)->firstOrFail();
        $user->verify_id = $request->status;

        // Notification data
        if ($request->status == 2) {
            // Approved
            $notificationData = [
                'title' => 'Document approved',
                'body'  => 'Your document has been approved by the admin.',
                'type'  => 'document_approved',
                'ride_id' => null,
            ];
        } else {
            // Rejected
            $notificationData = [
                'title' => 'Document rejected',
                'body'  => 'Your document has been rejected by the admin.',
                'type'  => 'document_rejected',
                'ride_id' => null,
            ];

            // Document fields
            $documentFields = [
                'license_front',
                'license_back',
                'national_id_front',
                'national_id_back',
                'technical_inspection_certificate_front',
                'technical_inspection_certificate_back',
                'registration_certificate_front',
                'registration_certificate_back',
                'insurance_front',
                'insurance_back',
            ];

            // Delete files & nullify DB columns
            foreach ($documentFields as $field) {
                if ($user->$field) {
                    \Storage::disk('public')->delete($user->$field); // use correct disk
                    $user->$field = null;
                }
            }
        }

        $user->save();

        // Send push notification
        if ($user->fcm_token) {
            if ($user->device_type === 'ios') {
                $this->sendPushNotificationios(
                    $user->fcm_token,
                    $notificationData['title'],
                    $notificationData['body'],
                    $notificationData['type'],
                    $notificationData['ride_id']
                );
            } else {
                $this->sendPushNotification(
                    $user->fcm_token,
                    $notificationData['title'],
                    $notificationData['body'],
                    $notificationData['type'],
                    $notificationData['ride_id']
                );
            }
        }

        // Response
        return response()->json([
            "status"  => "success",
            "message" => $request->status == 2
                ? "User document approved"
                : "User document rejected and removed"
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            "status"  => "error",
            "message" => $e->getMessage()
        ], 500);
    }
}

    /**End method changeStatus**/
}
