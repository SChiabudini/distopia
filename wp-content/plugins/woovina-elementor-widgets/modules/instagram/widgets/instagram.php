<?php
namespace wvnElementor\Modules\Instagram\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Instagram extends Widget_Base {

	public function get_name() {
		return 'wew-instagram';
	}

	public function get_title() {
		return __('Instagram Feed', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_script_depends() {
		return [ 'wew-instagram' ];
	}

	public function get_style_depends() {
		return [ 'wew-instagram' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_instagram',
			[
				'label' 		=> __('Connect Instagram', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'token',
			[
				'label' 		=> __('Access Token', 'woovina-elementor-widgets'),
				'description' 	=> sprintf(esc_html__('%1$sFollow this article%2$s to get your Access Token.', 'woovina-elementor-widgets'), '<a href="https://woovina.com/docs/extensions/woovina-elementor-widgets-get-instagram-access-token" target="_blank">', '</a>'),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'section_instagram_feed',
            [
                'label' => __('Feed Settings', 'woovina-elementor-widgets')
            ]
       );

		$this->add_control(
			'style',
			[
				'label' 		=> __('Style', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'default',
				'options' 		=> [
					'default' 	=> __('Default Style', 'woovina-elementor-widgets'),
					'widget' 	=> __('Widget Style', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'number',
			[
				'label' 		=> __('Number of images', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> '6',
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label' 		=> __('Number of columns', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '4',
				'tablet_default' => '3',
				'mobile_default' => '1',
				'options' 		=> [
					'1' 	=> '1',
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
					'5' 	=> '5',
					'6' 	=> '6',
					'7' 	=> '7',
					'8' 	=> '8',
					'9' 	=> '9',
					'10' 	=> '10',
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .wew-instagram-items .wew-instagram-item' => 'width: calc(100% / {{columns.SIZE}});',
					'(tablet){{WRAPPER}} .wew-instagram-items .wew-instagram-item' => 'width: calc(100% / {{columns_tablet.SIZE}});',
					'(mobile){{WRAPPER}} .wew-instagram-items .wew-instagram-item' => 'width: calc(100% / {{columns_mobile.SIZE}});',
				],
			]
		);

		$this->add_control(
			'likes',
			[
				'label' 		=> __('Display likes', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				'condition' 	=> [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'comments',
			[
				'label' 		=> __('Display comments', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				'condition' 	=> [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'caption',
			[
				'label' 		=> __('Display caption', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'condition' 	=> [
					'style' => 'default',
				],
			]
		);

		$this->add_control(
			'caption_length',
			[
				'label' 		=> __('Limit caption', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> '20',
				'condition' 	=> [
					'style' => 'default',
					'caption' => 'yes',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'section_instagram_user',
            [
                'label' => __('User Infos', 'woovina-elementor-widgets')
            ]
       );

		$this->add_control(
			'user_picture',
			[
				'label' 		=> __('Display avatar', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'user_username',
			[
				'label' 		=> __('Display username', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'user_follow',
			[
				'label' 		=> __('Display follow button', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'user_posts_follow',
			[
				'label' 		=> __('Display posts and followers', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'user_bio',
			[
				'label' 		=> __('Display biography', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_instagram_style',
			[
				'label' 		=> __('Styling', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_ratio',
			[
				'label' 		=> __('Image Ratio', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 0.66,
				],
				'tablet_default' => [
					'size' => '',
				],
				'mobile_default' => [
					'size' => 0.5,
				],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 2,
						'step' => 0.01,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-instagram-url' => 'padding-bottom: calc({{SIZE}} * 100%);',
				],
			]
		);

		$this->add_responsive_control(
			'space',
			[
				'label' 		=> __('Space Between', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => '',
				],
				'mobile_default' => [
					'size' => '',
				],
				'range' => [
					'px' => [
						'min' => 0,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wew-instagram-items' => 'margin: 0 -{{SIZE}}px',
					'(desktop){{WRAPPER}} .wew-instagram-items .wew-instagram-item' => 'border: {{SIZE}}px solid transparent',
					'(tablet){{WRAPPER}} .wew-instagram-items .wew-instagram-item' => 'border: {{SIZE}}px solid transparent',
					'(mobile){{WRAPPER}} .wew-instagram-items .wew-instagram-item' => 'border: {{SIZE}}px solid transparent',
				],
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wew-instagram-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_instagram_overlay',
			[
				'label' 		=> __('Overlay', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'overlay_bg',
			[
				'label' 		=> __('Background', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-instagram-image:after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'overlay_opacity',
			[
				'label' 		=> __('Opacity (%)', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 0.9,
				],
				'range' 		=> [
					'px' => [
						'min' 	=> 0.1,
						'max' 	=> 1,
						'step' 	=> 0.1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-instagram-url:hover .wew-instagram-image:after' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'overlay_text_color',
			[
				'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-instagram-data-inner' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wew-instagram-icon svg' => 'fill: {{VALUE}};',
				],
				'condition' 	=> [
					'style' => 'default',
					'caption' => 'yes',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
		$id = $this->get_id();

		// Vars
		$api 			= \OEW_Instagram_API::getInstance();
		$token 			= $settings['token'];
		$style  		= $settings['style'];
		$number  		= $settings['number'];
		$columns  		= $settings['columns'];
		$likes    		= $settings['likes'];
		$comments 		= $settings['comments'];
		$caption  		= $settings['caption'];
		$length   		= $settings['caption_length'];

		// User infos
		$picture  		= $settings['user_picture'];
		$username  		= $settings['user_username'];
		$follow  		= $settings['user_follow'];
		$posts  		= $settings['user_posts_follow'];
		$bio  			= $settings['user_bio'];

		// Display the media data
		$media = $api->get_media($token, $number, $id);
		$media = $media['data'];

		// Display the user data
		$infos = $api->get_infos($token, $id);
		$infos = $infos['data'][0];

		// If no like icon
		if('yes' != $likes) {
			$data_class = ' no-likes';
		}

		// Wrap classes
		$wrap_classes = array('wew-instagram-wrap', 'clr');

		// Style
		$wrap_classes[] = $style .'-style';

		// Turn classes into space seperated string
		$wrap_classes = implode(' ', $wrap_classes);

		// Inner classes
		$classes = array('wew-instagram-items', 'clr');

		// Columns
		$classes[] = 'col-'. $columns;

		// Turn classes into space seperated string
		$classes = implode(' ', $classes); ?>

		<div class="<?php echo esc_attr($wrap_classes); ?>">

			<?php if($picture == 'yes' || $username == 'yes' || $follow == 'yes' || $posts == 'yes' || $bio == 'yes') : ?>

				<div class="wew-instagram-top">

					<?php if('default' == $style) { ?>

						<?php if($picture == 'yes') : ?>

							<div class="wew-instagram-picture">
								<img src="<?php echo esc_url($infos['avatar']); ?>" alt="<?php echo esc_attr($infos['name']); ?>">
							</div>

						<?php endif; ?>

						<div class="wew-instagram-infos">

							<?php if($username == 'yes' || $follow == 'yes') : ?>

								<div class="wew-instagram-username">

									<?php if($username == 'yes') : ?>

										<h2><?php echo esc_attr($infos['username']); ?></h2>

									<?php endif; ?>

									<?php if($follow == 'yes') : ?>

										<div class="wew-instagram-follow">
											<a class="wew-instagram-subscribe" href="https://instagram.com/<?php echo esc_attr($infos['username']); ?>/" target="_blank"><?php esc_html_e('Follow', 'woovina-elementor-widgets'); ?></a>
										</div>

									<?php endif; ?>

								</div>

							<?php endif; ?>

							<?php if($posts == 'yes') : ?>

								<ul class="wew-instagram-posts">
									<li><span><?php echo esc_attr($infos['posts']); ?></span> <?php esc_html_e('posts', 'woovina-elementor-widgets'); ?></li>
									<li><span><?php echo esc_attr($infos['followed_by']); ?></span> <?php esc_html_e('followers', 'woovina-elementor-widgets'); ?></li>
									<li><span><?php echo esc_attr($infos['follows']); ?></span> <?php esc_html_e('following', 'woovina-elementor-widgets'); ?></li>
								</ul>

							<?php endif; ?>

							<?php if($bio == 'yes') : ?>

								<div class="wew-instagram-bio">

									<?php if(! empty($infos['name'])) : ?>
										<h2><?php echo esc_attr($infos['name']); ?></h2>
									<?php endif; ?>

									<?php if(! empty($infos['bio'])) : ?>
										<span><?php echo esc_attr($infos['bio']); ?></span>
									<?php endif; ?>

									<?php if(! empty($infos['website'])) : ?>
										<a href="<?php echo esc_url($infos['website']); ?>" target="_blank"><?php echo esc_attr($infos['website']); ?></a>
									<?php endif; ?>

								</div>

							<?php endif; ?>

						</div>

					<?php } else if('widget' == $style) { ?>

						<a class="wew-instagram-header" href="https://instagram.com/<?php echo esc_attr($infos['username']); ?>/" target="_blank">
							<?php if($picture == 'yes') : ?>
								<img src="<?php echo esc_url($infos['avatar']); ?>" alt="<?php echo esc_attr($infos['name']); ?>">
							<?php endif; ?>

							<?php if($username == 'yes') : ?>
								<span class="wew-instagram-name"><?php echo esc_attr($infos['username']); ?></span>
							<?php endif; ?>

							<span class="wew-instagram-header-logo"></span>
						</a>

						<div class="wew-instagram-panel">
							<?php if($posts == 'yes') : ?>

								<ul class="wew-instagram-posts">
									<li><span><?php echo esc_attr($infos['posts']); ?></span><?php esc_html_e('posts', 'woovina-elementor-widgets'); ?></li>
									<li><span><?php echo esc_attr($infos['followed_by']); ?></span><?php esc_html_e('followers', 'woovina-elementor-widgets'); ?></li>
									<li><span><?php echo esc_attr($infos['follows']); ?></span><?php esc_html_e('following', 'woovina-elementor-widgets'); ?></li>
								</ul>

							<?php endif; ?>

							<?php if($follow == 'yes') : ?>
								<a class="wew-instagram-subscribe" href="https://instagram.com/<?php echo esc_attr($infos['username']); ?>/" target="_blank"><?php esc_html_e('Follow', 'woovina-elementor-widgets'); ?></a>
							<?php endif; ?>

						</div>

						<?php if($bio == 'yes') : ?>

							<div class="wew-instagram-bio">

								<?php if(! empty($infos['name'])) : ?>
									<h2><?php echo esc_attr($infos['name']); ?></h2>
								<?php endif; ?>

								<?php if(! empty($infos['bio'])) : ?>
									<span><?php echo esc_attr($infos['bio']); ?></span>
								<?php endif; ?>

								<?php if(! empty($infos['website'])) : ?>
									<a href="<?php echo esc_url($infos['website']); ?>" target="_blank"><?php echo esc_attr($infos['website']); ?></a>
								<?php endif; ?>

							</div>

						<?php endif; ?>

					<?php } ?>

				</div>

				<?php if('default' == $style) { ?>

					<?php if($bio == 'yes') : ?>

						<div class="wew-instagram-bio wew-instagram-hide">

							<?php if(! empty($infos['name'])) : ?>
								<h2><?php echo esc_attr($infos['name']); ?></h2>
							<?php endif; ?>

							<?php if(! empty($infos['bio'])) : ?>
								<span><?php echo esc_attr($infos['bio']); ?></span>
							<?php endif; ?>

							<?php if(! empty($infos['website'])) : ?>
								<a href="<?php echo esc_url($infos['website']); ?>" target="_blank"><?php echo esc_url($infos['website']); ?></a>
							<?php endif; ?>

						</div>

					<?php endif; ?>

					<?php if($posts == 'yes') : ?>

						<ul class="wew-instagram-posts wew-instagram-hide">
							<li><span><?php echo esc_attr($infos['posts']); ?></span> <?php esc_html_e('posts', 'woovina-elementor-widgets'); ?></li>
							<li><span><?php echo esc_attr($infos['followed_by']); ?></span><?php esc_html_e('followers', 'woovina-elementor-widgets'); ?></li>
							<li><span><?php echo esc_attr($infos['follows']); ?></span><?php esc_html_e('following', 'woovina-elementor-widgets'); ?></li>
						</ul>

					<?php endif; ?>

				<?php } ?>

			<?php endif; ?>

			<div class="<?php echo esc_attr($classes); ?>">

				<?php foreach($media as $item) : ?>

					<div class="wew-instagram-item">

						<a id="<?php echo esc_attr($item['id']); ?>" class="wew-instagram-url" href="<?php echo esc_url($item['url']); ?>" target="_blank">

							<div class="wew-instagram-image">
								<img class="wew-instagram-img" src="<?php echo esc_url($item['img_std_res']); ?>" width="<?php echo esc_attr($item['img_std_res_width']); ?>" height="<?php echo esc_attr($item['img_std_res_height']); ?>" />
							</div>

							<?php if('widget' != $style && ($likes == 'yes' || $comments == 'yes' || $caption == 'yes')) : ?>

								<div class="wew-instagram-data<?php echo esc_attr($data_class); ?>">

									<div class="wew-instagram-data-inner">

										<?php if($likes == 'yes') : ?>
											<div class="wew-instagram-counter wew-instagram-likes">
												<div class="wew-instagram-icon wew-instagram-icon-likes">
													<svg viewBox="0 0 24 24" width="24" height="24">
												        <path d="M17.7,1.5c-2,0-3.3,0.5-4.9,2.1c0,0-0.4,0.4-0.7,0.7c-0.3-0.3-0.7-0.7-0.7-0.7c-1.6-1.6-3-2.1-5-2.1C2.6,1.5,0,4.6,0,8.3 c0,4.2,3.4,7.1,8.6,11.5c0.9,0.8,1.9,1.6,2.9,2.5c0.1,0.1,0.3,0.2,0.5,0.2s0.3-0.1,0.5-0.2c1.1-1,2.1-1.8,3.1-2.7 c4.8-4.1,8.5-7.1,8.5-11.4C24,4.6,21.4,1.5,17.7,1.5z M14.6,18.6c-0.8,0.7-1.7,1.5-2.6,2.3c-0.9-0.7-1.7-1.4-2.5-2.1 c-5-4.2-8.1-6.9-8.1-10.5c0-3.1,2.1-5.5,4.9-5.5c1.5,0,2.6,0.3,3.8,1.5c1,1,1.2,1.2,1.2,1.2C11.6,5.9,11.7,6,12,6.1 c0.3,0,0.5-0.2,0.7-0.4c0,0,0.2-0.2,1.2-1.3c1.3-1.3,2.1-1.5,3.8-1.5c2.8,0,4.9,2.4,4.9,5.5C22.6,11.9,19.4,14.6,14.6,18.6z"></path>
												    </svg>
													<em><?php echo esc_attr($item['likes']); ?></em>
												</div>
											</div>
										<?php endif; ?>

										<?php if($comments == 'yes') : ?>
											<div class="wew-instagram-counter wew-instagram-comments">
												<div class="wew-instagram-icon wew-instagram-icon-comments">
													<svg viewBox="0 0 24 24" width="24" height="24">
												        <path d="M1,11.9C1,17.9,5.8,23,12,23c1.9,0,3.7-1,5.3-1.8l5,1.3l0,0c0.1,0,0.1,0,0.2,0c0.4,0,0.6-0.3,0.6-0.6c0-0.1,0-0.1,0-0.2 l-1.3-4.9c0.9-1.6,1.4-2.9,1.4-4.8C23,5.8,18,1,12,1C5.9,1,1,5.9,1,11.9z M2.4,11.9c0-5.2,4.3-9.5,9.5-9.5c5.3,0,9.6,4.2,9.6,9.5 c0,1.7-0.5,3-1.3,4.4l0,0c-0.1,0.1-0.1,0.2-0.1,0.3c0,0.1,0,0.1,0,0.1l0,0l1.1,4.1l-4.1-1.1l0,0c-0.1,0-0.1,0-0.2,0 c-0.1,0-0.2,0-0.3,0.1l0,0c-1.4,0.8-3.1,1.8-4.8,1.8C6.7,21.6,2.4,17.2,2.4,11.9z"></path>
												    </svg>
													<em><?php echo esc_attr($item['comments']); ?></em>
												</div>
											</div>
										<?php endif; ?>

										<?php if($caption == 'yes') : ?>
											<div class="wew-instagram-caption">
												<?php echo esc_attr(wp_trim_words($item['caption'], $length)); ?>
											</div>
										<?php endif; ?>

									</div>

								</div>

							<?php endif; ?>

						</a>

					</div>

				<?php endforeach; ?>

			</div>

		</div>

	<?php
	}

}