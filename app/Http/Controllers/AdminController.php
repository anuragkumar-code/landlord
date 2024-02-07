<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function viewLogin(){
        return view('admin/login');
    }

    public function adminLogged(Request $request){
        request()->validate(  
            [               
                'email' => 'required|email',
                'password' => 'required',
            ],
        );
    
        $email = $request->email;     
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password, 'type' => 1])) {

            return redirect('admin/dashboard');

        }else{        
            return back()->with('error', 'Incorrect id or password !');
        }
    }

    public function adminDashboard(){
        $get_rooms = DB::table('rooms')->where('is_archived', 0)->orderBy('id', 'DESC')->get();
        $get_expense = DB::table('expense')->select('users.*','expense.*','expense.id as expense_id')->where('is_archived', 0)->join('users','expense.user_id','=','users.id')->orderBy('expense.id', 'DESC')->get();

        $sum_room = DB::table('rooms')->where('is_archived',0)->sum('amount');
        $sum_expense = DB::table('expense')->where('is_archived', 0)->sum('amount');

        $total = $sum_room - $sum_expense;

        return view ('admin/dashboard',compact('get_rooms','get_expense','sum_room','sum_expense','total'));
    }
    
    public function logout(){
        session()->flush();
        return redirect('/admin/login');
    }

    public function viewManagers(){
        $get_managers = DB::table('users')->where('type', 2)->get();
        return view ('admin/managers', compact('get_managers'));
    }

    public function viewAddManager(){

        return view('admin/addmanager');
    }

    public function addManager(Request $request){
        request()->validate(
            [
                'first_name' => 'required|regex:/^[a-zA-Z]+$/u',                
                'email' => 'required|email|unique:users|regex:/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',
                'password' => 'required',
                'confirm_password' => 'same:password',
                'mobile' => 'required',            
            ],
            [
                'first_name.required' => 'First Name is required.',                
                'email.required' => 'Email is required.',
                'password.required' => 'Password is required.',
                'mobile.required' => 'Mobile number is required.',
                
            ]
        );

        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $password = Hash::make($request->password);
        $mobile = $request->mobile;

        DB::table('users')->insert([
            'type' => 2,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password,
            'mobile' => $mobile,

            'updated_at' => NOW(),
            'created_at' => NOW()
        ]);

        return redirect('/admin/managers')->with('success', 'Manager added sucessfully!!');
    }

    public function editManager($id){
        $id = base64_decode($id);
        $get_manager = DB::table('users')->where('id', $id)->first();

        // echo "<pre>"; print_r($get_manager); exit;
        return view('admin/editmanager',compact('get_manager'));
    }

    public function editedManager(Request $request){
        request()->validate(
            [
                'first_name' => 'required',                
                'mobile' => 'required',
                'password' => 'nullable',
                'confirm_password' => 'same:password',                
            ],
            [
                'first_name.required' => 'First Name is required.',                             
                'mobile.required' => 'Mobile number is required.',
                'password.required' => 'Password is required.',                
            ]
        );

        $id = $request->id;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $mobile = $request->mobile;

        $get_user = DB::table('users')->where('id', $id)->first();
        $password = $get_user->password;

        if($request->password){
            $password = Hash::make($request->password);
        }

        DB::table('users')->where('id', $id)->update([
            'first_name' => $first_name,
            'last_name' => $last_name,            
            'password' => $password,
            'mobile' => $mobile,            
            'updated_at' => NOW(),
        ]);

        return redirect('admin/managers')->with('success', 'Manager details updated.');
    }

    public function deleteManager($id){
        DB::table('users')->where('id', $id)->delete();

        return back()->with('error', 'Manager deleted.');
    }

    public function archive_data(Request $request){
        //$all_expenses[0]=0;
        $all_rooms = array('0'=>0);
        $expense = $rooms = '';
        $all_expenses = $request->expense_amount;
        $all_rooms = $request->rooms_amount;

        $archiveTotal = $request->archiveTotal;


        if(!empty($all_expenses))
        {
            DB::table('expense')->whereIn('id',$all_expenses)->update([
                'is_archived' => 1,            
                'updated_at' => NOW()
            ]);

            $expense = implode(',', $all_expenses);
        }

        if(!empty($all_rooms))
        {

            DB::table('rooms')->whereIn('id',$all_rooms)->update([
                'is_archived' => 1,            
                'updated_at' => NOW()
            ]);

            $rooms = implode(',', $all_rooms);
        }

        DB::table('archives')->insert([
            'total_amt' => $archiveTotal,           
            'rooms' => $rooms,           
            'expenses' => $expense,           

            'updated_at' => NOW(),
            'created_at' => NOW()
        ]);

        return back()->with('success', 'Successfully archived.');

    }

    public function archiveHistory(){

        $get_data = DB::table('archives')->get();

        // echo "<pre>"; print_r($get_rooms); exit;

        return view('admin/archivehistory',compact('get_data'));
    }

    public function history_detail($id=0)
    {
        $expenses_id = $room_id =  array(0);
        $expense_detail = DB::table('archives')->where('id', $id)->first();

        $expenses_id = explode(',',$expense_detail->expenses);
        $room_id = explode(',',$expense_detail->rooms);

        $sum_room = DB::table('rooms')->whereIn('id',$room_id)->sum('amount');
        $sum_expense = DB::table('expense')->whereIn('id',$expenses_id)->sum('amount');

        $total = $sum_room - $sum_expense;

        $get_expense = DB::table('expense')->whereIn('expense.id',$expenses_id)->join('users','expense.user_id','=','users.id')->orderBy('expense.id', 'DESC')->get();

        $get_rooms = DB::table('rooms')->whereIn('id',$room_id)->orderBy('id', 'DESC')->get();

        return view('admin/history_detail', compact('get_expense','sum_expense','get_rooms','sum_room','total'));
    }

    public function changepassword()
    {
        return view('admin/changepassword');
    }

    public function updatepassword(Request $request)
    {
        $user_id = Auth::id();

        request()->validate([
            'current_password'=>'required',
            'new_password'=>'required',
            'confirm_password'=>'required|same:new_password',
            ]);
        
        $current_password = $request->current_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;

        $candidate_user_password = Auth::user()->password;

        if (!(Hash::check($current_password, $candidate_user_password))) 
        {
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again!");
        }else if(strcmp($current_password, $new_password) == 0){
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password!");
        }else if($new_password == $confirm_password){
            DB::table('users')
            ->where('id', $user_id)
            ->update(['password' => Hash::make($new_password)]);
            return redirect()->back()->with("success","Password changed successfully!");
        }else{
             return redirect()->back()->with("error","New Password and confirm password does not match!");
        }
    }

    
}
