<?php
/**
 * Created by PhpStorm.
 * User: tonni
 * Date: 03/01/2019
 * Time: 13:47
 */

include "inc.database.php";

$sql = "SELECT * FROM opd_items WHERE item_type = 'school'";
$query = mysqli_query($con, $sql);

if ($result = mysqli_num_rows($query)){

    while ($row = mysqli_fetch_assoc($query)){
        ?>
        <tr>
            <th><h4 class='text-capitalize'><?php echo $row['item_name'] ?></h4></th>

        </tr>

        <?php
    }

}else {

    echo "<h4> The section is empty, <br> Please insert items. </h4>";

}