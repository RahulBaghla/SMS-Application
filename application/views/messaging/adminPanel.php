<?php $this->load->view('messaging/pages/header') ?>
<?php $this->load->view('messaging/pages/nav') ?>
<div class="container">
	
	<!-- Table start -->
        <h2 style="font-size: x-large; font-weight:bold; text-align:center">Accountants Log</h2>
		
    <table class="tablemanager">
    	<thead>
    		<tr>
				<th class="disableSort">Id</th>
				<th>User Name</th>
				<th>User Email</th>
				<th>School Name</th>
				<th>Number of SMS</th>
				<th>Request Created at</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
    	</thead>
		<tbody>
			<?php 
			// $data = fetchData();
			$this->db->order_by("created_at", "desc");
			$query = $this->db->get('sms');
			$data = $query->result();
			if($data > 0){
				foreach($data as $key => $value){
					?>
					<tr>
				 	<td><?php echo $key+1 ?></td>
				 	<td><?php echo $value->name ?></td>
				 	<td><?php echo $value->email ?></td>
				 	<td><?php echo $value->schoolname ?></td>
				 	<td><?php echo $value->totalsms ?></td>
				 	<td><?php echo $convertDate = date("d-m-Y", strtotime($value->created_at)); ?></td>
				 	<td><?php if($value->status != 0){echo "Added";}else{ echo "Pending" ;} ?></td>
				 	<td><?php if($value->status != 0){echo "";}else{?>
					 <a href="<?php 
					  			$processid = $value->processid;
					  			echo site_url("/messaging/processSMS/$processid")
							   ?>
					"><button>Add</button>
					</a>
					 <a href="<?php 
					  			$processid = $value->processid;
					  			echo site_url("/messaging/deleteSMS/$processid")
							   ?>
					"><button>Cancel</button>
					</a>
					<?php ;} ?></td>
				 	
				 	</tr>
					 <?php	
				}
			}else{
				?>
				<div>
				<h2>No data found</h2>
				</div>
				<?php
			}
			?>
			
		</tbody>
	</table>
</div>

<?php $this->load->view('messaging/pages/footer') ?>
