<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function managerLogin(){
        return view('manager/login');
    }

    public function managerLogged(Request $request){
     
        request()->validate(  
            [               
                'email' => 'required|email',
                'password' => 'required',
            ],
        );
    
        $email = $request->email;     
        $password = $request->password;

        $check = DB::table('users')->where('email',$email)->first();

        // echo "<pre>"; print_r($check); exit;

        if($check->is_logged == 0){

            if (Auth::attempt(['email' => $email, 'password' => $password, 'type' => 2])) {


                DB::table('users')->where('email',$email)->update(['is_logged'=>1]);

                return redirect('/manager/dashboard');

            }else{        
                return back()->with('error', 'Incorrect id or password !');
            }

        }else{

            // return redirect('/manager/force_login');
            return back()->with('error','User has been already logged in to the system.');
        }
    }



    public function managerDashboard(){

        // $clientIP = request()->ip();
        // echo $clientIP; exit;
        $get_rooms = DB::table('rooms')->where('is_archived', 0)->orderBy('id', 'DESC')->get();
        $get_expense = DB::table('expense')->where('is_archived', 0)->join('users','expense.user_id','=','users.id')->orderBy('expense.id', 'DESC')->get();

        $sum_room = DB::table('rooms')->where('is_archived',0)->sum('amount');
        $sum_expense = DB::table('expense')->where('is_archived', 0)->sum('amount');

        $total = $sum_room - $sum_expense;

        return view ('/manager/dashboard',compact('get_rooms','get_expense','sum_room','sum_expense','total'));
    }
    
    public function managerLogout(){

        $id = Auth::user()->id;

        DB::table('users')->where('id',$id)->update(['is_logged'=>0]);

        session()->flush();
        return redirect('/');
    }


    public function newEntry(Request $request){

        $room_number = $request->room_number;
        $date = $request->date;
        $amount = $request->amount;

        $data_chk = DB::table('rooms')->where('room_number', $room_number)->where('date', $date)->count();
        if($data_chk == 1){

            $response['status'] = 0;
            $response['message'] = 'Room already booked for this date';
            echo json_encode($response);      
            exit;
        }else{

            DB::table('rooms')->insert([
                'user_id' => Auth::id(),
                'room_number' => $room_number,
                'amount' => $amount,
                'date' => $date,
                'updated_at' => NOW(),
                'created_at' => NOW()
            ]);
    
            $get_data = DB::table('rooms')->where('is_archived', 0)->orderBy('id', 'DESC')->get();
            $html = '';
            $total_amount = 0;
            if($get_data){
                foreach ($get_data as $key => $data) {
                    $total_amount+=$data->amount;
                    $html .='<tr>
                        <td>'. $data->room_number .'</td>
                        <td>'. date('d M Y', strtotime($data->date)) .'</td>
                        <td>$'. $data->amount .'</td>                                                                                                                                        
                    </tr>';
                }
            }    

            $response['html'] = $html;
            $response['total_amount'] = $total_amount;
            $response['status'] = 1;
            echo json_encode($response);      

            exit;
        }
      
    }

    public function newExpense(Request $request){
        $expenseDate = $request->expenseDate;
        $expenseAmount = $request->expenseAmount;

        DB::table('expense')->insert([
            'user_id' => Auth::id(),
            'date' => $expenseDate,
            'amount' => $expenseAmount
        ]);

        $get_expense = DB::table('expense')->where('is_archived', 0)->join('users','expense.user_id','=','users.id')->orderBy('expense.id', 'DESC')->orderBy('expense.id', 'DESC')->get();
        $html = '';
        $total_expenses = 0;
        if($get_expense){
            foreach ($get_expense as $key => $expense) {
                $total_expenses+=$expense->amount;
                $html .='
                <tr>
                    <td>'. date('d M Y', strtotime($expense->date)) .'</td>
                    <td>'. $expense->first_name . $expense->last_name  .'</td>
                    <td>$'. $expense->amount .'</td>
                    <td><i class="fa fa-trash" aria-hidden="true"></i></td>                                                                                                                                                                                                                                                                                                                  
                </tr>';
            }
        }    
        $response['html'] = $html;
        $response['total_expense'] = $total_expenses;
        echo json_encode($response);
        exit;
    }

    public function changepassword()
    {
        return view('manager/changepassword');
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
