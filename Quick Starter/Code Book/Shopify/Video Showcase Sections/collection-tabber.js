function isInViewport(el) {
  const rect = el.getBoundingClientRect();
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)

  );
}

let playTabberVideo = function(){
  console.log("playTabberVideo pinged");
  let section_collection_tabbers = document.querySelectorAll('.collection-tabber');
  
  section_collection_tabbers.forEach(function(collection_tabber){
    let collection_tabber_slider = collection_tabber.querySelector('.flickity-wrapper');
    let collection_tabber_slides = collection_tabber_slider.querySelectorAll('.collection-product-slide');
    collection_tabber_slides.forEach(function(collection_tabber_slide){
      let vidElement = collection_tabber_slide.querySelector('video');
      let posterElement = collection_tabber_slide.querySelector('.video-poster');
      if(collection_tabber_slide.classList.contains('is-selected') ){
        if(vidElement){
          let video_src = vidElement.getAttribute('video-src');
          setTimeout(function(){
            vidElement.setAttribute('src', video_src);
            vidElement.play();
            vidElement.style.opacity = '1';
            posterElement.style.opacity= '0';
            posterElement.style.zIndex= '-1999';
            posterElement.style.pointerEvents= 'none';
          }, 2000);
          // vidElement.autoplay = true;
          console.log(video_src);
        }
      }else{
        if(vidElement){
            vidElement.pause();
            vidElement.setAttribute('src', '');
            console.log('Haulting last video');
        }
      }
    })
  })
  // console.log('tabber-changed');
}

window.addEventListener("load", function(){
  
  let productVideoCardsTabbers = document.querySelectorAll(".product-video-cards .flickity-wrapper");

  productVideoCardsTabbers.forEach(function(productVideoCardsTabber){

    let productTabberNavigation = productVideoCardsTabber.closest(".collection-tabber-section").querySelector(".tabber-thumb-wrapper");
    console.log(productTabberNavigation)
    // vanilla JS
    var flkty = new Flickity( productVideoCardsTabber, {
      // options
      contain: false, 
      prevNextButtons: false, 
      adaptiveHeight: true, 
      pageDots: false, 
      wrapAround: true,
      on: {
        change: function() {
          console.log('Flickity changed ');
          playTabberVideo();
        }
      }
    });

    var navFlkty = new Flickity( productTabberNavigation, {
      // options
      contain: true,
      pageDots: false,
      cellAlign: "center",
      prevNextButtons: false,
      imagesLoaded: false,
      asNavFor: productVideoCardsTabber,
      on: {
        change: function() {
          console.log('Flickity changed ');
          playTabberVideo();
        }
      }
    });
  })
})

window.addEventListener("load", playTabberVideo);
// window.addEventListener("scroll", playTabberVideo);


const tabberVideos = document.querySelectorAll('.collection-product-slide video');

let playPromo = function(){
  if(document.querySelector('.template-product') || document.querySelector('.spotted_on') || document.querySelector('.celebs-videos')){
    const promo_videos = document.querySelectorAll('.video-div');
    promo_videos.forEach(function(promo_video){
      let promo_video_src = ""
      let promo_video_count = promo_videos.length;
      // console.log({promo_video_count});
      let promo_video_ele = promo_video.classList;
      
      if(isInViewport(promo_video)){
      // console.log(promo_video_ele)
        
        // When video is in the viewport
        console.log('video is in the viewport');
//           let video_src = promo_video.getAttribute('src');
//           console.log(promo_video.getAttribute('src');
        if(promo_video.getAttribute('src') == null){
          // enabling video by adding src
          if(promo_video.getAttribute('video-src') == null){
            promo_video_src = promo_video.getAttribute('src');
            promo_video.setAttribute('video-src', promo_video_src);
          }
          promo_video_src = promo_video.getAttribute('video-src');
          promo_video.setAttribute('src', promo_video_src);
          // console.log({promo_video_src});
        }
      }else{
        if(promo_video.getAttribute('src') == null){
          // enabling video by adding src
          if(promo_video.getAttribute('video-src') == null){
            promo_video_src = promo_video.getAttribute('src');
            promo_video.setAttribute('video-src', promo_video_src);
          }
          promo_video_src = promo_video.getAttribute('video-src');
          promo_video.setAttribute('src', promo_video_src);
          // console.log({promo_video_src});
        }
      }
    })
  }
}
document.addEventListener('scroll', function () {
  playPromo();
  tabberVideos.forEach(function(tabberVideo){
    if(isInViewport(tabberVideo)){
      // Do Noting..
//         tabberVideo.play = true;
    }else{
//         tabberVideo.pause = true;
      tabberVideo.muted = true;
    }
  })
})
