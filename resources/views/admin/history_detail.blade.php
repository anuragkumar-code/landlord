@extends('admin.layout.head')
@section('admin')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">

		    <div class="row">   
		    	<div class="page-title float-right col-lg-12">
	                <h4 class="float-right">Total : $<span class="total">{{$total}}</span></h4>
	            </div>
		    	<div class="col-lg-6">
		    	 	<h5>All Booking</h5>
		            <div class="card">
		                <h6>Total : <span class="totalExpense">$<?php echo $sum_room; ?></span></h6>
		                <div class="bootstrap-data-table-panel">
		                    <div class="table-responsive">
		                        <table class="table table-striped table-bordered">
		                            <thead>
		                                <tr>     
		                                    <th>Room #</th>
                                            <th>Date</th>
                                            <th>Amount</th>                                                                                                    
		                                </tr>
		                            </thead>    
		                            <tbody class="expenseData">
		                            	<?php 
		                            	if($get_rooms)
		                            	{
                                        	foreach ($get_rooms as $key => $get_room) 
                                        	{  
                                        	?>
	                                            <tr>
	                                                <td>{{$get_room->room_number}}</td>
	                                                <td>{{date('d M Y', strtotime($get_room->date))}}</td>
	                                                <td>${{$get_room->amount}}</td>                                                                                                                                                                                                                                                                                                                    
	                                            </tr>  
                                       		<?php 
                                       		}
                                    	} 
                                    	?>                                                                                                                                                                                                                                                                                       
		                            </tbody>
		                        </table>
		                    </div>
		                </div>
		            </div>
		        </div>

		        <div class="col-lg-6">
		    	 	 <h5>All Expense</h5>
		            <div class="card">
		                <h6>Total : <span class="totalExpense">$<?php echo $sum_expense; ?></span></h6>
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
                                            foreach ($get_expense as $key => $expense) 
                                            {  ?>
				                                <tr>
		                                            <td>{{date('d M Y', strtotime($expense->date))}}</td>
		                                            <td>{{$expense->first_name}} {{$expense->last_name}}</td>
		                                            <td>${{$expense->amount}}</td>                                                                                                                                                                                                                                                                                                                    
		                                        </tr> 
		                                    <?php 
		                                    }
		                                }
		                                ?>                                                                                                                                                                                                                                                                                       
		                            </tbody>
		                        </table>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
     	</div>
    </div>
</div>

@endsection