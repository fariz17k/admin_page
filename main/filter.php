<?php  
 //filter.php  
 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "crud");  
      $output = '';  
      $query = "  
           SELECT * FROM jobs  
           WHERE tanggal BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'  
      ";  
      //die($query);
      $result = mysqli_query($connect, $query);  
      $output .= '  
           <table class="table table-bordered">  
                <tr>
              <th width="5%">Nomor Pekerjaan</th>
              <th width="10%">Tanggal</th>
              <th width="10%">Store</th>
              <th width="20%">Alamat Store</th>
              <th width="5%">Kategori</th>
              <th width="10%">Keterangan</th>
              <th width="2.5%">Edit</th>
              <th width="2.5%">Delete</th>
            </tr>
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  


                $output .= '  
                     <tr>  
                          <td>'. $row["id_job"] .'</td>  
                          <td>'. $row["nomor"] .'</td>  
                          <td>'. $row["tanggal"] .'</td>  
                          <td>'. $row["store"] .'</td>  
                          <td>'. $row["alamat"] .'</td> 
                          <td>'. $row["kategori"] .'</td> 
                          <td>'. $row["keterangan"] .'</td> 
                     </tr>  
                ';  
           }  
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">No Order Found</td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  
 }  
 ?>
