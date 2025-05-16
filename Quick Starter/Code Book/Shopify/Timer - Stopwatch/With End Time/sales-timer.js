{% assign launch_time = product.metafields.custom.launch_timer %}

  <div
    class="sales-timer animated-button1"
    {% if product.selected_or_first_available_variant.available or launch_time != blank %}
    {% else %}
      style="visibility:hidden;"
    {% endif %}
  >
    <span class="anime-ele"></span><span class="anime-ele"></span><span class="anime-ele"></span><span class="anime-ele"></span>
    <div class="sales-timer-label">
      <span><img src="{{ 'fire-icon-gold.png' | file_url }}" alt="fire-icon"></span>
      <strong>
        {% if product.metafields.custom.sales_label != blank %}
          {{ product.metafields.custom.sales_label }}
        {% else %}
          {% if settings.timer_text != blank %}
            {% if launch_time != blank %}
              Launching in
            {% elsif product.tags contains '_label_Just Launched' %}
              {{ settings.launch_offer_text }}
            {% else %}
              {{ settings.timer_text }}
            {% endif %}
          {% else %}
            On Sale
          {% endif %}
        {% endif %}
      </strong>
    </div>
    <div class="sales-timer-display">
      <div class="sales-timer-display-label">
        {% if launch_time == blank %}
          Ends In&nbsp;
        {% endif %}
      </div>
      <div class="sales-timer-running">
        <div id="clockdiv">
          <div><span class="hours"></span><div class="smalltext">h</div></div>
          <div><span class="minutes"></span><div class="smalltext">m</div></div>
          <div><span class="seconds"></span><div class="smalltext">s</div></div>
        </div>
      </div>
    </div>
  </div>

  <script>
    {% if launch_time == blank %}
       document.addEventListener("DOMContentLoaded", function(){
            let sales_timer = document.querySelector('.sales-timer');
            let color_swatches = document.querySelectorAll('label.color-swatch');
            color_swatches.forEach(function(color_swatch){
                color_swatch.addEventListener('click', function(){
                    if(color_swatch.classList.contains('disabled')){
                        sales_timer.style.visibility = 'hidden';
                    }else{
                        sales_timer.style.visibility = 'visible';
                    }
                })
            })
        });
    {% endif %}
    
    {% if launch_time != blank %}
      var launchTime = new Date("{{ launch_time }}");
      var deadline = launchTime;
      console.log({launchTime});
    {% else %}
      const dayEnd = new Date();
      dayEnd.setHours(23, 59, 59, 999);
      var deadline = dayEnd;
    {% endif %}

    let sales_timer = document.querySelector('.sales-timer');
    var x = setInterval(function() {
    var now = new Date().getTime();
    var t = deadline - now;
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
    var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((t % (1000 * 60)) / 1000);
    var timeline = "";
    if(days > 0) {
        timeline = "<div><span>"+days +"</span><small>d</small></div>" +"<div><span>"+hours +"</span><small>h</small></div>" + "<div><span>"+minutes +"</span><small>m</small></div>" + "<div><span>"+seconds +"</span><small>s</small></div>"
    }else{
        timeline = {% comment %}"<div><span>"+days +"</span><small>d</small></div>" +{% endcomment %} "<div><span>"+hours +"</span><small>h</small></div>" + "<div><span>"+minutes +"</span><small>m</small></div>" + "<div><span>"+seconds +"</span><small>s</small></div>";
    }
    document.getElementById("clockdiv").innerHTML = timeline;
        if (t < 0) {
            clearInterval(x);
            document.getElementById("clockdiv").innerHTML = "EXPIRED";
            document.querySelector('.sales-timer').style.visibility = 'hidden';
            sales_timer.remove();
        }
    }, 1000);

    console.log({deadline});
  </script>

<style>
  .animated-button1::before {
    content: '';
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    background-color: #ad8585;
    opacity: 0;
    -webkit-transition: .2s opacity ease-in-out;
    transition: .2s opacity ease-in-out;
  }
  .animated-button1 span.anime-ele { position: absolute; }
  .animated-button1 span.anime-ele:nth-child(1) {
    top: 0px;
    left: 0px;
    width: 100%;
    height: 2px;
    background: -webkit-gradient(linear, right top, left top, from(rgba(43, 8, 8, 0)), to(#d5d5d5));
    background: linear-gradient(to left, rgba(43, 8, 8, 0), #d5d5d5);
    -webkit-animation: 2s animateTop linear infinite;
            animation: 2s animateTop linear infinite;
  }

  @keyframes animateTop {
    0% {-webkit-transform: translateX(100%);transform: translateX(100%);}
    100% {-webkit-transform: translateX(-100%);transform: translateX(-100%);}
  }
  .animated-button1 span.anime-ele:nth-child(2) {
    top: 0px;
    right: 0px;
    height: 100%;
    width: 2px;
    background: -webkit-gradient(linear, left bottom, left top, from(rgba(43, 8, 8, 0)), to(#d5d5d5));
    background: linear-gradient(to top, rgba(43, 8, 8, 0), #d5d5d5);
    -webkit-animation: 2s animateRight linear -1s infinite;
            animation: 2s animateRight linear -1s infinite;
  }
  .animated-button1 span.anime-ele:nth-child(3) {
    bottom: 0px;
    left: 0px;
    width: 100%;
    height: 2px;
    background: -webkit-gradient(linear, left top, right top, from(rgba(43, 8, 8, 0)), to(#d5d5d5));
    background: linear-gradient(to right, rgba(43, 8, 8, 0), #d5d5d5);
    -webkit-animation: 2s animateBottom linear infinite;
            animation: 2s animateBottom linear infinite;
  }
  .animated-button1 span.anime-ele:nth-child(4) {
    top: 0px;
    left: 0px;
    height: 100%;
    width: 2px;
    background: -webkit-gradient(linear, left top, left bottom, from(rgba(43, 8, 8, 0)), to(#d5d5d5));
    background: linear-gradient(to bottom, rgba(43, 8, 8, 0), #d5d5d5);
    -webkit-animation: 2s animateLeft linear -1s infinite;
            animation: 2s animateLeft linear -1s infinite;
  }
  @keyframes animateRight {
    0% {-webkit-transform: translateY(100%);transform: translateY(100%);}
    100% {-webkit-transform: translateY(-100%);transform: translateY(-100%);}
  }
  @keyframes animateBottom {
    0% {-webkit-transform: translateX(-100%);transform: translateX(-100%);}
    100% {-webkit-transform: translateX(100%);transform: translateX(100%);}
  }
  @keyframes animateLeft {
    0% {-webkit-transform: translateY(-100%);transform: translateY(-100%);}
    100% {-webkit-transform: translateY(100%);transform: translateY(100%);}
  }
  @keyframes animateTop {
    0% {-webkit-transform: translateX(100%);transform: translateX(100%);}
    100% {-webkit-transform: translateX(-100%);transform: translateX(-100%);}
  }
  @keyframes animateRight {
    0% {-webkit-transform: translateY(100%);transform: translateY(100%);}
    100% {-webkit-transform: translateY(-100%);transform: translateY(-100%);}
  }
  .sales-timer {display: inline-flex;column-gap: 15px;color: #000;border-radius: 12px;box-shadow: 0 0 2px 0 rgb(0 0 0 / 10%);flex-wrap: wrap;background-color: #fffdf0;border: 1px solid #ccc;position: relative;overflow: hidden;padding: 6px 12px;}
  .sales-timer span.floating-line {position: absolute;}
  .sales-timer{    width: auto;     max-width: 100%; }
  @keyframes floatingstrip{
    0%{top: 0;left: 0%;right: unset;bottom: unset;width: 30%;height: 2px;background-image: linear-gradient(308deg, black, transparent);}
    25% {top: 0;left: 100%;right: unset; bottom: unset;width: 30%;height: 2px;background-image: linear-gradient(308deg, black, transparent);}
    50% {top: 100%;left: calc(100% - 2px);right: unset;bottom: unset;height: 15%;width: 2px;background-image: linear-gradient(308deg, black, transparent);}
    75%{top: unset;left: 0%;right: unset;bottom: 0;width: 30%;height: 2px;background-image: linear-gradient(45deg, black, transparent);}
    100%{top: unset;left: 0%;right: unset;bottom: 100%;height: 15%;width: 2px;background-image: linear-gradient(308deg, black, transparent);}
  }
  @keyframes bgstrip {
    0% {background-position: -1000px 0px;}
    100% {background-position: 1000px 0px;}
  }
  @keyframes gradient-anime {
      0% {background-position: 0% 50%;}
      50% {background-position: 100% 50%;}
      100% {background-position: 0% 50%;}
  }
  .sales-timer-display .sales-timer-display-label {font-weight: 600; font-size: 12px;}
  @media(min-width:1201px){
    .sales-timer {justify-content: space-between;}
  }
  @media (min-width: 1200px){
    .sales-timer {font-size: 14px;}
  }
  @media(max-width:1200px){
    .sales-timer {justify-content: space-around; padding: 12px 12px;}
    /* .sales-timer .sales-timer-label span{display: none;} */
  }
  .sales-timer .sales-timer-label { display: inline-flex; align-items: center; justify-content: center; font-size: 14px; }
  .sales-timer .sales-timer-label span {
    background-color: transparent;
    border-radius: 4px;
    width: 26px;
    height: 26px;
    margin-right: 2px;
    padding: 0px;
  }
  .sales-timer .sales-timer-label span img { object-fit: contain;}
  .sales-timer-display .sales-timer-running div#clockdiv > div, .sales-timer-display { display: inline-flex; justify-content: center; }
  .sales-timer-display .sales-timer-running div#clockdiv > div {align-items: flex-end;}
  .sales-timer-display {align-items: center;}
  .sales-timer-display .sales-timer-running div#clockdiv { display: inline-flex; align-items: center; }
  .sales-timer-display .sales-timer-running div#clockdiv .smalltext { display: none;}
  .sales-timer-display .sales-timer-running div#clockdiv > div{ color: #000; margin-left: 2px; text-align: center; }
  .sales-timer-display .sales-timer-running div#clockdiv div { align-items: flex-end;  }
  .sales-timer-display .sales-timer-running div#clockdiv span {
      font-size: 18px;
      font-weight: 700;
  }
  @media(min-width:601px){
    .sales-timer-display .sales-timer-running div#clockdiv div small {margin-bottom: 3px;}
    .sales-timer-display .sales-timer-running div#clockdiv > div {
      min-width: 45px;
      padding: 2px 3px;
      text-align: center;
    }
  }
  @media(max-width:600px){
    .sales-timer-display .sales-timer-running div#clockdiv div small {margin-bottom: 2px;}
    .sales-timer-display .sales-timer-running div#clockdiv > div { min-width: 40px; }
  }
  .grid-product__content .sales-timer .sales-timer-label strong, .grid-product__content .sales-timer div#clockdiv div:last-child { display: none; }
  .grid-product__content .sales-timer span{ margin-right: 0; }
  .grid-product__content .sales-timer .sales-timer-label { padding-right: 0; }
  .grid-product__content .sales-timer{ transform: scale(.8); }
</style>