<!-- template-files/case-study-navigation -->
<div class="case-navigation-row">
    <h2>Real Results, Real Industries - Pick Yours</h2>
    <?php
        $current_term = get_queried_object();
        // print_r($current_term);

        $args = array(
        'taxonomy'     => 'case-category',
        'orderby'      => 'ASC',
        'show_count'   => true,
        // 'pad_counts'   => $pad_counts,
        // 'hierarchical' => $hierarchical,
        // 'title_li'     => $title,
        'hide_empty'   => true,
    );
    $all_categories = get_categories( $args );
    $isSelected = '';

    echo "<select class='case-options'>";
    if( $current_term->slug ){ 
        $isSelected = $current_term->name.'&nbsp;('.$current_term->count.')';
    }else{
        $isSelected = "Select Industries";
    }
    echo '<option>'.$isSelected.'</option>';
    foreach ($all_categories as $cat) {
        if($cat->category_parent == 0) {
            $category_id = $cat->term_id;  
            echo '<option class="cat-option" value="'. get_term_link($cat->slug, 'case-category') .'">'. $cat->name .'&nbsp;('.$cat->count.')'.'</option>';
        }
    }
    echo "</select>";
    ?>
</div>

<style>
    .case-navigation-row {
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        display: flex;
        flex-flow: column;
        justify-content: center;
        align-items: center;
        gap: 15px;
        text-align: center;
        margin-bottom: 20px;
    }
    .case-navigation-row .case-options .current {
        font-weight: 600;
    }

    .case-navigation-row .case-options {
        max-width: 410px;
        background-color: #e6e8fa;
    } 
    .case-navigation-row .case-options .option.focus, 
    .case-navigation-row .case-options .option.selected, 
    .case-navigation-row .case-options .option.selected.focus {
        background-color: #2060e7 !important;
        color: #fff;
    }
    .case-navigation-row .case-options .option:hover {
        background-color: #e6e8fa;
    }
</style>

<script>
    window.addEventListener("load", function(){
        let caseOptions = document.querySelectorAll(".case-options .option");
        caseOptions.forEach(function(caseOption){
            caseOption.addEventListener("click", function(){
                console.log(caseOption.getAttribute("data-value"))
                window.location.href = caseOption.getAttribute("data-value");
            })
        })
    })
</script>