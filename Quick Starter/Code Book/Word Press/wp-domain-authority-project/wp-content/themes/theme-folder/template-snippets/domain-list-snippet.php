<link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
<?php 
$current_user = wp_get_current_user();

if(get_query_var('showCustomerData') == true){
    $store_list = get_query_var( 'store_list' );;
    $customer_store_list = [];
    $current_customer_id = $current_user->ID;;
    foreach ($store_list as $store_list_data) {
        $customerID = $store_list_data['customer_id'];
        if($current_customer_id == $customerID){
            array_push($customer_store_list, $store_list_data);
        }
    }
    $store_list = $customer_store_list;
}else{
    $store_list = get_field('registered_store_detail', 'option'); 
}

?>
<table id="example" class="storeListTable" style="width:100%" have-rows="<?php echo count($store_list); ?>">
    <thead>
        <tr>
            <th>User/Customer ID</th>
            <th>Shopify domain</th>
            <th>Customer Email</th>
            <th>Customer Name</th>
            <th>Theme Name</th>
        </tr>
    </thead style="text-align: left;">
    <tbody>
        <?php for ($i = 0; $i <= count($store_list) - 1; $i++) { ?>
        <tr 
        index="<?php echo $store_list[$i][0]; ?>" 
        customer_id="<?php echo $store_list[$i]['customer_id']; ?>" 
        shopify_domain="<?php echo $store_list[$i]['shopify_domain']; ?>" 
        customer_email="<?php echo $store_list[$i]['customer_email']; ?>" 
        customer_name="<?php echo $store_list[$i]['customer_name']; ?>" 
        theme_name="<?php echo $store_list[$i]['theme_name']; ?>">
            <th><?php echo $store_list[$i]['customer_id']; ?></th>
            <th><?php echo $store_list[$i]['shopify_domain']; ?></th>
            <th><?php echo $store_list[$i]['customer_email']; ?></th>
            <th><?php echo $store_list[$i]['customer_name']; ?></th>
            <th><?php echo $store_list[$i]['theme_name']; ?></th>
        </tr>
        <?php } ?>
    </tbody>
</table>
<style>
    .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter {display: none;}
</style>
<script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
<script>
    window.addEventListener("load", function(){
        new DataTable('#example', {});  
    })
</script>