<?php 
// Review Form Snippet
?>

<section class="review-form full-width section-spacing">
    <?php 
    if($_POST['post_submit']=='Einreichen'){
            ;
     $id =  wp_insert_post(array('post_title'=>$_POST['post_title'], 'post_type'=>'review', 'post_content'=>$_POST['post_desc'],'post_status' => 'draft','comment_status' => 'closed','ping_status' => 'closed'));
    }

    update_field('field_6176eb6144049', $_POST['post_author_name'], $id);
    update_field('field_6176ebff4404a', $_POST['post_review_star'], $id);
    update_field('field_617700e362969', $_POST['post_review_date'], $id);

    ?>

    <form id="review-entry" name="post_entry" method="post" action="<?php echo get_page_link(get_the_ID()); ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="form-fields">
                                <label>Name <span class="red">*</span></label>
                                <input type="text" id="post_author_name" name="post_author_name" value="<?php $_POST['post_author_name'] ?>" required/>
                            </div>
                            <div class="form-fields post_review_date">
                                <label> 
                                    <?php if (ICL_LANGUAGE_CODE == 'en') { ?>
                                    Stay period
                                    <?php }else{ ?>
                                    Aufenthaltszeitraum
                                    <?php } ?>
                                <span class="red">*</span></label>
                                <input type="month" id="post_review_date" placeholder="<?php if (ICL_LANGUAGE_CODE == 'en') { ?>Please select<?php }else{ ?>Bitte auswählen<?php } ?>" name="post_review_date" required/>
                            </div>
                            <div class="form-fields">
                                <label> 
                                    <?php if (ICL_LANGUAGE_CODE == 'en') { ?>
                                    Apartment
                                    <?php }else{ ?>
                                    Wohnung
                                    <?php } ?>
                                <span class="red">*</span></label>
                                <select id="post_title" name="post_title" required/>
                                    <option value="">
                                        <?php if (ICL_LANGUAGE_CODE == 'en') { ?>
                                        Please select
                                        <?php }else{ ?>
                                        Bitte auswählen
                                        <?php } ?>
                                    </option>
                                    <?php 
                                        $args = array (
                                            'numberposts'   => -1,
                                            'post_type'     => 'property',
                                            'orderby'       => 'title',
                                            'order'         => 'ASC',
                                            'suppress_filters' => false
                                        );

                                        $custom_posts = get_posts($args);
                                        if($custom_posts){
                                            foreach ( $custom_posts as $custom_post ) {
                                                // $tag['raw_values'][] = $custom_post->post_title;
                                                // $tag['values'][] = $custom_post->post_title;
                                                // $tag['labels'][] = $custom_post->post_title; 
                                                ?>
                                                <option value="<?php echo $custom_post->post_title; ?>"><?php echo $custom_post->post_title; ?></option>
                                                <?php
                                            }
                                        }
                                        
                                    ?>
                                </select>
             <!--                    <div class ="form-group">  
             <div class = 'input-group date' id='datetimepicker3'>  
                <input type = 'text' class="form-control" />  
                <span class = "input-group-addon">  
                <span class = "glyphicon glyphicon-time"></span>  
                </span>  
             </div>  
          </div>   -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="form-fields star-in">
                                <label> 
                                    <?php if (ICL_LANGUAGE_CODE == 'en') { ?>
                                    Rating stars
                                    <?php }else{ ?>
                                    Bewertungssterne
                                    <?php } ?>
                                    <span class="red">*</span></label>
                                <!-- <input type="text" id="post_review_star" name="post_review_star" value="<?php $_POST['post_review_star'] ?>" /> -->

                                <div class="star text-left" style="display: inline-flex; flex-flow: row-reverse;">
                                    <input class="star star-5" id="star-5" type="radio" name="post_review_star" value="5" checked/>
                                    <label class="star star-5" for="star-5"></label>
                                    <input class="star star-4" id="star-4" type="radio" name="post_review_star" value="4" />
                                    <label class="star star-4" for="star-4"></label>
                                    <input class="star star-3" id="star-3" type="radio" name="post_review_star" value="3" />
                                    <label class="star star-3" for="star-3"></label>
                                    <input class="star star-2" id="star-2" type="radio" name="post_review_star" value="2" />
                                    <label class="star star-2" for="star-2"></label>
                                    <input class="star star-1" id="star-1" type="radio" name="post_review_star" value="1" required/>
                                    <label class="star star-1" for="star-1"></label>
                                </div>    
                            </div>
                            <div class="form-fields">
                                <label>
                                    <?php if (ICL_LANGUAGE_CODE == 'en') { ?>
                                    What did you like especially?
                                    <?php }else{ ?>
                                    Was hat Ihnen besonders gefallen? 
                                    <?php } ?>
                                <span class="red">*</span></label>
                                <textarea type="text" id="post_desc" name="post_desc" maxlength="140" required/></textarea>
                            </div>
                            <div class="form-fields" style="margin-top: 0;">
                                <input type="hidden" name="post_type" id="post_type" value="post_type" />
                                <input type="hidden" name="post_action" id="post_action" value="post_action" />
                                <button type="button" name="post_submit" value="Einreichen" id="review_submit" class="full-width"  />
                                <?php if (ICL_LANGUAGE_CODE == 'en') { ?>
                                Submit
                                <?php }else{ ?>
                                Einreichen
                                <?php } ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  

        
    </form>    
    <?php wp_nonce_field( 'new_review_nonce' ); ?>

</section>

<script type="text/javascript">
    var review_form_area = jQuery('section.review-form');
    var review_form = review_form_area.find('form#review-entry');
    var review_submit = jQuery('button#review_submit');

    var author_name = '';
    var review_date = '';
    var title       = '';
    var review_star = '';
    var desc        = '';
    var empty_field_error = '';

    review_form.on('change', function(author_name, review_date, title, review_star, desc){
        author_name = jQuery('input[name="post_author_name"]').val();
        review_date = jQuery('input[name="post_review_date"]').val();
        title       = jQuery('select[name="post_title"]').val();
        review_star = jQuery('input[name="post_review_star"]:checked').val();
        desc        = jQuery('textarea[name="post_desc"]').val();

        // console.log('Something has changed..');

        if(author_name != "" && review_date!= "" && title!= "" && review_star!= "" && desc!= ""){
            // console.log('Something has changed..');
            // console.log('Fields are filled now');
            // review_submit.removeAttr('disabled');
        }else{
            // review_submit.attr('disabled');
            // console.log('Fields are empty');
        }

        // console.log({author_name, review_date, title, review_star, desc});
    })

    // console.log('submit review will work...');

review_submit.on('click', function(e, author_name, review_date, title, review_star, desc){
    var request;
    var review_btn = jQuery(this);

    e.preventDefault();

    let active_langiage = document.querySelector('html').getAttribute('lang');
    if(active_langiage == 'de' || active_langiage == 'de-DE'){
        empty_field_error = 'Bitte füllen Sie alle Felder aus.';
    }else{
        empty_field_error = 'Please fill out all mandatory fields.';
    }
    console.log({active_langiage});
    

    author_name = jQuery('input[name="post_author_name"]').val();
    review_date = jQuery('input[name="post_review_date"]').val();
    title       = jQuery('select[name="post_title"]').val();
    review_star = jQuery('input[name="post_review_star"]:checked').val();
    desc        = jQuery('textarea[name="post_desc"]').val();

    if(author_name != "" && review_date!= "" && title!= "" && review_star!= "" && desc!= ""){
        request = jQuery.ajax({
            type: 'POST',
            url: my_ajax_object.ajax_url,
            data: {
                action: 'callback_submit_review', 
                'post_author_name': author_name,
                'post_review_date': review_date, 
                'post_title': title, 
                'post_review_star': review_star, 
                'post_desc': desc
            },
            beforeSend: function(){
              // console.log('before submitting..');
              review_btn.attr('disabled');
              review_btn.text(
                <?php if (ICL_LANGUAGE_CODE == 'en') { ?>
                    'Sending your review ...'
                <?php }else{ ?>
                    'Ihre Bewertung wird gesendet...'
                <?php } ?>
                );
            },
            success: function(msg){
                // console.log(msg);
                // console.log('Review Submited');
                alert(msg);
                // window.location.reload();
                review_btn.attr('disabled');
                review_btn.text(
                <?php if (ICL_LANGUAGE_CODE == 'en') { ?>
                    'Thank you for your valued feedback.'
                <?php }else{ ?>
                    'Besten Dank für Ihr geschätztes Feedback.'
                <?php } ?>
                );
            }
        });
    }else{
        alert(empty_field_error);
    }
})
</script>