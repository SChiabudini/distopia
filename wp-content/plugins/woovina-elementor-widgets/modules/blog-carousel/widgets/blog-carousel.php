<?php
namespace wvnElementor\Modules\BlogCarousel\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Blog_Carousel extends Widget_Base {

	public function get_name() {
		return 'wew-blog-carousel';
	}

	public function get_title() {
		return __('Blog Carousel', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-post-slider';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_script_depends() {
		return [ 'wew-blog-carousel', 'slick' ];
	}

	public function get_style_depends() {
		return [ 'wew-blog-carousel' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_blog_carousel',
			[
				'label' 		=> __('Carousel', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'arrows',
			[
				'label' 		=> __('Display Arrows', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> __('Show', 'woovina-elementor-widgets'),
					'false' 	=> __('Hide', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'items',
			[
				'label' 		=> __('Items To Display', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '3',
				'label_block' 	=> true,
			]
		);

		$this->add_control(
			'tablet',
			[
				'label' 		=> __('Tablet: Items To Display', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '2',
				'label_block' 	=> true,
			]
		);

		$this->add_control(
			'mobile',
			[
				'label' 		=> __('Mobile: Items To Display', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '1',
				'label_block' 	=> true,
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_query',
            [
                'label' => __('Query', 'woovina-elementor-widgets')
            ]
       );

		$this->add_control(
			'post_type',
			[
				'label' 		=> __('Post Type', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '0',
				'options' 		=> $this->get_available_post_types(),
			]
		);

		$this->add_control(
			'count',
			[
				'label' 		=> __('Post Count', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '6',
				'label_block' 	=> true,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'order',
			[
				'label' 		=> __('Order', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '',
				'options' 		=> [
					'' 			=> __('Default', 'woovina-elementor-widgets'),
					'DESC' 		=> __('DESC', 'woovina-elementor-widgets'),
					'ASC' 		=> __('ASC', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' 		=> __('Order By', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '',
				'options' 		=> [
					'' 				=> __('Default', 'woovina-elementor-widgets'),
					'date' 			=> __('Date', 'woovina-elementor-widgets'),
					'title' 		=> __('Title', 'woovina-elementor-widgets'),
					'name' 			=> __('Name', 'woovina-elementor-widgets'),
					'modified' 		=> __('Modified', 'woovina-elementor-widgets'),
					'author' 		=> __('Author', 'woovina-elementor-widgets'),
					'rand' 			=> __('Random', 'woovina-elementor-widgets'),
					'ID' 			=> __('ID', 'woovina-elementor-widgets'),
					'comment_count' => __('Comment Count', 'woovina-elementor-widgets'),
					'menu_order' 	=> __('Menu Order', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'include_categories',
			[
				'label' 		=> __('Include Categories', 'woovina-elementor-widgets'),
				'description' 	=> __('Enter the categories slugs seperated by a "comma"', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
			]
		);

		$this->add_control(
			'exclude_categories',
			[
				'label' 		=> __('Exclude Categories', 'woovina-elementor-widgets'),
				'description' 	=> __('Enter the categories slugs seperated by a "comma"', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_elements',
            [
                'label' => __('Elements', 'woovina-elementor-widgets')
            ]
       );

		$this->add_control(
			'image_size',
			[
				'label' 		=> __('Image Size', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'medium',
				'options' 		=> $this->get_img_sizes(),
			]
		);

		$this->add_control(
			'title',
			[
				'label' 		=> __('Title', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> __('Show', 'woovina-elementor-widgets'),
					'false' 	=> __('Hide', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'meta',
			[
				'label' 		=> __('Meta', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> __('Show', 'woovina-elementor-widgets'),
					'false' 	=> __('Hide', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'author',
			[
				'label' 		=> __('Author Meta', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> __('Show', 'woovina-elementor-widgets'),
					'false' 	=> __('Hide', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'date',
			[
				'label' 		=> __('Date Meta', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> __('Show', 'woovina-elementor-widgets'),
					'false' 	=> __('Hide', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'cat',
			[
				'label' 		=> __('Categories Meta', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> __('Show', 'woovina-elementor-widgets'),
					'false' 	=> __('Hide', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'comments',
			[
				'label' 		=> __('Comments Meta', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> __('Show', 'woovina-elementor-widgets'),
					'false' 	=> __('Hide', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'excerpt',
			[
				'label' 		=> __('Excerpt', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> __('Show', 'woovina-elementor-widgets'),
					'false' 	=> __('Hide', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label' 		=> __('Excerpt Length', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '15',
				'label_block' 	=> true,
			]
		);

		$this->add_control(
			'readmore_text',
			[
				'label' 		=> __('Learn More Text', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __('Learn More', 'woovina-elementor-widgets'),
				'label_block' 	=> true,
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_arrows',
			[
				'label' 		=> __('Arrows', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-carousel .slick-arrow' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'arrows_hover_color',
			[
				'label' 		=> __('Color: Hover', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-carousel .slick-arrow:hover' => 'color: {{VALUE}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			[
				'label' 		=> __('Content', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-carousel .wew-carousel-entry-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_bg_',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-carousel .wew-carousel-entry-details' => 'background-color: {{VALUE}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' 		=> __('Title', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-carousel .entry-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' 		=> __('Color: Hover', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-carousel .entry-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typo',
				'selector' 		=> '{{WRAPPER}} .wew-carousel .entry-title',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_meta',
			[
				'label' 		=> __('Meta', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} ul.meta, {{WRAPPER}} ul.meta li a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_links_hover_color',
			[
				'label' 		=> __('Links Color: Hover', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} ul.meta li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_icons_color',
			[
				'label' 		=> __('Icons Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-carousel .meta li i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'meta_typo',
				'selector' 		=> '{{WRAPPER}} ul.meta',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_excerpt',
			[
				'label' 		=> __('Excerpt', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-carousel .wew-carousel-entry-excerpt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'excerpt_typo',
				'selector' 		=> '{{WRAPPER}} .wew-carousel .wew-carousel-entry-excerpt',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[
				'label' 		=> __('Button', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-carousel .readmore-btn a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' 		=> __('Color: Hover', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-carousel .readmore-btn a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typo',
				'selector' 		=> '{{WRAPPER}} .wew-carousel .readmore-btn a',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

        $this->end_controls_section();

	}

	protected function get_available_post_types() {

		$post_type_args = [
			// Default is the value $public.
			'show_in_nav_menus' => true,
		];

		if(! empty($args['post_type'])) {
			$post_type_args['name'] = $args['post_type'];
		}

		$post_types = get_post_types($post_type_args , 'objects');

		$result = array(__('-- Select --', 'woovina-elementor-widgets'));

		foreach($post_types as $post_type => $object) {
			$result[ $post_type ] = $object->label;
		}

		return $result;
	}

	public function get_img_sizes() {
		global $_wp_additional_image_sizes;

		$sizes = array();
	    $get_intermediate_image_sizes = get_intermediate_image_sizes();
	 
	    // Create the full array with sizes and crop info
	    foreach($get_intermediate_image_sizes as $_size) {
	        if(in_array($_size, array('thumbnail', 'medium', 'medium_large', 'large'))) {
	            $sizes[ $_size ]['width'] 	= get_option($_size . '_size_w');
	            $sizes[ $_size ]['height'] 	= get_option($_size . '_size_h');
	            $sizes[ $_size ]['crop'] 	= (bool) get_option($_size . '_crop');
	        } elseif(isset($_wp_additional_image_sizes[ $_size ])) {
	            $sizes[ $_size ] = array(
	                'width' 	=> $_wp_additional_image_sizes[ $_size ]['width'],
	                'height' 	=> $_wp_additional_image_sizes[ $_size ]['height'],
	                'crop' 		=> $_wp_additional_image_sizes[ $_size ]['crop'],
	           );
	        }
	    }

	    $image_sizes = array();

		foreach($sizes as $size_key => $size_attributes) {
			$image_sizes[ $size_key ] = ucwords(str_replace('_', ' ', $size_key)) . sprintf(' - %d x %d', $size_attributes['width'], $size_attributes['height']);
		}

		$image_sizes['full'] 	= _x('Full', 'Image Size Control', 'woovina-portfolio');

	    return $image_sizes;
	}

	protected function render() {
		$settings = $this->get_settings();

		// Post type
		$post_type = $settings['post_type'];
		$post_type = $post_type ? $post_type : 'post';

		$args = array(
	        'post_type'         => $post_type,
	        'posts_per_page'    => $settings['count'],
	        'order'             => $settings['order'],
	        'orderby'           => $settings['orderby'],
			'no_found_rows' 	=> true,
			'tax_query' 		=> array(
				'relation' 		=> 'AND',
			),
	   );

	    // Include/Exclude categories
	    $include = $settings['include_categories'];
	    $exclude = $settings['exclude_categories'];

	    // Include category
		if(! empty($include)) {

			// Sanitize category and convert to array
			$include = str_replace(', ', ',', $include);
			$include = explode(',', $include);

			// Add to query arg
			$args['tax_query'][] = array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $include,
				'operator' => 'IN',
			);

		}

		// Exclude category
		if(! empty($exclude)) {

			// Sanitize category and convert to array
			$exclude = str_replace(', ', ',', $exclude);
			$exclude = explode(',', $exclude);

			// Add to query arg
			$args['tax_query'][] = array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $exclude,
				'operator' => 'NOT IN',
			);

		}

	    // Build the WordPress query
	    $wew_query = new \WP_Query($args);

		$counter = 0;

		//Output posts
		if($wew_query->have_posts()) :

			// Vars
			$title   	= $settings['title'];
			$meta    	= $settings['meta'];
			$excerpt 	= $settings['excerpt'];
			$readmore 	= $settings['readmore_text'];

			// Image size
			$img_size 		= $settings['image_size'];
			$img_size 		= $img_size ? $img_size : 'medium';

			// Data settings
			$carousel_settings = [
	            'arrows' 	=> ('true' === $settings['arrows']),
	            'items' 	=> $settings['items'],
	            'tablet' 	=> $settings['tablet'],
	            'mobile' 	=> $settings['mobile'],
	        ];

        	$this->add_render_attribute('data', 'data-settings', wp_json_encode($carousel_settings)); ?>

			<div class="wew-carousel wew-carousel-blog clr" <?php echo $this->get_render_attribute_string('data'); ?>>
				<?php
				// Start loop
				while($wew_query->have_posts()) : $wew_query->the_post();

					// Create new post object.
					$post = new \stdClass();

					// Get post data
					$get_post = get_post();

					// Post Data
					$post->ID           = $get_post->ID;
					$post->permalink    = get_the_permalink($post->ID);
					$post->title        = $get_post->post_title;

					// Only display carousel item if there is content to show
					if(has_post_thumbnail()
						|| 'true' == $title
						|| 'true' == $meta
						|| 'true' == $excerpt
					) { ?>

						<div class="wew-carousel-slide">
						
							<?php
							// Display thumbnail if enabled and defined
							if(has_post_thumbnail()) { ?>

								<div class="wew-carousel-entry-media clr">

									<a href="<?php echo $post->permalink; ?>" title="<?php the_title(); ?>" class="wew-carousel-entry-img">

										<?php
										// Display post thumbnail
										the_post_thumbnail($img_size, array(
											'alt'		=> get_the_title(),
											'itemprop' 	=> 'image',
										)); ?>

									</a>

								</div><!-- .wew-carousel-entry-media -->

							<?php } ?>

							<?php
							// Open details element if the title or excerpt are true
							if('true' == $title
								|| 'true' == $meta
								|| 'true' == $excerpt
							) { ?>

								<div class="wew-carousel-entry-details clr">

									<?php
									// Display title if $title is true and there is a post title
									if('true' == $title) { ?>

										<h2 class="wew-carousel-entry-title entry-title">
											<a href="<?php echo $post->permalink; ?>" title="<?php the_title(); ?>"><?php echo $post->title; ?></a>
										</h2>

									<?php } ?>

									<?php
									// Display meta
									if('true' == $meta) { ?>

										<ul class="meta">

											<?php if('true' == $settings['author']) { ?>
												<li class="meta-author" itemprop="name"><i class="icon-user"></i><?php echo the_author_posts_link(); ?></li>
											<?php } ?>

											<?php if('true' == $settings['date']) { ?>
												<li class="meta-date" itemprop="datePublished" pubdate><i class="icon-clock"></i><?php echo get_the_date(); ?></li>
											<?php } ?>

											<?php if('true' == $settings['cat']) { ?>
												<li class="meta-cat"><i class="icon-folder"></i><?php the_category(' / ', get_the_ID()); ?></li>
											<?php } ?>

											<?php if('true' == $settings['comments'] && comments_open() && ! post_password_required()) { ?>
												<li class="meta-comments"><i class="icon-bubble"></i><?php comments_popup_link(esc_html__('0 Comments', 'woovina-elementor-widgets'), esc_html__('1 Comment',  'woovina-elementor-widgets'), esc_html__('% Comments', 'woovina-elementor-widgets'), 'comments-link'); ?></li>
											<?php } ?>

										</ul>

									<?php } ?>

									<?php
									// Display excerpt if $excerpt is true
									if('true' == $excerpt) { ?>

										<div class="wew-carousel-entry-excerpt clr">
											<?php wew_excerpt($settings['excerpt_length']); ?>
										</div><!-- .wew-carousel-entry-excerpt -->
										
									<?php } ?>

									<?php
									// Display read more
									if('' != $readmore) { ?>

										<div class="wew-carousel-entry-readmore readmore-btn clr">
											<a href="<?php echo $post->permalink; ?>"><?php echo $readmore; ?></a>
										</div><!-- .wew-carousel-entry-excerpt -->
										
									<?php } ?>

								</div><!-- .wew-carousel-entry-details -->

							<?php } ?>

						</div>

					<?php } ?>

					<?php $counter++; ?>

				<?php
				// End entry loop
				endwhile; ?>

			</div><!-- .wew-carousel -->

			<?php
			// Reset the post data to prevent conflicts with WP globals
			wp_reset_postdata(); ?>

		<?php
		// If no posts are found display message
		else : ?>

			<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for.', 'woovina-elementor-widgets'); ?></p>

		<?php
		// End post check
		endif; ?>

	<?php
	}

}