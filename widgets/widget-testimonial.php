<?php

namespace Testimonials_BforeAi\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class WidgetsTestimonial extends Widget_Base {
	public function get_name() {
		return 'Testimonials - BforeAi';
	}
	public function get_title() {
		return __( 'Testimonials - BforeAi' );
	}
	public function get_icon() {
		return 'eicon-drag-n-drop';
	}
	public function get_categories(){
		return ['dt-widgets'];
	}
	protected function register_controls() {
		$this->start_controls_section(
			'section_testimonial',
			[
				'label' => 'Settings Testimonial',
			]
		);
		// $this->add_control(
	    //   'testimonial_title',
	    //   [
	    //     'label' => __( 'Title', 'widgetstestimonialdt' ),
	    //     'type' => Controls_Manager::TEXT,
	    //     'placeholder' => __( 'Title', 'widgetstestimonialdt' ),
	    //     'default' => __('What Clients Say', 'widgetstestimonialdt'),
	    //     'label_block' => true,
	    //   ]
	    // );
	    // $this->add_control(
	    //   'testimonial_view',
	    //   [
	    //     'label' => esc_html__( 'Template', 'widgetstestimonialdt' ),
	    //     'type' => Controls_Manager::SELECT,
	    //     'default' => '1',
	    //     'options' => [
	    //       /*'5' => esc_html__( '5', 'widgetstestimonialdt' ),
	    //       '4' => esc_html__( '4', 'widgetstestimonialdt' ),*/
	    //       '3' => esc_html__( '3', 'widgetstestimonialdt' ),
	    //       '2' => esc_html__( '2', 'widgetstestimonialdt' ),
	    //       '1' => esc_html__( '1', 'widgetstestimonialdt' ),
	    //     ],
	    //     'frontend_available' => true,
	    //   ]
	    // );
		$this->end_controls_section();

		// $this->start_controls_section(
		// 	'section_testimonial_repeat',
		// 	[
		// 		'label' => 'Settings Testimonial content',
		// 	]
		// );

		// $repeater_testimonial  = new \Elementor\Repeater();

	    // $repeater_testimonial->add_control(
		// 	'testimonial_image',
		// 	[
		// 		'label' => esc_html__( 'Choose Image', 'widgetstestimonialdt' ),
		// 		'type' => \Elementor\Controls_Manager::MEDIA,
		// 		'default' => [
		// 			'url' => \Elementor\Utils::get_placeholder_image_src(),
		// 		],
		// 		'description' => __('resolución sugerida 291x249', 'widgetstestimonialdt' ),
		// 	]
		// );

	    // $repeater_testimonial->add_control(
	    //   'testimonial_name',
	    //   [
	    //     'label' => __( 'Title', 'widgetstestimonialdt' ),
	    //     'type' => Controls_Manager::TEXT,
	    //     'placeholder' => __( 'Title', 'widgetstestimonialdt' ),
	    //     'default' => __( 'Jhon Due', 'widgetstestimonialdt' ),
	    //     'label_block' => true,
	    //   ]
	    // );

	    // $repeater_testimonial->add_control(
	    //   'testimonial_description',
	    //   [
	    //     'label' => __( 'Testimonial', 'widgetstestimonialdt' ),
	    //     'type' => Controls_Manager::TEXTAREA,
	    //     'placeholder' => __( 'Testimonial', 'widgetstestimonialdt' ),
	    //     'default' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. It is a long established fact that a reader will be distracted by the readable its layout.', 'widgetstestimonialdt' ),
	    //     'label_block' => true,
	    //   ]
	    // );

	    // $repeater_testimonial->add_control(
	    //   'testimonial_rating',
	    //   [
	    //     'label' => esc_html__( 'Stars', 'widgetstestimonialdt' ),
	    //     'type' => Controls_Manager::SELECT,
	    //     'default' => '5',
	    //     'options' => [
	    //       '5' => esc_html__( '5', 'widgetstestimonialdt' ),
	    //       '4' => esc_html__( '4', 'widgetstestimonialdt' ),
	    //       '3' => esc_html__( '3', 'widgetstestimonialdt' ),
	    //       '2' => esc_html__( '2', 'widgetstestimonialdt' ),
	    //       '1' => esc_html__( '1', 'widgetstestimonialdt' ),
	    //     ],
	    //     'frontend_available' => true,
	    //   ]
	    // );

	    // $this->add_control(
	    //   'testimonial_list',
	    //   [
	    //     'label' => __( 'Testimonials list', 'widgetstestimonialdt' ),
	    //     'type' => \Elementor\Controls_Manager::REPEATER,
	    //     'fields' => $repeater_testimonial->get_controls(),
	    //     'default' => [
	    //       [
	    //         'testimonial_name' => __( 'Juan', 'widgetstestimonialdt' ),
	    //         'testimonial_description' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. It is a long established fact that a reader will be distracted by the readable its layout.', 'widgetstestimonialdt' ),
	    //       ],
	    //     ],
	    //     'title_field' => '{{{ testimonial_name }}}',
	    //   ]
	    // );

	//	$this->end_controls_section();
	}


	// Render
	protected function render(){
		// $this->get_settings_for_display();

		// $settings_org = $this->get_settings_for_display();

		// var_dump($settings_org['testimonial_list']);

	


		$args = array(
			'numberposts'	=> 20,
			'post_type'   => 'testimonials_bforeai'
		);
		$my_posts = get_posts( $args );
		$testimonials = array();
		if( ! empty( $my_posts ) ){
			$output = '<ul>';
			
			foreach ( $my_posts as $key => $post ){
				$post_ID = $post->ID;
				
				if (class_exists('acf')){
					$testimonials[$key]['url'] = get_field('image',$post_ID);;
					$testimonials[$key]['name'] = get_field('name',$post_ID);;
					$testimonials[$key]['position_or_function'] = get_field('position_or_function',$post_ID);
					$testimonials[$key]['title'] = get_field('title',$post_ID);
					$testimonials[$key]['description'] = get_field('description',$post_ID);
				}


			}
			$output .= '<ul>';
		}
		//echo $output;
	    //var_dump($testimonials);
		
		if ($testimonials){ ?>
			<div class="container testimonial3  text-center">
	            <div class="heading white-heading"><?php // echo esc_attr($settings['testimonial_title']); ?></div>
				<div id="carouselExampleIndicators" class="carousel slide testimonial3_control_button" data-bs-ride="true">
				  <div class="carousel-indicators">
				  		<?php $slider3count1 = 0; ?>
		      			<?php foreach ($testimonials as $item1) { ?>
		      				<?php $slider3ClassActive1 = ($slider3count1 == 0) ? 'active' : ''; ?>
				    		<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $slider3count1; ?>" class="<?php echo $slider3ClassActive1; ?>" aria-current="true" aria-label="Slide"></button>
				    		<?php $slider3count1++; ?> 
						<?php } ?>
				  </div>
				  <div class="carousel-inner" id="testimonial3">
				  		<?php $slider3count = 1; ?>
		      			<?php foreach ($testimonials as $item) { ?>
		      				<?php $slider3ClassActive = ($slider3count == 1) ? 'active' : ''; ?>
						  	<div class="carousel-item <?php echo $slider3ClassActive; ?>">
						  		<div class="testimonial3_slide">
						  			<img src="<?php echo esc_attr($item['url']); ?>" class="img-circle img-responsive" />
						  			<h2><?php echo esc_attr($item['name']); ?></h2>
									<p><?php echo esc_attr($item['position_or_function']); ?></p>
									<p><?php  //echo $item;// esc_attr($item['testimonial_description']); ?></p>
						  			<h4><?php echo esc_attr($item['title']); ?></h4>
									<p><?php echo esc_attr($item['description']); ?></p>
						  		</div>
						  	</div>
						  	<?php $slider3count++; ?> 
						<?php } ?>
				  </div>
				  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="visually-hidden">Previous</span>
				  </button>
				  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="visually-hidden">Next</span>
				  </button>
				</div>	
			</div>
		<?php }
	}
}