@extends('admin.layout.head')
@section('admin')

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <form action="{{url('/admin/archive_data')}}" method="post" enctype="multipart/form-data">
                    @csrf  
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Hello, <span>Welcome {{Auth::user()->first_name}}</span></h1>
                            </div>
                            <div class="page-title float-right">
                                <h1>Total : <span>$</span><span class="total">{{$total}}</span></h1><button type="submit"  class="btn btn-primary">Archive</button>
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

                @if(session()->has('error'))
                    <div class="alert alert-danger" id="myDIV" role="alert">
                        <strong>{{session()->get('error')}}</strong> 
                        <i class="fa fa-close closeicon" onclick="hide()" aria-hidden="true"></i>                                                  
                    </div>
                @endif

                
                
                    <input type="hidden" name="archiveTotal" class="archiveTotal" value="{{$total}}">    
                    <section id="main-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <h6>Total : <span>$</span><span class="totalRoom">{{$sum_room}}</span></h6> 
                                    <div class="bootstrap-data-table-panel">
                                        
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>       
                                                        <th><input checked type="checkbox"  id="checkAll" ></th>                                             
                                                        <th>Room #</th>
                                                        <th>Date</th>
                                                        <th>Amount</th>                                                                                                    
                                                    </tr>
                                                </thead>    
                                                <tbody class="data">
                                                    <?php if($get_rooms){
                                                        foreach ($get_rooms as $key => $get_room) {  ?>
                                                            <tr>
                                                                <td><input checked type="checkbox"  data-price="{{$get_room->amount}}" class="rooms_check" name="rooms_amount[]" value="{{$get_room->id}}"> </td>
                                                                <td>{{$get_room->room_number}}</td>
                                                                <td>{{date('d M Y', strtotime($get_room->date))}}</td>
                                                                <td>${{$get_room->amount}}</td>                                                                                                                                                                                                                                                                                                                    
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
                                                        <th><input checked type="checkbox"  id="checkAllExpenses" ></th>
                                                        <th>Date</th>
                                                        <th>Name</th>
                                                        <th>Amount</th>                                                                                                    
                                                    </tr>
                                                </thead>    
                                                <tbody class="expenseData">
                                                    <?php if($get_expense){
                                                        foreach ($get_expense as $key => $expense) {  ?>
                                                            <tr>
                                                                <td><input checked type="checkbox" class="expense_check" data-price="{{$expense->amount}}" name="expense_amount[]" value="{{$expense->expense_id}}"> </td>
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
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $("#checkAll").click(function(){
            $('.rooms_check').not(this).prop('checked', this.checked);
            getTotalRoomsAmount();
        });

        $(".rooms_check").change(function(){
            if (!$(this).prop("checked")){
                $("#checkAll").prop("checked",false);
            }
            getTotalRoomsAmount();
        });


        $("#checkAllExpenses").click(function(){
            $('.expense_check').not(this).prop('checked', this.checked);
            getTotalExpenseAmount();
        });

        $(".expense_check").change(function(){
            if (!$(this).prop("checked")){
                $("#checkAllExpenses").prop("checked",false);
            }
            getTotalExpenseAmount();
        });

        // function getTotal(isInit) {

        // var total = 0;
        // var selector = isInit ? ".rooms_check" : ".rooms_check:checked";
        // $(selector).each(function() {
        //   total += parseInt($(this).attr('data-price'););
        // });
        // if (total == 0) {
        //   $('#total1').val('');
        // } else {
        //   alert(total);
        // }

        // }

        function getTotalRoomsAmount(isInit) {

            var total = 0;
            var selector = isInit ? ".rooms_check" : ".rooms_check:checked";
            $(selector).each(function() {
            total += parseInt($(this).attr('data-price'));
            });
            //$("#tot_amount").val(sum.toFixed(3));

            if (total == 0) {
                $('.totalRoom').html(0);
            } else {
                $('.totalRoom').html(total);
            }

            var total_expense = parseInt($('.totalExpense').html());
            var total_room_amount = parseInt($('.totalRoom').html());
            var total_balance = total_room_amount-total_expense;

            $('.total').html(total_balance);
            $('.archiveTotal').val(total_balance);
            

        }

        function getTotalExpenseAmount(isInit) {

            var total = 0;
            var selector = isInit ? ".expense_check" : ".expense_check:checked";
            $(selector).each(function() {
            total += parseInt($(this).attr('data-price'));
            });
            //$("#tot_amount").val(sum.toFixed(3));

            if (total == 0) {
                $('.totalExpense').html(0); 
            } else {
            $('.totalExpense').html(total);
            }

            var total_expense = parseInt($('.totalExpense').html());
            var total_room_amount = parseInt($('.totalRoom').html());
            var total_balance = total_room_amount-total_expense;

            $('.total').html(total_balance);
            $('.archiveTotal').val(total_balance);
        }

    </script>

@endsection

   