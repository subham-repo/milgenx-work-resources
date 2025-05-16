<?php
/**
 * Clubio: Customizer
 *
 * @package Clubio
 */
function clubio_customize_register( $wp_customize ) {
    //fonts sizes adding
    class Customizer_Range_Value_Control extends \WP_Customize_Control {
        public $type = 'range-value';
        public function enqueue() {
            wp_enqueue_script('customizer-range-value-control', get_template_directory_uri() . '/inc/customizer/js/customizer-range-value-control.js', array('jquery'), false, true);
            wp_enqueue_style('customizer-range-value-control', get_template_directory_uri(). '/inc/customizer/css/customizer-range-value-control.css', array(), false, 'all' );
        }
        public function render_content() {  ?>
        <label>
            <span class="customize-control-title"><?php echo esc_attr( $this->label ); ?></span>
            <div class="range-slider"  style="width:100%; display:flex;flex-direction: row;justify-content: flex-start;">
				<span style="width:100%; flex: 1 0 0; vertical-align: middle;"><input class="range-slider__range" type="range" value="<?php echo esc_attr( $this->value() ); ?>"
                    <?php   $this->input_attrs(); $this->link(); ?>
                    >
				<span class="range-slider__value">0</span></span>
            </div>
            <?php if ( ! empty( $this->description ) ) : ?><span class="description customize-control-description"><?php echo esc_attr ($this->description); ?></span><?php endif; ?>
        </label>
        <?php
        }
    }
    $section_fonts_header = 'clubio_fonts_header';
    $section_fonts_footer = 'clubio_fonts_footer';

    $wp_customize->add_panel('clubio_fonts',array(
        'title' => esc_html__( 'Theme Fonts Sizes','clubio' ),
        'priority' => 20,
    ));
    $wp_customize->add_section($section_fonts_header,array(
        'title' =>  esc_html__( 'Header blocks','clubio' ),
        'priority' => 10,
        'panel' => 'clubio_fonts',
    ));
    $wp_customize->add_section($section_fonts_footer,array(
        'title' =>  esc_html__( 'Footer blocks','clubio' ),
        'priority' => 20,
        'panel' => 'clubio_fonts',
    ));
    $clubio_fonts_params = array(
        array('font_h_menu','Header Menu items: top level',$section_fonts_header),
        array('font_h_menu_sub','Header Menu items: sub levels',$section_fonts_header),
        array('font_h_i','Header icons',$section_fonts_header),

        array('font_f_menu','Footer Menu font',$section_fonts_footer),
        array('font_f_head','Footer Texts font',$section_fonts_footer),
        array('font_f_links','Footer Links font',$section_fonts_footer),
        array('font_f_heading','Footer Headings font',$section_fonts_footer),
        array('font_f_i','Footer Icons size',$section_fonts_footer),
        array('font_f_copyright','Footer copyright font',$section_fonts_footer),
        array('font_f_copyright_l','Footer copyright links',$section_fonts_footer),
    );
    foreach ($clubio_fonts_params as $clubio_fonts_param) :
        $section = (isset($clubio_fonts_param[2]) ? $clubio_fonts_param[2] : '');

        $param = $clubio_fonts_param[0];
        $label = $clubio_fonts_param[1];
        $description = (isset($clubio_fonts_param[3]) ? $clubio_fonts_param[3] : '');

        $wp_customize->add_setting($param,array('default' => '','transport' => 'refresh','sanitize_callback' => 'clubio_sanitize_fonts'));
        $wp_customize->add_control( new Customizer_Range_Value_Control( $wp_customize, $param, array(
            'type'     => 'range-value',
            'section'  => $section,
            'settings' => $param,
            'label'   => wp_kses($label, clubio_tags()),
            'description' => esc_attr($description ),
            'input_attrs' => array(
                'min'    => 10,
                'max'    => 40,
                'step'   => 1,
                'suffix' => 'px', //optional suffix
            )
        ) ) );

    endforeach;
//fonts sizes adding




    $wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'clubio_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'clubio_customize_partial_blogdescription',
	) );


    $wp_customize->selective_refresh->add_partial( 'clubio_activate', array(
        'selector' => '.site-title a',
        'render_callback' => 'clubio_customize_partial_clubio_activate',
    ) );


    $wp_customize->add_section( 'clubio_activate', array(
            'title'       => esc_html__( 'Clubio Activation Code', 'clubio' ),
            'priority'    => 10,
            'capability'  => 'edit_theme_options',
        )
    );
    $wp_customize->add_setting( 'ch_theme_code', array(
            'default'    => '',
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ch_theme_code', array(
            'label'      => esc_html__( 'Write Purchased Code', 'clubio' ),
            'settings'   => 'ch_theme_code',
            'priority'   => 10,
            'section'    => 'clubio_activate',
            'type'    => 'text'
        )
    ) );
    $wp_customize->add_section( 'clubio_general', array(
            'title'       => esc_html__( 'Clubio General Settings', 'clubio' ),
            'priority'    => 10,
            'capability'  => 'edit_theme_options',

        )
    );
    $wp_customize->add_setting( 'clubio_blog_type', array(
            'default'    => 'simple',
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
            'transport' => 'refresh',
        )
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'clubio_blog_type', array(
            'label'      => esc_html__( 'Type of Blog Posts Page', 'clubio' ),
            'settings'   => 'clubio_blog_type',
            'priority'   => 20,
            'section'    => 'clubio_general',
            'type'    => 'select',
            'choices' => array(
                'simple' => 'Usual Blog Posts Page',
                'grid' => 'Grid Posts Page without Sidebar',
                'grid_s' => 'Grid Posts Page with Sidebar'
            )
        )
    ) );

    //preloader
    $wp_customize->add_setting('theme_preloader_use', array(
        'capability' => 'edit_theme_options',
        'type'       => 'theme_mod',
        'sanitize_callback' => 'esc_attr'
    ));
    $wp_customize->add_control('theme_preloader_use', array(
        'settings' => 'theme_preloader_use',
        'label'      => esc_html__( 'Using of preloader', 'clubio' ),
        'section'  => 'clubio_general',
        'type'     => 'checkbox',
        'priority'   => 30,
        'description' => 'Enable to add a preloader'
    ));





    $wp_customize->add_setting( 'theme_preloader', array(
            'default'    => 'simple',
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'theme_html_sanitation',
            'transport' => 'refresh',
        )
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_preloader', array(
            'label'      => esc_html__( 'Preloader html', 'clubio' ),
            'settings'   => 'theme_preloader',
            'priority'   => 40,
            'section'    => 'clubio_general',
            'type'    => 'textarea'
        )
    ) );


    function theme_html_sanitation( $text ) {
        //return addslashes( $text );
        return  wp_kses($text, clubio_tags());
    }

    //end preloader









    $wp_customize->add_setting('clubio_theme_c_activate', array(
        'capability' => 'edit_theme_options',
        'type'       => 'theme_mod',
        'sanitize_callback' => 'esc_attr'
    ));
    $wp_customize->add_control('clubio_theme_c_activate', array(
        'settings' => 'clubio_theme_c_activate',
        'label'      => esc_html__( 'Using of custom options', 'clubio' ),
        'section'  => 'clubio_general',
        'type'     => 'checkbox',
        'description' => 'Enable to choose custom theme options'
    ));

    $wp_customize->add_panel('theme_settings_colors',array(
        'title'=>'Theme Colors',
        'description'=> 'Theme Colors, Backgrounds',
        'priority'=> 11,
    ));
    $wp_customize->add_section('color_general',array(
        'title'=>'Colors (General)',
        'priority'=>10,
        'panel'=>'theme_settings_colors',
    ));

    $wp_customize->add_section('color_header',array(
        'title'=>'Colors (Header)',
        'priority'=>11,
        'panel'=>'theme_settings_colors',
    ));

    $wp_customize->add_section('color_footer',array(
        'title'=>'Colors (Footer)',
        'priority'=>12,
        'panel'=>'theme_settings_colors',
    ));

    $wp_customize->add_section('color_content',array(
        'title'=>'Colors (Content)',
        'priority'=>12,
        'panel'=>'theme_settings_colors',
    ));

    $wp_customize->add_section('color_blog',array(
        'title'=>'Colors (Blog)',
        'priority'=>12,
        'panel'=>'theme_settings_colors',
    ));

    $clubio_color_params = array(
        array('clubio_theme_color','Primary color','color_general'),
        array('clubio_theme_color_2','Secondary color','color_general'),

        array('color_general_body_bg','Background: All Site','color_general'),
        array('color_general_bg_light','Background: Light Blocks','color_general'),
        //array('color_general_bg_dark','Background: Dark Blocks','color_general'),

        array('color_general_btn_top_bg','Back Top Button Background','color_general'),
        //array('color_general_btns_player','Player Buttons/Texts Color','color_general'),

        array('color_header_bg','Header Background Color','color_header'),
        array('color_header_sticky_bg','Header Sticky Background Color','color_header'),
        array('color_header_l','Header Menu/Links Color','color_header'),
        array('color_header_l_h','Header Menu/Links Hover Color','color_header'),
        array('color_header_dd_bg','Header Menu Dropdown Blocks Background Color','color_header'),
        array('color_header_dd_l','Header Menu Dropdown Links Color','color_header'),
        array('color_header_dd_l_h','Header Menu Dropdown Links Hover Color','color_header'),

        array('color_footer_bg','Footer Background Color','color_footer'),
        array('bg_image_footer','Footer background image, width > 1024px','color_footer','image'),
        array('bg_image_footer2','Footer background image, width 576-1024px','color_footer','image'),
        array('bg_image_footer3','Footer background image, width < 576px','color_footer','image'),





        array('color_footer_t','Footer Text Color','color_footer'),
        array('color_footer_l','Footer Links Color','color_footer'),
        array('color_footer_l_h','Footer Links Hover Color','color_footer'),
        array('color_footer_i','Footer Icons Color','color_footer'),
        array('color_footer_i_h','Footer Icons Hover Color','color_footer'),
        array('color_footer_titles','Footer Titles Color','color_footer'),

        array('color_content_headings','Content Headings Color','color_content'),
        array('color_content_headings_dark','Content Headings in Dark Blocks Color','color_content'),


        array('color_content_title_heading','Page Title Heading Color','color_content'),
        //array('color_content_title_bc_bg','Page Title Breadcrumb wrapper Background Color','color_content'),

        array('color_content_title_t','Page Title Text Color','color_content'),
        array('color_content_title_l','Page Title Link Color','color_content'),
        array('color_content_title_l_h','Page Title Link Hover Color','color_content'),

        array('color_blog_bg','Blog Pages Background Color','color_blog'),
        array('color_content_title_bg','Page Blog Title Background Color','color_blog'),
        array('bg_image_title','Page Blog Title background image','color_blog','image'),

    );
    $param = $label = $section = '';

    foreach ($clubio_color_params as $clubio_color_param) :
        $param = $clubio_color_param[0];
        $label = $clubio_color_param[1];
        $section = $clubio_color_param[2];
        $image_bg = (isset($clubio_color_param[3]) ? 'image' : '');
        if ($image_bg != '') {
            $wp_customize->add_setting($param, array(
                'transport'         => 'refresh',
                'height'         => 100,
                'sanitize_callback' => 'esc_attr'
            ));
            $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $param, array(
                'label'             => esc_attr($label ),
                'section'           => esc_attr($section),
                'settings'          => $param,
                'active_callback' => 'clubio_has_custom_colors',

            )));
        } else {

            $wp_customize->add_setting( $param, array(
                'default'   => '',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $param, array(
                'section' => esc_attr($section),
                'label'   => esc_attr($label ),
                'active_callback' => 'clubio_has_custom_colors',

            ) ) );
        }
    endforeach;

}
add_action( 'customize_register', 'clubio_customize_register' );
function clubio_customize_partial_blogname() {
	bloginfo( 'name' );
}
function clubio_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
function clubio_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}
function clubio_is_view_with_layout_option() {
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}
function clubio_customize_preview_js() {
    wp_enqueue_script('clubio-script-cust', get_template_directory_uri() . '/assets/js/customize-preview.js', array('jquery'), false, true);
}
add_action( 'customize_preview_init', 'clubio_customize_preview_js' );
function clubio_panels_js() {
    wp_enqueue_script('clubio-script-cc', get_template_directory_uri() . '/assets/js/customize-controls.js', array('jquery'), false, true);

}
add_action( 'customize_controls_enqueue_scripts', 'clubio_panels_js' );
function clubio_has_custom_colors() {
    $clubio_theme_c_activate = get_theme_mod( 'clubio_theme_c_activate' );
    return ( $clubio_theme_c_activate == 1 );
}

function clubio_has_lic() {
    $domain = 'https://verify2.softali.net/'; $server = home_url(); $theme_id = '28147902'; $link = 'https://verify2.softali.net/verify?'; $theme_code = get_theme_mod( 'ch_theme_code' );

    if (strpos($server, 'localhost') !== false){
        $code_number = true; return $code_number;
    } else{
        if (!filter_var($domain, FILTER_VALIDATE_URL)) { return false; } $curlInit = curl_init($domain); curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10); curl_setopt($curlInit,CURLOPT_HEADER,true); curl_setopt($curlInit,CURLOPT_NOBODY,true); curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true); $host_response = curl_exec($curlInit); curl_close($curlInit);

        if ($host_response) {
            $result = ''; $data = array('domain' => $server, 'lic' => $theme_code, 'url' => $server, 'themeId' => $theme_id);
            $query_content = http_build_query($data);
            $response = wp_remote_get( $link. $query_content );

            if( is_array($response) ) {
                $result = $response['body'];
            }
            $result = json_decode($result, true);
            $code_number = $result['code'];

            if ($result) {
                if ($code_number == 2 || $code_number == 1) {$code_number = 1; return $code_number;}
            } else {
                $code_number = 1;
                return $code_number;
            }
        } else {
            $code_number = true; return $code_number;
        }
    }
}


//Google Fonts
function clubio_sanitize_fonts( $input ) {
    $valid = array(
        'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
        'Open Sans:400italic,700italic,400,700' => 'Open Sans',
        'Oswald:400,700' => 'Oswald',
        'Playfair Display:400,700,400italic' => 'Playfair Display',
        'Montserrat:400,700' => 'Montserrat',
        'Raleway:400,700' => 'Raleway',
        'Droid Sans:400,700' => 'Droid Sans',
        'Lato:400,700,400italic,700italic' => 'Lato',
        'Arvo:400,700,400italic,700italic' => 'Arvo',
        'Lora:400,700,400italic,700italic' => 'Lora',
        'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
        'Oxygen:400,300,700' => 'Oxygen',
        'PT Serif:400,700' => 'PT Serif',
        'PT Sans:400,700,400italic,700italic' => 'PT Sans',
        'PT Sans Narrow:400,700' => 'PT Sans Narrow',
        'Cabin:400,700,400italic' => 'Cabin',
        'Fjalla One:400' => 'Fjalla One',
        'Francois One:400' => 'Francois One',
        'Josefin Sans:400,300,600,700' => 'Josefin Sans',
        'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
        'Arimo:400,700,400italic,700italic' => 'Arimo',
        'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
        'Bitter:400,700,400italic' => 'Bitter',
        'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
        'Roboto:400,400italic,700,700italic' => 'Roboto',
        'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
        'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
        'Roboto Slab:400,700' => 'Roboto Slab',
        'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
        'Rokkitt:400' => 'Rokkitt',
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
class theme_customizer {
    public function __construct() {
        add_action( 'customize_register', array(&$this, 'customize_clubio_g_fonts' ));
    }

    public function customize_clubio_g_fonts( $wp_manager ) {
        $this->clubio_fonts_sections( $wp_manager );
    }

    private function clubio_fonts_sections( $wp_manager ) {
        $wp_manager->add_section( 'clubio_g_fonts_section', array(
            'title'       => esc_html__( 'Theme Google Fonts', 'clubio' ),
            'priority'       => 16,

        ) );
        $font_choices = array(
            '' => '-',
            'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
            'Open Sans:400italic,700italic,400,700' => 'Open Sans',
            'Oswald:400,700' => 'Oswald',
            'Playfair Display:400,700,400italic' => 'Playfair Display',
            'Montserrat:400,700' => 'Montserrat',
            'Raleway:400,700' => 'Raleway',
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
            'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
            'Oxygen:400,300,700' => 'Oxygen',
            'PT Serif:400,700' => 'PT Serif',
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
            'Cabin:400,700,400italic' => 'Cabin',
            'Fjalla One:400' => 'Fjalla One',
            'Francois One:400' => 'Francois One',
            'Josefin Sans:400,300,600,700' => 'Josefin Sans',
            'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt',
        );
        $wp_manager->add_setting( 'clubio_headings_fonts', array(
                'sanitize_callback' => 'clubio_sanitize_fonts',
                'transport' => 'refresh',
            )
        );
        $wp_manager->add_control( 'clubio_headings_fonts', array(
                'type' => 'select',
                'description' => esc_html__('Select any font for the headings and highlighted texts.', 'clubio'),
                'section' => 'clubio_g_fonts_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'clubio_body_fonts', array(
                'sanitize_callback' => 'clubio_sanitize_fonts',
                'transport' => 'refresh'
            )
        );
        $wp_manager->add_control( 'clubio_body_fonts', array(
                'type' => 'select',
                'description' => esc_html__( 'Select any font for the body/some texts.', 'clubio' ),
                'section' => 'clubio_g_fonts_section',
                'choices' => $font_choices
            )
        );
    }
}

new theme_customizer();
