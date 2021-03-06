<div class="panel panel-default">
	<div class="panel-heading"><h3>Installment Report</h3></div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table b-t text-small dataTable">
			<thead>
			  <tr>
			  	<th>Installment Id</th>
			  	<th>Loan</th>
			  	<th>Borrorwer</th>
			  	<th>Due Interest</th>
			  	<th>Paid Interest</th>
				<th>Due Installment</th>
				<th>Paid Installment</th>
			  	<th>Paid Date</th>
			  </tr>
			</thead>
			<tbody>
				<?php
					if(empty($installment)):
						echo "<tr><td colspan='7' align='center'>No Record Found!</td></tr>";
					else :
					foreach ($installment as $insta)
					{
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
				  	<td><a href="<?php echo base_url().'loan/view/'.$insta['loan_id'];?>"><?php echo $insta['amount'] ." for ". $insta['rate'] ."% on ".$insta['start_date'];?></a></td>
				  	<td><a href="<?php echo base_url().'borrower/index/'.$insta['borrower_id'];?>"><?php echo $insta['firstname']." ".$insta['lastname'];?></a></td>
				  	<td><?php echo $insta['pay_amount'];?></td>
				  	<td><?php echo $insta['paid_amount'];?></td>
					<td><?php echo "0";?></td>
					<td><?php echo $insta['installment'];?></td>
				  	<td><?php $date = date_create($insta['paid_date']); echo date_format($date,"d-m-Y");?></td>
				</tr>
				<?php } endif; ?>
			</tbody>
			</table>
		</div>
	</div>
</div>
<script src="<?php echo base_url()."public/js/datatables/jquery.dataTables.min.js"; ?>"></script>
<script>
	$('.dataTable').dataTable();
</script>