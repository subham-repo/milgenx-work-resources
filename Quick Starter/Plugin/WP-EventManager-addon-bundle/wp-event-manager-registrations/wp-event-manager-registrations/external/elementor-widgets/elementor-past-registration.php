<?php
namespace WPEventManagerRegistration\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Past Registration
 *
 * Elementor widget for event past registration.
 *
 */
class Elementor_Past_Registration extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'past-registration';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Event Past Registration', 'wp-event-manager' );
	}
	/**	
	 * Get widget icon.
	 *
	 * Retrieve shortcode widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-lock-user';
	}
	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'past-registration', 'code' ];
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'wp-event-manager-categories' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_shortcode',
			[
				'label' => __( 'Event Past Registration', 'wp-event-manager' ),
			]
		);
	
		$this->add_control(
			'posts_per_page',
			[
				'label'       => __( 'Post Per Page', 'wp-event-manager' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => '10',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
	    $settings = $this->get_settings_for_display();
	    if($settings['posts_per_page']>0){
	        $posts_per_page = 'posts_per_page='.(int)$settings['posts_per_page'];
	        $settings['posts_per_page'] = 'posts_per_page='.(int)$settings['posts_per_page'];
	    }else{
	        $posts_per_page = '';
	        $settings['posts_per_page'] = '';
	    }
	    echo do_shortcode('[past_registrations '.$posts_per_page.' ]');	
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @access protected
	 */
	protected function _content_template() {

	    $shortcode = do_shortcode('[past_registrations {{{settings.posts_per_page}}} ]');
		?>
		<div class="elementor-shortcode"><?php echo $shortcode; ?></div>
		<?php
	}
}
