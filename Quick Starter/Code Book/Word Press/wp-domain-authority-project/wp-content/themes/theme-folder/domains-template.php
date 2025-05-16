<?php 
/**
 * Template Name: Domains Template
 * */
 get_header();

    // GET CURR USER
    $current_user = wp_get_current_user();
    $current_customer_id = $current_user->ID;
    if ( 0 == $current_user->ID ) return;
   
    // GET USER ORDERS (COMPLETED + PROCESSING)
    $customer_orders = get_posts( array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => $current_user->ID,
        'post_type'   => wc_get_order_types(),
        'post_status' => array_keys( wc_get_is_paid_statuses() ),
    ) );
   
    // LOOP THROUGH ORDERS AND GET PRODUCT IDS
    if ( ! $customer_orders ) return;
    $storeLicenseLimit = array();
    foreach ( $customer_orders as $customer_order ) {
        $order = wc_get_order( $customer_order->ID );
        $items = $order->get_items();
        foreach ( $items as $item ) {
            $product_id = $item->get_product_id();
            $storeLicenseLimit[] = get_field('domain_authority_limit', $product_id);
        }
    }
    $currentUserStoreLimit = array_sum($storeLicenseLimit);
    
    $store_list = get_field('registered_store_detail', 'option');
    $customer_store_list = array();
    $index = 1;
    foreach ($store_list as $store_list_data) {
        $rowIndex = $index;
        $indexedRow = array_merge([$index], $store_list_data);
        $customerID = $store_list_data['customer_id'];
        if($current_customer_id == $customerID){
            $customer_store_list[] = $indexedRow;
        }
        $index++;
    }
    
    $addedStoreCountinList = count($customer_store_list);
    $maxLimitReached = false;
    if($currentUserStoreLimit <= $addedStoreCountinList ){ $maxLimitReached = true; }else{ $maxLimitReached = false; }
?>
<?php 
// echo $currentUserStoreLimit."  ".$addedStoreCountinList;
// acf_form_head(); 
// acf_form([
// 'field_groups' => ['group_64eb8939c8fa1'],
// 'post_id' => 'options',
// 'new_post' => false,
// 'post_title' => false,
// 'post_content' => false,
// 'form' => true,
// 'return' => '',
// ]); 

?>
<h1>Verify Your Store</h1>
<p>Add the domains to use theme on your store flawlesly.</p>
<div class="add-stores-form full-width" currentUserStoreLimit="<?php echo currentUserStoreLimit; ?>">
    <form id="addStores" class="add-stores form-theme" action="#">
        <input type="hidden" name="customer_id" value="<?php echo $current_user->ID; ?>" />
        <input type="hidden" name="customer_email" value="<?php echo $current_user->user_email; ?>" />
        <input type="hidden" name="customer_name" value="<?php echo $current_user->display_name; ?>" />
        <input type="hidden" name="theme_name" value="SEM Theme" />
        <div class="field-row">
            <label>Store Domain</label>
            <input type="text" name="shopify_domain" value="" placeholder="Store Domain" />
        </div>
        <div class="field-row">
           <button type="button" <?php if($maxLimitReached == true){ echo "disabled"; }?> default-text="Add Store" limit-reached="Reached to Max Limit">
               <?php if($maxLimitReached == true){ echo "Reached to Max Limit"; }else{ echo "Add Store"; } ?>
            </button>
        </div>
    </form>
</div>

<div class="added-store-list-wrapper full-width">
    <div class="added-store-list-header full-width">
        <h2 class="full-width">List of Connected Stores</h2>
        <p>You can add total <b><?php echo $currentUserStoreLimit; ?> Stores</b> domains as per your current limit. To updgrade the limits please check our <b>Plan</b> page.</p>
    </div>
    <div class="added-store-list full-width" currentUserStoreLimit="<?php echo $currentUserStoreLimit; ?>">
        <?php
            set_query_var( 'store_list', $customer_store_list );
            set_query_var( 'showCustomerData', true );
            get_template_part("template-snippets/domain-list-snippet");
        ?>
    </div>
    <button id="deleteSelectedRow" default-text="Select Row/Store to Delete">Select Row/Store to Delete</button>
</div>
<script>
    window.addEventListener("load", function(){
        let addStoresForm = document.querySelector("form#addStores");
        let addStoresFormBtn = addStoresForm.querySelector("button[type='button']");
        
        function selectTableItem(){
            console.log('function check');
            let storeListWrapper = document.querySelector(".added-store-list");
            let storeListTableItems = storeListWrapper.querySelectorAll("table.storeListTable tbody tr");
            let deleteSelectedRow = document.querySelector("#deleteSelectedRow");
            storeListTableItems.forEach(function(storeListTableItem){
                storeListTableItem.addEventListener('click', function(e) {
                    e.preventDefault();
                    let classList = storeListTableItem.classList;
                    if (classList.contains('selected')) {
                        classList.remove('selected');
                        deleteSelectedRow.innerText = deleteSelectedRow.getAttribute("default-text");
                    }else{
                        storeListTableItems.forEach(function(storeListItem){
                            storeListItem.classList.remove("selected");
                        })
                        classList.add('selected');
                        deleteSelectedRow.innerText = "Delete";
                    }
                    
                });
            })
            
            deleteSelectedRow.addEventListener("click", function(){
                console.log('click check');
                let selectedRow = storeListWrapper.querySelector("table.storeListTable tbody tr.selected");
                let index = selectedRow.getAttribute("index");
                request = jQuery.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'remove_shopify_store', 
                        'index': index
                    },
                    beforeSend: function(){
                      // console.log('before submitting..');
                      addStoresFormBtn.setAttribute('disabled', 'disabled');
                      deleteSelectedRow.innerText = "Removing...";
                    },
                    success: function(response){
                        // alert("Store Added");
                        // window.location.reload();
                        document.querySelector(".added-store-list").innerHTML = response;
                        new DataTable('#example', {});
                        selectTableItem()
                        let storeLimit = Number(document.querySelector(".added-store-list").getAttribute("currentuserstorelimit"));
                        let addedStore = Number(document.querySelectorAll(".storeListTable tbody tr").length);
                        console.log({storeLimit, addedStore});
                        if(storeLimit <= addedStore ){
                            addStoresFormBtn.innerText = addStoresFormBtn.getAttribute("limit-reached");
                            deleteSelectedRow.innerText = "Deleted";
                            setTimeout(function(){
                                deleteSelectedRow.innerText = deleteSelectedRow.getAttribute("default-text");
                            }, 1000)
                        }else{
                            addStoresFormBtn.removeAttribute('disabled');
                            addStoresFormBtn.innerText = addStoresFormBtn.getAttribute("default-text");
                            deleteSelectedRow.innerText = "Deleted";
                            setTimeout(function(){
                                deleteSelectedRow.innerText = deleteSelectedRow.getAttribute("default-text");
                            }, 1000)
                        }
                    }
                });
            })
        }
        selectTableItem();
    
        addStoresFormBtn.addEventListener("click", function(e){
            e.preventDefault()
            let customer_id = addStoresForm.querySelector("input[name='customer_id']").value;
            let customer_email = addStoresForm.querySelector("input[name='customer_email']").value;
            let customer_name = addStoresForm.querySelector("input[name='customer_name']").value;
            let theme_name = addStoresForm.querySelector("input[name='theme_name']").value;
            let shopify_domain = addStoresForm.querySelector("input[name='shopify_domain']").value;
            
            // console.log({customer_id, customer_email, customer_name, theme_name, shopify_domain});
            
            request = jQuery.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'register_shopify_store', 
                    'customer_id': customer_id,
                    'customer_email': customer_email, 
                    'customer_name': customer_name, 
                    'theme_name': theme_name, 
                    'shopify_domain': shopify_domain
                },
                beforeSend: function(){
                  // console.log('before submitting..');
                  addStoresFormBtn.setAttribute('disabled', 'disabled');
                  addStoresFormBtn.innerText = "Adding...";
                },
                success: function(response){
                    // alert("Store Added");
                    // window.location.reload();
                    document.querySelector(".added-store-list").innerHTML = response;
                    new DataTable('#example', {});
                    selectTableItem()
                    let storeLimit = Number(document.querySelector(".added-store-list").getAttribute("currentuserstorelimit"));
                    let addedStore = Number(document.querySelectorAll(".storeListTable tbody tr").length);
                    console.log({storeLimit, addedStore});
                    if(storeLimit <= addedStore ){
                        addStoresFormBtn.innerText = "Reached to Max Limit";
                    }else{
                        addStoresFormBtn.removeAttribute('disabled');
                        addStoresFormBtn.innerText = "Store Added"; 
                    }
                }
            });
        })
    })
</script>
<style>
    table.storeListTable tbody tr.selected{
        background-color: var(--ast-global-color-0);
        color: #fff;
    }
    h1, .full-width{width: 100%;}
    .site-content .ast-container {flex-wrap: wrap;}
    .added-store-list-wrapper .added-store-list-header {text-align: center;}
    .added-store-list-wrapper { margin-top: 30px; margin-bottom: 30px; }
    .added-store-list { margin-top: 30px; }
    .field-row label { margin-bottom: 5px; font-weight: 600; }
    .field-row { display: flex; flex-flow: column; margin-bottom: 10px; }
    form.add-stores { max-width: 400px; margin-top: 10px; }
    .field-row { display: flex; flex-flow: column; }
    .form-theme .field-row button, .form-theme .field-row input { font-family: inherit; font-size: 14px; font-weight: 600; padding: 10px; width: 100%; }
</style>

<?php get_footer(); ?>