<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<?php
// Create connection
$db = mysqli_connect("localhost","user","","studycase"); 
// Check connection
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
<head>
     <title>Data Diri</title>
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
	<style>
	td:hover{
		cursor:move;
		}
	</style>
</head>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
			<table class="table table-hover" id="myTable">
			  <thead>
				<tr>
				  <th scope="col">No</th>
				  <th scope="col">First Name</th>
				  <th scope="col">Last Name</th>
				  <th scope="col">Phone Number</th>
				</tr>
			  </thead>
			  <tbody class="row_position">
			  <?php
			$sql = "SELECT * FROM diri ORDER BY order_field";
			$users = $db->query($sql);
            //while($user = $users->fetch_assoc()){
			for($i=1 ; $user = $users->fetch_assoc(); $i++){
				?>
				<tr id=<?php echo $user['id_diri']?>>
				  <td class="index"><?php echo $i?></td>
				  <td><?php echo $user['nama_depan']?></td>
				  <td><?php echo $user['nama_belakang']?></td>
				  <td><?php echo $user['no_telp']?></td>
				</tr>
			<?php } ?>
			  </tbody>
			</table>
        </div>
      </div>
    </div>
<script type="text/javascript">
		var fixHelperModified = function(e, tr) {
		var $originals = tr.children();
		var $helper = tr.clone();
		$helper.children().each(function(index) {
			$(this).width($originals.eq(index).width())
		});
		return $helper;
	},
		updateIndex = function(e, ui) {
			$('td.index', ui.item.parent()).each(function (i) {
				$(this).html(i+1);
			});
			$('input[type=text]', ui.item.parent()).each(function (i) {
				$(this).val(i + 1);
			});
			var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
		};

	$("#myTable .row_position").sortable({
		helper: fixHelperModified,
		stop: updateIndex
	}).disableSelection();
	
		$(".row_position").sortable({
		distance: 5,
		delay: 100,
		opacity: 0.6,
		cursor: 'move',
		stop: updateIndex,
		update: function() {}
			});
			
	    function updateOrder(data) {
        $.ajax({
            url:"updaterow.php",
            type:'post',
            data:{position:data},
            success:function(){
                alert('Your change successfully saved');
            }
        })
    }

</script>