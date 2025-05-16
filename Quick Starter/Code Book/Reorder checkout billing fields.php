
add_filter("woocommerce_checkout_fields", "order_fields");
function order_fields($fields) {
    $order = array(
       "billing_first_name",
        "billing_last_name",
        "billing_email", 
        "billing_phone",
        "billing_address_1", 
        "billing_address_2", 
        "billing_country",
        "billing_city", 
        "billing_postcode", 
        "billing_state",
        "billing_company"
    );
    $p = 10;
    foreach($order as $field)
    {
    	$fields["billing"][$field]['priority'] = $p;
        $ordered_fields[$field] = $fields["billing"][$field];
        $p = $p+10;
    }
    $fields["billing"] = $ordered_fields;    
    return $fields;
}
