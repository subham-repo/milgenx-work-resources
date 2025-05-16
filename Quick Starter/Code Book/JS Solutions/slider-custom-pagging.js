function slickCustomPagging(productPhotos){
    let paggerContent = '<span class="paggerContent"></span>' 
    jQuery(productPhotos).before(paggerContent);

    function slickPagging(){
      let product__slides = document.querySelectorAll('.product__slide:not(.slick-cloned)');
      let total_product__slide = product__slides.length;
      let product__slide_index = 1;
      let currentProduct__slide = 1;
      product__slides.forEach(function(product__slide){
        product__slide.setAttribute('data-index', product__slide_index);
        if(product__slide.classList.contains('slick-current')){
          currentProduct__slide = product__slide.getAttribute('data-index');
        }
        product__slide_index++;
      })
      if(currentProduct__slide !== "undefined"){
        jQuery('.paggerContent').text(currentProduct__slide + ' | ' + total_product__slide );
      }
      console.log({total_product__slide, currentProduct__slide});
    }
    slickPagging();
    
    jQuery(productPhotos).on("afterChange", function (currentProduct__slide){
      console.log('slide changed');
    slickPagging(); 
    });
    console.log('slickCustomPagging Initialized')
  }

  window.addEventListener('DOMContentLoaded', (event) => {
    console.log('DOM fully loaded and parsed');
    
    slickCustomPagging('.product-photos');
  });