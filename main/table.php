<?php  
 $connect = mysqli_connect("localhost", "root", "", "crud");  
 $query = "SELECT * FROM jobs ORDER BY id_job desc";  
 $result = mysqli_query($connect, $query);  
 ?>  

<html>
	
	<body style="width: 150%;">
		<div class="container box">
			<h1 align="center">Jadwal Pekerjaan</h1>
			<br />
			<br />
				<div class="col-md-3">  
                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  
                </div>  
                <div class="col-md-3">  
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
                </div>  
                <div class="col-md-5">  
                     <input type="button" name="filter"  id="filter" value="Filter" class="btn btn-info" />  
                </div>  
                <div style="clear:both"></div> 

				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
				</div>
			<div class="table-responsive" id="table-responsive">
				

				<br /><br />

				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="5%">Nomor Pekerjaan</th>
							<th width="5%">Tanggal</th>
							<th width="5%">Store</th>
							<th width="10%">Alamat Store</th>
							<th width="5%">Kategori</th>
							<th width="10%">Keterangan</th>
							<th width="2.5%">Edit</th>
							<th width="2.5%">Delete</th>
						</tr>
					</thead>
					<?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
                     ?>  
                          <tr>  
                               <td><?php echo $row["id_job"]; ?></td>  
                               <td><?php echo $row["nomor"]; ?></td>  
                               <td><?php echo $row["tanggal"]; ?></td>  
                               <td><?php echo $row["store"]; ?></td>  
                               <td><?php echo $row["alamat"]; ?></td>   
                               <td><?php echo $row["kategori"]; ?></td>  
                               <td><?php echo $row["keterangan"]; ?></td>  
                          </tr>  
                     <?php  
                     }  
                     ?>  
				</table>
				
			</div>
		</div>
	</body>
</html>

<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add User</h4>
				</div>
				<div class="modal-body">
					<label>Nomor Pekerjaan</label>
					<input type="text" name="nomor" id="nomor" class="form-control" autofocus>
					<br />
					<label>Tanggal</label>
					<input type="date" name="tanggal" id="tanggal" class="form-control" required />
					<br />

					<label for="sel1"> Store : </label>
							<select class="form-control" id="store" name="store" id="sel1" required>
								<option>store 1</option>
								<option>store 2</option>
								<option>store 3</option>
								<option>store 4</option>
							</select>
					<br />

					<label>Alamat Store</label>
					<input type="text" name="alamat" id="alamat" class="form-control" required />
					<br />

					<label for="kategori"> Kategori : </label>
					<select class="form-control" id="kategori" name="kategori" id="sel1" required>
							<option>Maintenance</option>
							<option>Standby</option>
							<option>Problem</option>
					</select>
					<br />
					<label>Keterangan</label>
					<input type="text" name="keterangan" id="keterangan" class="form-control" required />
					<br />	
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_job" id="id_job" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').text("Add User");
		$('#action').val("Add");
		$('#operation').val("Add");
		
	});
	
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0,5,6,7],
				"orderable":false,
				"searchable": false,
			},
		],

	});

	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var nomor = $('#nomor').val();
		var tanggal = $('#tanggal').val();
			
		if(nomor != '' && tanggal != '')
		{
			$.ajax({
				url:"insert.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			alert("Both Fields are Required");
		}
	});
	
	$(document).on('click', '.update', function(){
		var id_job = $(this).attr("id_job");
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{id_job:id_job},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#nomor').val(data.nomor);
				$('#tanggal').val(data.tanggal);
				$('#store').val(data.store);
				$('#alamat').val(data.alamat);
				$('#kategori').val(data.kategori);
				$('#keterangan').val(data.keterangan);
				$('.modal-title').text("Edit User");
				$('#id_job').val(id_job);
				
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var id_job = $(this).attr("id_job");
		if(confirm("Are you sure you want to delete this?"))
		{
		// 	alert("HAPUS");
			$.ajax({
				url:"delete.php",
				method:"GET",
				data:{id_job:id_job},
				success:function(data)
				{
					alert(data);
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;	
		}
	});
	
	
});
</script>

<script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           });  
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  

                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"filter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                          	$('#table-responsive').html("HALOOOO");
                               $('#table-responsive').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      });  
      
 </script>

 
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 