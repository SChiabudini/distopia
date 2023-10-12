<?php
namespace wvnElementor\Modules\Testimonials\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

class Testimonials extends Widget_Base {

	public function get_name() {
		return 'wew-testimonials';
	}

	public function get_title() {
		return __('Testimonials', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-testimonial';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_style_depends() {
		return [ 'wew-testimonials' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_testimonials',
			[
				'label' 		=> __('Items', 'woovina-elementor-widgets'),
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings(); ?>

	<?php
	}

	protected function _content_template() { ?>
	<?php
	}

}