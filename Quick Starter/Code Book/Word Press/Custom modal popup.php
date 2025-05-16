<script type="text/javascript">
    jQuery('div[data-toggle="modal"]').click(function(){
      let id =  jQuery(this).data('target');
      jQuery(id).addClass('show'); 
      jQuery(id).addClass('hide'); 
      jQuery('body').css('overflow','hidden');
    })
    jQuery('button[data-dismiss="modal"]').click(function(){
      jQuery(this).parents('.cs-modal').removeClass('show');
      jQuery(this).parents('.cs-modal').addClass('hide');
      jQuery('body').css('overflow','unset');
    })

  

    var mouse_is_inside = false;
    jQuery(document).ready(function()
    {
        jQuery('.modal-dialog').hover(function(){ 
            mouse_is_inside=true; 
        }, function(){
            mouse_is_inside=false; 
        });

        jQuery(document).mouseup(function(){ 
            if(! mouse_is_inside) {
              jQuery('.cs-modal.show').removeClass('show');
              jQuery('body').css('overflow','unset');
            }
        });
    });

</script>

<button data-toggle="modal" data-target="#cont_syq" class="cta-row callbak">Click Me !</button>

  
<!-- Modal -->
  <div class="cs-modal hide" id="cont_syq" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kerro meille, mitä tuotetta etsit!</h4>
        </div>
        <div class="modal-body">
          <p>Lähetä alla meille viesti, jossa kerrot millaista tuotetta etsit - esimerkiksi käyttötarkoitus, mittoja, millaista tyyliä haluat tuotteen olevan jne. Me palaamme mahdollisimman pikaisesti, usein jopa saman työpäivän aikana.</p>
          <?php echo do_shortcode('[contact-form-7 id="102922" title="Enquiry"]');?>
        </div>
      </div>
      
    </div>
  </div>
<!-- Modal End-->


<style type="text/css">
    .cs-modal.hide{
    display: none;
}
.cs-modal.show{
    display: flex;
}
.cs-modal {
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,.2);
    justify-content: center;
    align-items: center;
    z-index: 9999;
    overflow: auto;
    padding: 50px 10px;
}
.cs-modal .modal-dialog {
    max-width: 600px;
    background-color: #fff;
    border-radius: 5px;
    width: 100%;
    position: relative;
    height: auto;
    top: 40px;
}
.cs-modal .modal-header {
    border: none;
    padding-bottom: 0;
    position: relative;
}
.cs-modal button.close {
    font-size: 30px;
    position: absolute;
    right: 15px;
    top: 0px;
    padding: 0;
    background: transparent;
    line-height: 30px;
    cursor: pointer;
}
.cs-modal .modal-header h4 {
    width: Calc(100% - 30px);
}
</style>