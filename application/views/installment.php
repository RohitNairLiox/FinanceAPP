<div class="box">
    <div class="box-body table-responsive">
		<table id='tab1' class='table table-bordered table-striped'>
			<thead>
				<tr>
				  	<th>Loan</th>
				  	<th>Borrower Name</th>
				  	<th>Loan Amount</th>
				  	<th>Rate</th>
				  	<th>Installment Duration(days)</th>
				  	<th>Loan Period(Months)</th>
				  	<th>Payoff date</th>
				  	<th>Status</th>		  			
				</tr>
			</thead>
			<tbody>
				<?php
					if(!isset($loan)):
						echo "<tr><td colspan='5' align='center'>No Record Found!</td></tr>";
					else :
					foreach ($loan as $row)
					{
				?>					
				<tr>
					<td><a href="<?php echo base_url().'loan/view/'.$row['loan_id'];?>"><?php echo $row['loanname']; ?></a></td>
				  	<td><b><a href="<?php echo base_url().'borrower/index/'.$row['borrower_id'];?>"><?php echo $row['firstname'] ." " . $row['lastname']; ?></a></b></td>
				  	<td><?php echo $row['amount']; ?></td>
				  	<td><?php echo $row['rate']; ?></td>
				  	<td><?php echo $row['installment_duration']; ?></td>
			  		<td><?php echo $row['duration_in_month']; ?></td>
				  	<td><?php echo $row['payoff_date']; ?></td>
					<td>
						<?php 
							if($row['status']=="1") {
								echo '<span class="label label-success">Active</span>';
							}
							else {
								echo '<span class="label label-danger">Deactive</span>';
							}
						?>
					</td>
				</tr>	
				<?php } endif; ?>								
			</tbody>
		</table>
	</div>
</div>
<div class="panel panel-default">
  <div class="panel-heading"><h3>Pay Installment</h3></div>
  <div class="panel-body">
  	<!-- .form-->
		<div class="col-md-12">
			<div class="box box-warning">
				<div class="box-body">
					<div class="row">
					</div>
					<?php
						echo form_open('borrower/save_installment', array('name' => 'addinstaform')); 
						//dsm($borrower[0]['firstname']); die;
					?>
					<input type="hidden" class="form-control" id="borrower_id" name="borrower_id" value="<?php echo $borrower[0]['borrower_id']; ?>"/>
					<div class="form-group">
						<div class="col-md-6">
							<label>Borrower First Name</label>
							<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $borrower[0]['firstname']; ?>"/>
						</div>
						<div class="col-md-6">
							<label>Borrower Last Name</label>
							<input type="text" class="form-control" value="<?php echo $borrower[0]['lastname']; ?>" id="lastname" name="lastname" placeholder="Enter Borrower Last Name" required/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
							<label>Loan</label>
							<?php 
								$select_array_loan=$sel_loan;
								$count=count($select_array_loan);
								if($count=="1") {
									$date = date_create($select_array_loan[0]['start_date']); 
									$key=$select_array_loan[0]['amount']." for ".$select_array_loan[0]['rate']."% on ". date_format($date,"M-Y");
									$select_array_loan[0]['key'] = $key;
									echo generate_combobox('loanid',$select_array_loan,'loan_id','key',$select_array_loan[0]['loan_id'],'class="form-control" id="loan_id"');
								}
								else {
									for($i=0;$i<$count;$i++) {
									$date = date_create($select_array_loan[$i]['start_date']); 
									$key=$select_array_loan[$i]['amount']." for ".$select_array_loan[$i]['rate']."% on ". date_format($date,"M-Y");
									$select_array_loan[$i]['key'] = $key;
									 
									}
									
									echo generate_combobox('loanid',$select_array_loan,'loan_id','key',$l_id,'class="form-control" id="loan_id"');
								}
							?>
						</div>
						<div class="col-md-6">
							<label>Paid Date</label>
							<input type="text" class="form-control" id="dp1" name="paid_date" data-date-format="yyyy-mm-dd"/>
						</div>						
					</div>	
					<!--<div class="form-group">
						<div class="col-md-6"><br>
							<label>Payoff</label>&nbsp;&nbsp;&nbsp;
                            <label class="radio-inline">
                                <input type="radio" name="payoff" id="payoffno" value="0" checked>
                                No                   
                            </label>
                         
                            <label class="radio-inline">
                                <input type="radio" name="payoff" id="payoffyes" value="1">
                                Yes                   
                            </label>
							
							
						</div>-->
						<div class="col-md-6">
							<label>Due Interest</label>
							<input type="text" class="form-control" id="pay_amount" name="pay_amount" readonly/>
							<label>Due Intsallment</label>
							<input type="text" class="form-control" id="pay_installment" name="pay_installment" readonly/>
						</div>
						
					</div>										
					<div class="form-group">
						<div class="col-md-6">
							<label>Paid Interest</label>
							<input type="text" class="form-control" id="paid_amount" name="paid_amount"/>
							<label>Paid Installment</label>
							<input type="text" class="form-control" id="paid_installment" name="paid_installment"/>
							
						</div>						
						<div class="col-md-6">
						<label>Description / Note</label>
						<textarea class="form-control" id="note" name="note" placeholder="Enter Description / Note"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" name="submit"  class="btn btn-primary" value="Submit" style="margin-top: 10px; margin-left:5px;">
					</div>		
					<?php
					echo form_close();
					?>

				</div><!-- /.box-body -->
			</div>
		</div>
	<!-- /.form-->
  </div>


<!-- .installment list-->
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Installment List</h3>
    </div><!-- /.box-header -->
    <div class="box-body table-responsive">
		<table id='tab1' class='table table-bordered'>
			<thead>
				<tr>
				  	<th>Installment Id</th>
				  	<th>Loan</th>
				  	<th>Borrorwer</th>
				  	<th>Pay Amount</th>
				  	<th>Paid Amount</th>
				  	<th>Paid Date</th>
				</tr>
			</thead>
			<tbody>
			<?php
				if(empty($installment)):
					echo "<tr><td colspan='7' align='center'>No Record Found!</td></tr>";
				else :
				foreach ($installment as $insta) {
				if($insta['pay_amount'] > $insta['paid_amount']) {
					echo "<tr class='danger'>";
				}
				else if($insta['pay_amount'] < $insta['paid_amount']) {
					echo "<tr class='success'>";
				}
				else {
					echo "<tr>";
				}						
			?>
			  	<td><?php echo "I00".$insta['insta_id'];?></td>
			  	<td><a href="<?php echo base_url().'loan/view/'.$insta['loan_id'];?>"><?php echo $insta['loanname']; ?></a></td>
			  	<td><b><a href="<?php echo base_url().'borrower/index/'.$insta['borrower_id'];?>"><?php echo $insta['firstname'] ." " . $insta['lastname']; ?></a></b></td>
			  	<td><?php echo $insta['pay_amount'];?></td>
			  	<td><?php echo $insta['paid_amount'];?></td>
				
			  	<td><?php $date = date_create($insta['paid_date']); echo date_format($date,"d-m-Y");?></td>
			</tr>
			<?php } endif; ?>
			</tbody>
		</table>
	</div>
</div>
<!-- /.installment list-->

</div>
<script type="text/javascript">
	$('#dp1').datepicker({
	        "setDate": new Date(),
	        "autoclose": true
	});

	jQuery( document ).ready(function($) {

		var d = new Date();
		var currDate = d.getDate();
		var currMonth = d.getMonth()+1;
		var currYear = d.getFullYear();

		var dateStr = currYear + "-" + currMonth + "-" + currDate;

		$('#dp1').val(dateStr);
	});

$(document).ready(function () {
    var id =  $("#loan_id").val();
    if(id!="") {
        var date = $('#dp1').val();
		
		  if($('#payoffno').is(':checked')) {
		    var payoff = $('#payoffno').val();
		  } else {
		    var payoff = $('#payoffyes').val();
		  }
		
        var data = { 'id': id , 'date': date, 'payoff': payoff};
        $.ajax({
            type: "post",
            url: base_url+"borrower/get_amount",
            data: data ,
            
                success: function (loan_id) {
                
				 id_numbers = loan_id.split('!');
				$('#pay_amount').val(id_numbers[0]);
				$('#paid_amount').val(id_numbers[0]);
                $('#pay_installment').val(id_numbers[1]);
				$('#paid_installment').val(id_numbers[1]);
            }
        });
    }
    else {
    	alert("Please select Loan Id");
    }
});
	

$(document).ready(function () {
     $('input[name="paid_installment"]').keyup(function() {    	
        var id =  $("#loan_id").val();
        if(id!="") {
	        var date = $('#dp1').val();
			var installment = $('#paid_installment').val();
			  if($('#payoffno').is(':checked')) {
			    var payoff = $('#payoffno').val();
			  } else {
			    var payoff = $('#payoffyes').val();
			  }        
	        var data = { 'id': id , 'date': date, 'payoff': payoff, 'installment': installment };
	        $.ajax({
	            type: "post",
	            url: base_url+"borrower/get_amount",
	            data: data ,
	            //dataType: 'json', 
	                success: function (loan_id) {
	                
					 id_numbers = loan_id.split('!');
				if(id_numbers[2]== 0){
				$('#pay_amount').val(id_numbers[0]);
				$('#paid_amount').val(id_numbers[0]);
                $('#pay_installment').val(id_numbers[1]);
				}
				else{
				alert("Not a valid installment");
				}
	            }
	        });
	    }
	    else {
	    	alert("Please select Loan Id");
	    }
    });

});	
</script>
<script type="text/javascript">
$('input[name="submit"]').click(function() { 
	var pay_amount=$('#pay_amount').val();
	var paid_amount=$('#paid_amount').val();
	var paid_installment=$('#paid_installment').val();
	
	if(paid_amount>pay_amount) {

		alert("Please check the paid Interest amount");

		$("#payoffno").prop("checked", true)
	       var id =  $("#loan_id").val();
	        if(id!="") {
	        var date = $('#dp1').val();
			var installment = $('#paid_installment').val();
			  if($('#payoffno').is(':checked')) {
			    var payoff = $('#payoffno').val();
			  } else {
			    var payoff = $('#payoffyes').val();
			  }        
	        var data = { 'id': id , 'date': date, 'payoff': payoff, 'installment': installment};
	        $.ajax({
	            type: "post",
	            url: base_url+"borrower/get_amount",
	            data: data ,
	            dataType: 'json', 
	                success: function (loan_id) {
	                id_numbers = loan_id.split('!');
                if(id_numbers[0]>=0){
				$('#pay_amount').val(id_numbers[0]);
				$('#paid_amount').val(id_numbers[0]);
                $('#pay_installment').val(id_numbers[1]);
				}
				else{
				//Error handling for interest less then zero
				alert("Not a valid Input");
				$('#pay_amount').val("");
				$('#paid_amount').val("");
                $('#pay_installment').val("");
				}
	            }
	        });
		    }
		    else {
		    	alert("Please select Loan Id");
		    }	
		 $('#paid_amount').val("");	
		return false;
	}
});

jQuery('#dp1').datepicker().on('changeDate', function(ev){
	
	var id =  $("#loan_id").val();
    if(id!="") {
        var date = $('#dp1').val();
		var installment = $('#paid_installment').val();
		  if($('#payoffno').is(':checked')) {
		    var payoff = $('#payoffno').val();
		  } else {
		    var payoff = $('#payoffyes').val();
		  }        
        var data = { 'id': id , 'date': date, 'payoff': payoff, 'installment': installment };
        $.ajax({
            type: "post",
            url: base_url+"borrower/get_amount",
            data: data ,
            //dataType: 'json', 
                success: function (loan_id) {
				id_numbers = loan_id.split('!');
                if(id_numbers[0]>=0){
				$('#pay_amount').val(id_numbers[0]);
				$('#paid_amount').val(id_numbers[0]);
                $('#pay_installment').val(id_numbers[1]);
				}
				else{
				//Error handling for interest less then zero
				alert("Not a valid Input");
				$('#pay_amount').val("");
				$('#paid_amount').val("");
                $('#pay_installment').val("");
				}
            }
        });
    }
    else {
    	alert("Please select Loan Id");
    }
});
</script>