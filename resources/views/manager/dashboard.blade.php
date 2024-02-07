@extends('manager.layout.head')
@section('manager')

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Hello, <span>Welcome {{Auth::user()->first_name}}</span></h1>
                            </div>
                            <div class="page-title float-right">
                                <h1>Total : <span>$</span><span class="total">{{$total}}</span></h1>
                            </div>
                        </div>
                    </div>                                        
                </div>

                @if(session()->has('success'))
                    <div class="alert alert-success" id="myDIV" role="alert">
                        <strong>{{session()->get('success')}}</strong> 
                        <i class="fa fa-close closeicon" onclick="hide()" aria-hidden="true"></i>                                                   
                    </div>
                @endif

                <section id="main-content">
                    <div class="row">                        
                        <div class="col-lg-6">
                            <h5>New Booking</h5>
                            <div class="card">                                
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>                                                    
                                                    <th>Room #</th>
                                                    <th>Date</th>
                                                    <th>Amount</th>                                                   
                                                    <th>Action</th>                                                   
                                                </tr>
                                            </thead>
                                            <tbody>                                               
                                                <tr>
                                                    <td><input type="text" id="room_number" class="form-control room_number" value="{{old('room_number')}}" placeholder="Enter room number" name="room_number"></td>
                                                    <td><input type="date" id="date" class="form-control date" placeholder="Select" name="date"></td>
                                                    <td><input type="text" id="amount" class="form-control amount" value="{{old('amount')}}" placeholder="Enter amount" onkeypress="return isNumberKey(event)" name="amount"></td>                                                                                                                                                            
                                                    <td><button type="submit" class="btn btn-info addnew">+ Book</button></td>                                                                                                                                                            
                                                </tr>                                                                                                                                                                                          
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h5>New Expense</h5>
                            <div class="card">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>                                                                                                     
                                                    <th>Date</th>
                                                    <th>Amount</th>                                                   
                                                    <th>Action</th>                                                   
                                                </tr>
                                            </thead>
                                            <tbody>                                               
                                                <tr>                                                    
                                                    <td><input type="date" class="form-control expenseDate" placeholder="Select" name="date"></td>
                                                    <td><input type="text" class="form-control expenseAmount" placeholder="Enter amount" onkeypress="return isNumberKey(event)" name="amount"></td>                                                                                                                                                            
                                                    <td><button type="submit" class="btn btn-info addExpense">+ Add New</button></td>                                                                                                                                                            
                                                </tr>                                                                                                                                                                                          
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <h6>Total : <span>$</span><span class="totalRoom">{{$sum_room}}</span></h6>
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>                                                    
                                                    <th>Room #</th>
                                                    <th>Date</th>
                                                    <th>Amount</th>                                                                                                    
                                                    <th>Action</th>                                                                                                    
                                                </tr>
                                            </thead>    
                                            <tbody class="data">
                                                <?php if($get_rooms){
                                                    foreach ($get_rooms as $key => $get_room) {  ?>
                                                        <tr>
                                                            <td>{{$get_room->room_number}}</td>
                                                            <td>{{date('d M Y', strtotime($get_room->date))}}</td>
                                                            <td>${{$get_room->amount}}</td>                                                                                                                                                                                                                                                                                                                    
                                                            <td><i class="fa fa-trash" aria-hidden="true"></i></td>                                                                                                                                                                                                                                                                                                                    
                                                        </tr>  
                                                   <?php }
                                                } ?>                                                                                                                                                                                                                                                                                      
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <h6>Total : <span>$</span><span class="totalExpense">{{$sum_expense}}</span></h6>
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>                                                    
                                                    <th>Date</th>
                                                    <th>Name</th>
                                                    <th>Amount</th>                                                                                                    
                                                </tr>
                                            </thead>    
                                            <tbody class="expenseData">
                                                <?php if($get_expense){
                                                    foreach ($get_expense as $key => $expense) {  ?>
                                                        <tr>
                                                            <td>{{date('d M Y', strtotime($expense->date))}}</td>
                                                            <td>{{$expense->first_name}} {{$expense->last_name}}</td>
                                                            <td>${{$expense->amount}}</td>                                                                                                                                                                                                                                                                                                                    
                                                        </tr>  
                                                   <?php }
                                                } ?>                                                                                                                                                                                                                                                                                      
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

<script>
    $(document).on('click','.addnew', function(){        
            var room_number = $('.room_number').val();
            var date = $('.date').val();   
            var amount = $('.amount').val();  
            var total_expense_amount =  parseInt($('.totalExpense').text());


            if(room_number == "" || date == "" || amount == "" ){
                alert("Please fill all values.");
                return false;
            }



            $.ajax({
                url:'{{url("/manager/newentry")}}',
                type: "post",
                dataType: 'json',
                data: {room_number: room_number,date: date,amount: amount,"_token": "{{ csrf_token() }}"},
                
                success:function(response){     
                    if(response.status==1)
                    {
                        $('.data').html(response.html); 
                        $('.totalRoom').html(); 
                        $('.totalRoom').html(response.total_amount);
                        var total_balance = response.total_amount-total_expense_amount;
                        $('.total').html(total_balance);

                        $('.room_number').val('');
                        $('.date').val('');
                        $('.amount').val('');
                    }   
                    else
                    {
                        $('.room_number').val('');
                        $('.date').val('');
                        $('.amount').val('');
                        alert(response.message);
                    }      

                    
                }
            }); 
        
    });
</script>

<script>
    $(document).on('click','.addExpense', function(){ 
      
            var expenseDate = $('.expenseDate').val();
            var expenseAmount = $('.expenseAmount').val();  
            var total_room_amount =  parseInt($('.totalRoom').text()); 

            if(expenseDate == "" || expenseAmount == ""){
                alert("Please fill all expense values.");
                return false;
            }

            $.ajax({
                url:'{{url("/manager/expense")}}',
                type: "post",
                dataType: 'json',
                data: {expenseDate: expenseDate,expenseAmount: expenseAmount,"_token": "{{ csrf_token() }}"},
                
                success:function(response){  
                    //console.log(response.html);                       
                    $('.expenseData').html(response.html); 
                    $('.totalExpense').html(response.total_expense); 

                    var total_balance = total_room_amount-response.total_expense;
                    $('.total').html(total_balance);


                    $('.expenseDate').val('');
                    $('.expenseAmount').val('');                    

                }
            }); 
        
    });
</script>
@endsection

   