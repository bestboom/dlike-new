<?php include('template/header7.php');?>
</div><!-- sub-header -->
<?php
$sql_T = "SELECT * FROM dlikeposts ORDER BY created_at DESC";
    $result_T = $conn->query($sql_T);

    if ($result_T && $result_T->num_rows > 0) { 
        while ($row_T = $result_T->fetch_assoc()) { 
            ?>
            <tr>
                <td class="exp-user cent_me wid_2">
                    <span><?php echo $row_T["username"]; ?></span>
                </td>
                <td class="exp-user cent_me wid_2">
                    <span><?php echo $row_T["title"]; ?></span>
                </td>
                <td class="exp-amt cent_me wid_2">
                    <span><?php echo $row_T["description"]; ?></span>
                </td>
                <td class="exp-amt cent_me wid_2">
                    <span><?php echo $row_T["tags"]; ?></span>
                </td>
            </tr>
            <?php
        }
    }
?> 
        </tbody>
    </table>
</div>
<div class="latest-post-section" style="min-height:80vh;padding: 70px 0px 60px 0px;">
    <div class="container">
        <div class="row">
            
        </div>
    </div>  

<?php include('template/dlike_footer.php'); ?>