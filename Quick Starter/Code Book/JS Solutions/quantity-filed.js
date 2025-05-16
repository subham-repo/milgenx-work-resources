<div class="quantity_input_mh">
    <span class="ss-icon product-minus js-change-quantity" data-func="minus"><span class="icon-minus"><i class="fa fa-minus"></i></span></span>
    <input type="number" id="Quantity-product-template" min="1" size="2" class="quantity" name="quantity" value="1" pattern="[0-9]*" data-quantity-input="">
    <span class="ss-icon product-plus js-change-quantity" data-func="plus"><span class="icon-plus"><i class="fa fa-plus"></i></span></span>
</div>

<script>
 function custon_quantity_box(){
    var quantity_box = jQuery('.quantity_input_mh');
    var quantity_minus = quantity_box.find('.product-minus');
    var quantity_plus = quantity_box.find('.product-plus');
    var quantity_field = quantity_box.find('input.quantity');

    quantity_plus.on('click', function(){
      var quantity_val = jQuery(this).parent('.quantity_input_mh').find('input.quantity').val();
      var new_quantity = parseInt(quantity_val) + parseInt(1);
      jQuery(this).parent('.quantity_input_mh').find('input.quantity').val(new_quantity);
      console.log({new_quantity});

    })
    quantity_minus.on('click', function(){
      var quantity_val = jQuery(this).parent('.quantity_input_mh').find('input.quantity').val();
      if(quantity_val < 2){
      	var new_quantity = 1;
      }else{
      	var new_quantity = parseInt(quantity_val) - parseInt(1);
      }
      jQuery(this).parent('.quantity_input_mh').find('input.quantity').val(new_quantity);
    })
    
    quantity_field.bind('change', function(){
      var quantity_val = jQuery(this).parent('.quantity_input_mh').find('input.quantity').val();
      var new_quantity = Number(quantity_val);
    })
  }
  custon_quantity_box();
  
//     function cost_calculator(new_quantity){
//     var onetime_Price_btn = jQuery('.purchase-details .huggable-product__buttons.otbtn button.huggable-product__button.active'); 
//     var onetime_Price = onetime_Price_btn.attr('data-orig');

//     var price_block = jQuery('.quantity_price_block .product__price');
//     var price_blockOtp = onetime_Price;
//     var price_Otp = Number(price_blockOtp.replace(/[^0-9 ]/g, ''));
//     price_block.find('.otp').text('$'+parseInt(price_Otp * new_quantity)/100);

//     var subs_Price_btn = jQuery('.purchase-details .huggable-product__buttons.spbtn button.huggable-product__button.active'); 
//     var subs_Price = subs_Price_btn.attr('data-dd');
//     var price_blockSub = subs_Price;
//     var price_Sub = Number(price_blockSub.replace(/[^0-9 ]/g, ''));
//     price_block.find('.sub_price').text('$'+parseInt(price_Sub * new_quantity)/100);

//     //         console.log({price_Otp, onetime_Price, price_blockSub});	
//   } 
</script>

.quantity_input_mh {
  display: flex;
  justify-content: center;
  float: none;
  margin: auto;
  margin-bottom: 10px;
  @media(min-width:601px){
    width: 180px;
  }
  @media(max-width:600px){
    width: 180px;
  }
  .ss-icon{
    background: transparent;
    font-weight: 300;
    position: relative;
    cursor: pointer;
    display: block;
    text-align: center;
    float: left;
    border: #006241 1px solid;
    @media(min-width:601px){
      height: 44px;
      width: 44px;
    }
    @media(max-width:600px){
      height: 44px;
      width: 34px;
    }
  }
  input.quantity{
    border-color: #006241 !important;
    color: #006241 !important;
    padding-top: 11px;
    padding-bottom: 11px;
    line-height: 1.4;
    min-height: 44px;
    margin-bottom: 0;
    text-align: center;
    padding: 6px 15px;
    height: 44px;
    border-radius: 0;
    /* -webkit-appearance: none; */
    float: left;
    border: #006241 1px solid;
    margin-right: 0;
    outline: none;
    @media(min-width:992px){
    	width: calc(100% - 88px);
    }
    @media(max-width:991px){
    	width: calc(100% - 130px);
    }
  }

  .product-minus {
    border-right: 0 !important;
    line-height: 44px;
    font-size: 18px;
    color: #006241 !important;
  }
  .product-plus {
    border-left: 0 !important;
    font-size: 16px;
    line-height: 44px;
    color: #006241 !important;
  }
}