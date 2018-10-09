<?php
if(isset($_GET['action']) && isset($_GET['clientid']))
{
  if($_GET['action'] === 'ct-delete-client')
  {
    $client_id = $_GET['clientid'];
    $Client = ct\CTData::deleteClient($client_id); 
  }
}

$wp_list_table = new ct\CTListTable();

?>
<div class="wrap t201plugin">
  <h2>
    All Clients
    <a href="<?php print admin_url('admin.php?page=ct-add-new'); ?>" class="add-new-h2">Add New</a>&nbsp;&nbsp;
    <a href="<?php print admin_url('admin.php?page=ct-shortcode'); ?>" class="add-new-h2">Generate Shortcode</a>
  </h2>

  <form method="post">
    <input type="hidden" name="page" value="my_list_test" />
    <?php $wp_list_table->search_box('Search Client', 'search_id'); ?>
  </form>
  <br><br>
  <?php
  $wp_list_table->display();
  ?>

</div>