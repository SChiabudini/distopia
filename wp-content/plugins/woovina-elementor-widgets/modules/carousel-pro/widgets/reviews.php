<?php
namespace wvnElementor\Modules\CarouselPro\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Reviews extends Base {

	public function get_name() {
		return 'wew-reviews';
	}

	public function get_title() {
		return __( 'Reviews', 'woovina-elementor-widgets' );
	}

	public function get_icon() {
		return 'wew-icon eicon-review';
	}

	public function get_keywords() {
		return [ 'reviews', 'social', 'rating', 'testimonial', 'carousel' ];
	}
	
	public function get_style_depends() {
		return [ 'wew-carousel-pro' ];
	}
	
	public function get_categories() {
		return [ 'woovina-elements' ];
	}
	
	protected function _register_controls() {
		parent::_register_controls();

		$this->update_control(
			'slide_padding',
			[
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__header' => 'padding-top: {{TOP}}{{UNIT}}; padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}};',
					'{{WRAPPER}} .elementor-testimonial__content' => 'padding-bottom: {{BOTTOM}}{{UNIT}}; padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->start_injection( [
			'of' => 'slide_padding',
		] );

		$this->add_control(
			'heading_header',
			[
				'label' => __( 'Header', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'header_background_color',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__header' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'content_gap',
			[
				'label' => __( 'Gap', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__header' => 'padding-bottom: calc({{SIZE}}{{UNIT}} / 2)',
					'{{WRAPPER}} .elementor-testimonial__content' => 'padding-top: calc({{SIZE}}{{UNIT}} / 2)',
				],
			]
		);

		$this->add_control(
			'show_separator',
			[
				'label' => __( 'Separator', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'woovina-elementor-widgets' ),
				'label_on' => __( 'Show', 'woovina-elementor-widgets' ),
				'default' => 'has-separator',
				'return_value' => 'has-separator',
				'prefix_class' => 'elementor-review--',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'separator_color',
			[
				'label' => __( 'Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__header' => 'border-bottom-color: {{VALUE}}',
				],
				'condition' => [
					'show_separator!' => '',
				],
			]
		);

		$this->add_control(
			'separator_size',
			[
				'label' => __( 'Size', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'condition' => [
					'show_separator!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__header' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_injection();

		$this->start_injection( [
			'at' => 'before',
			'of' => 'section_navigation',
		] );

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Text', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_title_style',
			[
				'label' => __( 'Name', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __( 'Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .elementor-testimonial__header, {{WRAPPER}} .elementor-testimonial__name',
				'scheme' => Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'heading_title_style',
			[
				'label' => __( 'Title', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .elementor-testimonial__title',
			]
		);

		$this->add_control(
			'heading_review_style',
			[
				'label' => __( 'Review', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .elementor-testimonial__text',
				'scheme' => Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[
				'label' => __( 'Image', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_size',
			[
				'label' => __( 'Size', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 70,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'image_gap',
			[
				'label' => __( 'Gap', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}} .elementor-testimonial__image + cite' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: 0;',
					'body.rtl {{WRAPPER}} .elementor-testimonial__image + cite' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left:0;',
				],
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__image img' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => __( 'Icon', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Official', 'woovina-elementor-widgets' ),
					'custom' => __( 'Custom', 'woovina-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'icon_custom_color',
			[
				'label' => __( 'Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__icon:not(.elementor-testimonial__rating)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__icon' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_rating_style',
			[
				'label' => __( 'Rating', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'star_style',
			[
				'label' => __( 'Icon', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'star_fontawesome' => 'Font Awesome',
					'star_unicode' => 'Unicode',
				],
				'default' => 'star_fontawesome',
				'render_type' => 'template',
				'prefix_class' => 'elementor--star-style-',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'unmarked_star_style',
			[
				'label' => __( 'Unmarked Style', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'solid' => [
						'title' => __( 'Solid', 'woovina-elementor-widgets' ),
						'icon' => 'fa fa-star',
					],
					'outline' => [
						'title' => __( 'Outline', 'woovina-elementor-widgets' ),
						'icon' => 'fa fa-star-o',
					],
				],
				'default' => 'solid',
			]
		);

		$this->add_control(
			'star_size',
			[
				'label' => __( 'Size', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-star-rating' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'star_space',
			[
				'label' => __( 'Spacing', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}} .elementor-star-rating i:not(:last-of-type)' => 'margin-right: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .elementor-star-rating i:not(:last-of-type)' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'stars_color',
			[
				'label' => __( 'Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-star-rating i:before' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'stars_unmarked_color',
			[
				'label' => __( 'Unmarked Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-star-rating i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->end_injection();

		$this->update_responsive_control(
			'width',
			[
				'selectors' => [
					'{{WRAPPER}}.elementor-arrows-yes .elementor-main-swiper' => 'width: calc( {{SIZE}}{{UNIT}} - 40px )',
					'{{WRAPPER}} .elementor-main-swiper' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->update_responsive_control(
			'slides_per_view',
			[
				'condition' => null,
			]
		);

		$this->update_control(
			'slides_to_scroll',
			[
				'condition' => null,
			]
		);

		$this->remove_control( 'effect' );
		$this->remove_responsive_control( 'height' );
		$this->remove_control( 'pagination_position' );
	}

	protected function add_repeater_controls( Repeater $repeater ) {
		$repeater->add_control(
			'image',
			[
				'label' => __( 'Image', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'name',
			[
				'label' => __( 'Name', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'John Doe', 'woovina-elementor-widgets' ),
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => '@username',
			]
		);

		$repeater->add_control(
			'rating',
			[
				'label' => __( 'Rating', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 5,
				'step' => 0.1,
			]
		);

		$repeater->add_control(
			'social_icon',
			[
				'label' => __( 'Icon', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => 'fa fa-twitter',
				'include' => [
					'fa fa-android',
					'fa fa-apple',
					'fa fa-behance',
					'fa fa-bitbucket',
					'fa fa-codepen',
					'fa fa-delicious',
					'fa fa-digg',
					'fa fa-dribbble',
					'fa fa-envelope',
					'fa fa-facebook',
					'fa fa-flickr',
					'fa fa-foursquare',
					'fa fa-github',
					'fa fa-google-plus',
					'fa fa-houzz',
					'fa fa-instagram',
					'fa fa-jsfiddle',
					'fa fa-linkedin',
					'fa fa-medium',
					'fa fa-meetup',
					'fa fa-mixcloud',
					'fa fa-odnoklassniki',
					'fa fa-pinterest',
					'fa fa-product-hunt',
					'fa fa-reddit',
					'fa fa-rss',
					'fa fa-shopping-cart',
					'fa fa-skype',
					'fa fa-slideshare',
					'fa fa-snapchat',
					'fa fa-soundcloud',
					'fa fa-spotify',
					'fa fa-stack-overflow',
					'fa fa-steam',
					'fa fa-stumbleupon',
					'fa fa-telegram',
					'fa fa-thumb-tack',
					'fa fa-tripadvisor',
					'fa fa-tumblr',
					'fa fa-twitch',
					'fa fa-twitter',
					'fa fa-vimeo',
					'fa fa-vk',
					'fa fa-weibo',
					'fa fa-weixin',
					'fa fa-whatsapp',
					'fa fa-wordpress',
					'fa fa-xing',
					'fa fa-yelp',
					'fa fa-youtube',
					'fa fa-500px',
				],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'woovina-elementor-widgets' ),

			]
		);

		$repeater->add_control(
			'content',
			[
				'label' => __( 'Review', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets' ),
			]
		);
	}

	protected function get_repeater_defaults() {
		$placeholder_image_src = Utils::get_placeholder_image_src();

		return [
			[
				'content' => __( 'I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets' ),
				'name' => __( 'John Doe', 'woovina-elementor-widgets' ),
				'title' => '@username',
				'image' => [
					'url' => $placeholder_image_src,
				],
			],
			[
				'content' => __( 'I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets' ),
				'name' => __( 'John Doe', 'woovina-elementor-widgets' ),
				'title' => '@username',
				'image' => [
					'url' => $placeholder_image_src,
				],
			],
			[
				'content' => __( 'I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets' ),
				'name' => __( 'John Doe', 'woovina-elementor-widgets' ),
				'title' => '@username',
				'image' => [
					'url' => $placeholder_image_src,
				],
			],
		];
	}

	private function print_cite( $slide, $settings ) {
		if ( empty( $slide['name'] ) && empty( $slide['title'] ) ) {
			return '';
		}

		$html = '<cite class="elementor-testimonial__cite">';

		if ( ! empty( $slide['name'] ) ) {
			$html .= '<span class="elementor-testimonial__name">' . $slide['name'] . '</span>';
		}

		if ( ! empty( $slide['rating'] ) ) {
			$html .= $this->render_stars( $slide, $settings );
		}

		if ( ! empty( $slide['title'] ) ) {
			$html .= '<span class="elementor-testimonial__title">' . $slide['title'] . '</span>';
		}
		$html .= '</cite>';

		return $html;
	}

	protected function render_stars( $slide, $settings ) {
		$icon = '&#61445;';

		if ( 'star_fontawesome' === $settings['star_style'] ) {
			if ( 'outline' === $settings['unmarked_star_style'] ) {
				$icon = '&#61446;';
			}
		} elseif ( 'star_unicode' === $settings['star_style'] ) {
			$icon = '&#9733;';

			if ( 'outline' === $settings['unmarked_star_style'] ) {
				$icon = '&#9734;';
			}
		}

		$rating = (float) $slide['rating'] > 5 ? 5 : $slide['rating'];
		$floored_rating = (int) $rating;
		$stars_html = '';

		for ( $stars = 1; $stars <= 5; $stars++ ) {
			if ( $stars <= $floored_rating ) {
				$stars_html .= '<i class="elementor-star-full">' . $icon . '</i>';
			} elseif ( $floored_rating + 1 === $stars && $rating !== $floored_rating ) {
				$stars_html .= '<i class="elementor-star-' . ( $rating - $floored_rating ) * 10 . '">' . $icon . '</i>';
			} else {
				$stars_html .= '<i class="elementor-star-empty">' . $icon . '</i>';
			}
		}

		return '<div class="elementor-star-rating">' . $stars_html . '</div>';
	}

	private function print_icon( $slide, $element_key ) {
		if ( empty( $slide['social_icon'] ) ) {
			return '';
		}

		$this->add_render_attribute( 'icon_wrapper_' . $element_key, 'class', 'elementor-testimonial__icon elementor-icon' );

		$icon = '<i class="' . $slide['social_icon'] . '" aria-hidden="true"></i><span class="elementor-screen-only">' . esc_html__( 'Read More', 'woovina-elementor-widgets' ) . '</span>';
		$social = str_replace( 'fa fa-', '', $slide['social_icon'] );
		$this->add_render_attribute( 'icon_wrapper_' . $element_key, 'class', 'elementor-icon-' . $social );

		return '<div ' . $this->get_render_attribute_string( 'icon_wrapper_' . $element_key ) . '>' . $icon . '</div>';
	}

	protected function print_slide( array $slide, array $settings, $element_key ) {
		$this->add_render_attribute( $element_key . '-testimonial', [
			'class' => 'elementor-testimonial',
		] );

		$this->add_render_attribute( $element_key . '-testimonial', [
			'class' => 'elementor-repeater-item-' . $slide['_id'],
		] );

		if ( ! empty( $slide['image']['url'] ) ) {
			$this->add_render_attribute( $element_key . '-image', [
				'src' => $this->get_slide_image_url( $slide, $settings ),
				'alt' => ! empty( $slide['name'] ) ? $slide['name'] : '',
			] );
		}

		?>
		<div <?php echo $this->get_render_attribute_string( $element_key . '-testimonial' ); ?>>
			<?php if ( $slide['image']['url'] || ! empty( $slide['name'] ) || ! empty( $slide['title'] ) ) :

				$link_url = empty( $slide['link']['url'] ) ? false : $slide['link']['url'];
				$header_tag = ! empty( $link_url ) ? 'a' : 'div';
				$header_element = 'header_' . $slide['_id'];

				$this->add_render_attribute( $header_element, 'class', 'elementor-testimonial__header' );

				if ( ! empty( $link_url ) ) {
					$this->add_render_attribute( $header_element, 'href', $link_url );

					if ( $slide['link']['is_external'] ) {
						$this->add_render_attribute( $header_element, 'target', '_blank' );
					}

					if ( ! empty( $slide['link']['nofollow'] ) ) {
						$this->add_render_attribute( $header_element, 'rel', 'nofollow' );
					}
				}
				?>
				<<?php echo $header_tag; ?> <?php echo $this->get_render_attribute_string( $header_element ); ?>>
					<?php if ( $slide['image']['url'] ) : ?>
						<div class="elementor-testimonial__image">
							<img <?php echo $this->get_render_attribute_string( $element_key . '-image' ); ?>>
						</div>
					<?php endif; ?>
					<?php echo $this->print_cite( $slide, $settings ); ?>
					<?php echo $this->print_icon( $slide, $element_key ); ?>
				</<?php echo $header_tag; ?>>
			<?php endif; ?>
			<?php if ( $slide['content'] ) : ?>
				<div class="elementor-testimonial__content">
					<div class="elementor-testimonial__text">
						<?php echo $slide['content']; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	protected function render() {
		$this->print_slider();
	}
}
