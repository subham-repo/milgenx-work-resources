<?php
   /**
    * Template Name: Dummy Content Generator
    *
    * This template can be used to override the default template and sidebar setup
    *
    * 
    */
   get_header(); ?>
   <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/secure-passsward.css" type="text/css" media="screen" />

   <div class="top-banner light-blue-bg"> 
    <div class="container container-sm"> 
      <div class="row align-center">
        <div class="col-lg-5 col-md-6 col-sm-12 project-listing">
          <div class="project-info color-blue">
            <h1>Dummy Content Generator</h1> 
            <p>Ready to use auto generated dummy contents</p> 
          </div>
        </div>
        <div class="col-lg-7 col-md-6 col-sm-12">
          <div class="banner-image-right"> 
            <img class="m-auto" src="<?php echo get_template_directory_uri(); ?>/img/secure-pass-img.png" alt="secure-pass"> 
          </div>
        </div>
      </div> 
    </div>
  </div>

  <div class="container container-sm row-spacing">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-generator__actions">
          <form class="page-generator__options" action="<?php the_permalink( get_the_ID() );?>" method="get">
            <input class="page-generator__input js-generator-input" type="text" name="n" placeholder="0" value="<?php if(isset($_GET['n'])){echo $_GET['n'];} ?>" maxlength="3" autocomplete="off">
            <select class="page-generator__select js-generator-select" name="t" style="">
              <option value="p" <?php if($_GET['t'] == 'p'){ ?> selected <?php } ?> >Paragraphs</option>
              <option value="s" <?php if($_GET['t'] == 's'){ ?> selected <?php } ?> >Sentences</option>
              <option value="w" <?php if($_GET['t'] == 'w'){ ?> selected <?php } ?> >Words</option>
            </select>
            <input class="page-generator__submit btn-main" type="submit" value="Generate!">
          </form>
          <button id="copy_btn" onclick="CopyToClipboard('result_content')" class="page-generator__button js-generator-clipboard btn-main" data-clipboard-target="#output" <?php if($_GET['n'] < 1 ){ ?> disabled <?php } ?>>
            <span class="page-generator__button-text">Copy</span>
            <img src="/assets/images/icon-copy--red.svg" class="page-generator__button-icon" alt="">
          </button>
        </div>

        <?php 
          if(isset($_GET['t']) == 'p'){
            $data_type = 'Paragraphs';
          }else if(isset($_GET['t']) == 's'){
            $data_type = 'Sentences';
          }if(isset($_GET['t']) == 'w'){
            $data_type = 'Words';
          }   
        ?>

        <?php if(!empty($_GET['n']) || isset($_GET['n']) > 0 ){ ?>
          <div class="result_announcement">
            <h4>Result for Requested <strong><?php echo $_GET['n']?></strong> Dummy <strong><?php echo $data_type; ?></strong></h4>
          </div>
        <?php }else{ ?>
          <div class="result_announcement">
            <h4>Please Make Selection of <strong>Your Choice of Dummy Contents</strong> You Need.</h4>
          </div>
        <?php } ?>

        <?php if(!empty($_GET['n'])){ ?>
          <textarea id="result_content" style="position: absolute;opacity: 0;"><?php get_template_part('content-generator/generator'); ?></textarea>
          <div class="result_content">
            <?php get_template_part('content-generator/generator'); ?>
          </div>
        <?php } ?>
        
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function CopyToClipboard(containerid) {

    var result_content = jQuery('textarea#result_content').text();
    var clean_data = result_content.replace(/(<([^>]+)>)/ig,"");
    jQuery('textarea#result_content').text(clean_data);

          /* Get the text field */
      let copyText = document.getElementById(containerid);

      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /* For mobile devices */

      /* Copy the text inside the text field */
      document.execCommand("copy");

      /* Alert the copied text */
      // alert("Copied the text: " + copyText.value);

      jQuery('#copy_btn span').text('Copied');
      setTimeout(function(){
        jQuery('#copy_btn span').text('Copy');
      }, 1000);
    }
  </script>
  <style type="text/css">

    button[disabled] {
        pointer-events: none;
        opacity: .6;
    }
    .result_content {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 20px 20px;
        box-shadow: -4px 4px 20px 0 rgb(0 0 0 / 10%);
        border: 1px solid #e4e4e4;
        border-radius: 6px;
        background-color: #fafafa;
    }
    .result_announcement {
        width: 100%;
        margin-top: 30px;
    }
    .result_announcement h4 {
        font-weight: normal;
        letter-spacing: .8px;
    }
    .result_announcement h4 strong {
        color: #0f708a;
    }
    .page-generator__actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 20px 20px;
        box-shadow: -4px 4px 20px 0 rgb(0 0 0 / 10%);
        border: 1px solid #e4e4e4;
        border-radius: 6px;
    }
    form.page-generator__options {
        display: flex;
    }
    @media(min-width: 768px){
      form.page-generator__options {
          width: calc(100% - 200px);
      }
    }
    @media(max-width: 767px){
      form.page-generator__options {
        width: calc(100% - 0px);
        flex-wrap: wrap;
        flex-flow: column;
        margin-bottom: 20px;
      }
      form.page-generator__options input.page-generator__input, form.page-generator__options select {
          min-height: 46px;
          margin-bottom: 10px;
      }
    }
    form.page-generator__options input.page-generator__input, form.page-generator__options select {
      width: 100%;
      max-width: 300px;
      margin-right: 20px;
      border: 2px solid #ddd;
      padding: 0 15px;
      font-weight: 500;
      letter-spacing: 1px;
  }
  </style>
  <?php get_footer(); ?>
 