<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Drag and Drop table rows in PHP Mysql- ItSolutionStuff.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <div class="container">
        <h3 class="text-center">Dynamic Drag and Drop table rows in PHP Mysql</h3>
        <table class="table table-bordered">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
            </tr>
            <tbody class="row_position">
            <?php


// Create connection
$db = mysqli_connect("localhost","user","","studycase"); 
// Check connection
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

            $sql = "SELECT * FROM diri ORDER BY order_field";
            $users = $db->query($sql);
            while($user = $users->fetch_assoc()){


            ?>
                <tr  id="<?php echo $user['id_diri'] ?>">
                    <td><?php echo $user['nama_depan'] ?></td>
                    <td><?php echo $user['nama_belakang'] ?></td>
                    <td><?php echo $user['no_telp'] ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div> <!-- container / end -->
</body>
<script type="text/javascript">
    $( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });
    function updateOrder(data) {
        $.ajax({
            url:"updaterow.php",
            type:'post',
            data:{position:data},
            success:function(){
                alert('your change successfully saved');
            }
        })
    }
</script>
</html>