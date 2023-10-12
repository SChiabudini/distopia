/*! WooVina Elementor Widgets - 02/07/2019 */
/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/


/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

module.exports = function () {
	if (jQuery.fn.smartmenus) {
		// Override the default stupid detection
		jQuery.SmartMenus.prototype.isCSSOn = function () {
			return true;
		};

		if (elementorFrontend.config.is_rtl) {
			jQuery.fn.smartmenus.defaults.rightToLeftSubMenus = true;
		}
	}

	elementorFrontend.hooks.addAction('frontend/element_ready/wew-nav-menu.default', __webpack_require__(1));
};

/***/ }),


/* 1 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var WEWMenuHandler = elementorModules.frontend.handlers.Base.extend({

	stretchElement: null,

	getDefaultSettings: function getDefaultSettings() {
		return {
			selectors: {
				menu: '.woovina-nav-menu',
				anchorLink: '.woovina-nav-menu--main .elementor-item-anchor',
				dropdownMenu: '.woovina-nav-menu__container.woovina-nav-menu--dropdown',
				menuToggle: '.woovina-menu-toggle'
			}
		};
	},

	getDefaultElements: function getDefaultElements() {
		var selectors = this.getSettings('selectors'),
		    elements = {};

		elements.$menu = this.$element.find(selectors.menu);
		elements.$anchorLink = this.$element.find(selectors.anchorLink);
		elements.$dropdownMenu = this.$element.find(selectors.dropdownMenu);
		elements.$dropdownMenuFinalItems = elements.$dropdownMenu.find('.menu-item:not(.menu-item-has-children) > a');
		elements.$menuToggle = this.$element.find(selectors.menuToggle);

		return elements;
	},

	bindEvents: function bindEvents() {
		if (!this.elements.$menu.length) {
			return;
		}

		this.elements.$menuToggle.on('click', this.toggleMenu.bind(this));

		if (this.getElementSettings('full_width')) {
			this.elements.$dropdownMenuFinalItems.on('click', this.toggleMenu.bind(this, false));
		}

		elementorFrontend.addListenerOnce(this.$element.data('model-cid'), 'resize', this.stretchMenu);
	},

	initStretchElement: function initStretchElement() {
		this.stretchElement = new elementorModules.frontend.tools.StretchElement({ element: this.elements.$dropdownMenu });
	},

	toggleMenu: function toggleMenu(show) {
		var isDropdownVisible = this.elements.$menuToggle.hasClass('elementor-active');

		if ('boolean' !== typeof show) {
			show = !isDropdownVisible;
		}

		this.elements.$menuToggle.toggleClass('elementor-active', show);

		if (show && this.getElementSettings('full_width')) {
			this.stretchElement.stretch();
		}
	},

	followMenuAnchors: function followMenuAnchors() {
		var self = this;

		self.elements.$anchorLink.each(function () {
			if (location.pathname === this.pathname && '' !== this.hash) {
				self.followMenuAnchor(jQuery(this));
			}
		});
	},

	followMenuAnchor: function followMenuAnchor($element) {
		var anchorSelector = $element[0].hash;

		var offset = -300,
		    $anchor = void 0;

		try {
			// `decodeURIComponent` for UTF8 characters in the hash.
			$anchor = jQuery(decodeURIComponent(anchorSelector));
		} catch (e) {
			return;
		}

		if (!$anchor.length) {
			return;
		}

		if (!$anchor.hasClass('elementor-menu-anchor')) {
			var halfViewport = jQuery(window).height() / 2;
			offset = -$anchor.outerHeight() + halfViewport;
		}

		elementorFrontend.waypoint($anchor, function (direction) {
			if ('down' === direction) {
				$element.addClass('elementor-item-active');
			} else {
				$element.removeClass('elementor-item-active');
			}
		}, { offset: '50%', triggerOnce: false });

		elementorFrontend.waypoint($anchor, function (direction) {
			if ('down' === direction) {
				$element.removeClass('elementor-item-active');
			} else {
				$element.addClass('elementor-item-active');
			}
		}, { offset: offset, triggerOnce: false });
	},

	stretchMenu: function stretchMenu() {
		if (this.getElementSettings('full_width')) {
			this.stretchElement.stretch();

			this.elements.$dropdownMenu.css('top', this.elements.$menuToggle.outerHeight());
		} else {
			this.stretchElement.reset();
		}
	},

	onInit: function onInit() {
		elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);

		if (!this.elements.$menu.length) {
			return;
		}

		this.elements.$menu.smartmenus({
			subIndicatorsText: '<i class="fa"></i>',
			subIndicatorsPos: 'append',
			subMenusMaxWidth: '1000px'
		});

		this.initStretchElement();

		this.stretchMenu();

		if (!elementorFrontend.isEditMode()) {
			this.followMenuAnchors();
		}
	},

	onElementChange: function onElementChange(propertyName) {
		if ('full_width' === propertyName) {
			this.stretchMenu();
		}
	}
});

module.exports = function ($scope) {
	new WEWMenuHandler({ $element: $scope });
};

/***/ }),


/* 2 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

module.exports = function () {
	elementorFrontend.hooks.addAction('frontend/element_ready/wew-slides.default', __webpack_require__(3));
};

/***/ }),


/* 3 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var WEWSlidesHandler = elementorModules.frontend.handlers.Base.extend({
	getDefaultSettings: function getDefaultSettings() {
		return {
			selectors: {
				slider: '.wew-slides',
				slideContent: '.woovina-slide-content'
			},
			classes: {
				animated: 'animated'
			},
			attributes: {
				dataSliderOptions: 'slider_options',
				dataAnimation: 'animation'
			}
		};
	},

	getDefaultElements: function getDefaultElements() {
		var selectors = this.getSettings('selectors');

		return {
			$slider: this.$element.find(selectors.slider)
		};
	},

	initSlider: function initSlider() {
		var $slider = this.elements.$slider;

		if (!$slider.length) {
			return;
		}

		$slider.slick($slider.data(this.getSettings('attributes.dataSliderOptions')));
	},

	goToActiveSlide: function goToActiveSlide() {
		this.elements.$slider.slick('slickGoTo', this.getEditSettings('activeItemIndex') - 1);
	},

	onPanelShow: function onPanelShow() {
		var $slider = this.elements.$slider;

		$slider.slick('slickPause');

		// On switch between slides while editing. stop again.
		$slider.on('afterChange', function () {
			$slider.slick('slickPause');
		});
	},

	bindEvents: function bindEvents() {
		var $slider = this.elements.$slider,
		    settings = this.getSettings(),
		    animation = $slider.data(settings.attributes.dataAnimation);

		if (!animation) {
			return;
		}

		if (elementorFrontend.isEditMode()) {
			elementor.hooks.addAction('panel/open_editor/widget/wew-slides', this.onPanelShow);
		}

		$slider.on({
			beforeChange: function beforeChange() {
				var $sliderContent = $slider.find(settings.selectors.slideContent);

				$sliderContent.removeClass(settings.classes.animated + ' ' + animation).hide();
			},
			afterChange: function afterChange(event, slick, currentSlide) {
				var $currentSlide = jQuery(slick.$slides.get(currentSlide)).find(settings.selectors.slideContent);

				$currentSlide.show().addClass(settings.classes.animated + ' ' + animation);
			}
		});
	},

	onInit: function onInit() {
		elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);

		this.initSlider();

		if (this.isEdit) {
			this.goToActiveSlide();
		}
	},

	onEditSettingsChange: function onEditSettingsChange(propertyName) {
		if ('activeItemIndex' === propertyName) {
			this.goToActiveSlide();
		}
	}
});

module.exports = function ($scope) {
	new WEWSlidesHandler({ $element: $scope });
};

/***/ }),


/* 4 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = function () {
	elementorFrontend.hooks.addAction('frontend/element_ready/wew-woo-menucart.default', __webpack_require__(5));

	if (elementorFrontend.isEditMode()) {
		return;
	}

	jQuery(document.body).on('wc_fragments_loaded wc_fragments_refreshed', function () {
		jQuery('div.elementor-widget-wew-woo-menucart').each(function () {
			elementorFrontend.elementsHandler.runReadyTrigger(jQuery(this));
		});
	});
};

/***/ }),


/* 5 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var WEWMenuCartHandler = elementorModules.frontend.handlers.Base.extend({

	getDefaultSettings: function getDefaultSettings() {
		return {
			selectors: {
				container: '.woovina-menucart__container',
				toggle: '.woovina-menucart__toggle .elementor-button',
				closeButton: '.woovina-menucart__close-button'
			},
			classes: {
				isShown: 'woovina-menucart--shown',
				lightbox: 'elementor-lightbox',
				isHidden: 'woovina-menucart-hidden'
			}
		};
	},

	getDefaultElements: function getDefaultElements() {
		var selectors = this.getSettings('selectors'),
		    elements = {};

		elements.$container = this.$element.find(selectors.container);
		elements.$toggle = this.$element.find(selectors.toggle);
		elements.$closeButton = this.$element.find(selectors.closeButton);

		return elements;
	},

	bindEvents: function bindEvents() {
		var self = this,
		    $container = self.elements.$container,
		    $closeButton = self.elements.$closeButton,
		    classes = this.getSettings('classes');

		// Activate full-screen mode on click
		self.elements.$toggle.on('click', function (event) {
			if (!self.elements.$toggle.hasClass(classes.isHidden)) {
				event.preventDefault();
				$container.toggleClass(classes.isShown);
			}
		});

		// Deactivate full-screen mode on click or on esc.
		$container.on('click', function (event) {
			if ($container.hasClass(classes.isShown) && $container[0] === event.target) {
				$container.removeClass(classes.isShown);
			}
		});

		$closeButton.on('click', function () {
			$container.removeClass(classes.isShown);
		});

		elementorFrontend.elements.$document.keyup(function (event) {
			var ESC_KEY = 27;

			if (ESC_KEY === event.keyCode) {
				if ($container.hasClass(classes.isShown)) {
					$container.click();
				}
			}
		});
	}
});

module.exports = function ($scope) {
	new WEWMenuCartHandler({ $element: $scope });
};

/***/ }),


/* 6 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var WEWStickyHandler = elementorModules.frontend.handlers.Base.extend({
	bindEvents: function bindEvents() {
		elementorFrontend.addListenerOnce(this.getUniqueHandlerID() + 'sticky', 'resize', this.run);
	},
	
	unbindEvents: function unbindEvents() {
		elementorFrontend.removeListeners(this.getUniqueHandlerID() + 'sticky', 'resize', this.run);
	},
	
	isStickyInstanceActive: function isStickyInstanceActive() {
		return undefined !== this.$element.data('sticky');
	},
	
	activate: function activate() {
		var elementSettings = this.getElementSettings(),
		stickyOptions = {
			to: elementSettings.sticky,
			offset: elementSettings.sticky_offset,
			effectsOffset: elementSettings.sticky_effects_offset,
			classes: {
				sticky: 'elementor-sticky',
				stickyActive: 'elementor-sticky--active elementor-section--handles-inside',
				stickyEffects: 'elementor-sticky--effects',
				spacer: 'elementor-sticky__spacer'
			}
		},
		$wpAdminBar = elementorFrontend.elements.$wpAdminBar;

		if (elementSettings.sticky_parent) {
			stickyOptions.parent = '.elementor-widget-wrap';
		}

		if ($wpAdminBar.length && 'top' === elementSettings.sticky && 'fixed' === $wpAdminBar.css('position')) {
			stickyOptions.offset += $wpAdminBar.height();
		}

		this.$element.sticky(stickyOptions);
	},
	
	deactivate: function deactivate() {
		if (!this.isStickyInstanceActive()) {
			return;
		}

		this.$element.sticky('destroy');
	},
	
	run: function run(refresh) {
		if (!this.getElementSettings('sticky')) {
			this.deactivate();
			return;
		}

		var currentDeviceMode = elementorFrontend.getCurrentDeviceMode(),
		activeDevices = this.getElementSettings('sticky_on');

		if (-1 !== activeDevices.indexOf(currentDeviceMode)) {
			if (true === refresh) {
				this.reactivate();
			} else if (!this.isStickyInstanceActive()) {
				this.activate();
		}
		} else {
			this.deactivate();
		}
	},
	
	reactivate: function reactivate() {
		this.deactivate();
		this.activate();
	},
	
	onElementChange: function onElementChange(settingKey) {
		if (-1 !== ['sticky', 'sticky_on'].indexOf(settingKey)) {
			this.run(true);
		}

		if (-1 !== ['sticky_offset', 'sticky_effects_offset', 'sticky_parent'].indexOf(settingKey)) {
		this.reactivate();
		}
	},
	
	onInit: function onInit() {
		elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
		this.run();
	},
	
	onDestroy: function onDestroy() {
		elementorModules.frontend.handlers.Base.prototype.onDestroy.apply(this, arguments);
		this.deactivate();
	}
});

module.exports = function ($scope) {
	new WEWStickyHandler({ $element: $scope });
};
/***/ }),


/* 7 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _get = function get(object, property, receiver) { if (object === null) object = Function.prototype; var desc = Object.getOwnPropertyDescriptor(object, property); if (desc === undefined) { var parent = Object.getPrototypeOf(object); if (parent === null) { return undefined; } else { return get(parent, property, receiver); } } else if ("value" in desc) { return desc.value; } else { var getter = desc.get; if (getter === undefined) { return undefined; } return getter.call(receiver); } };

var _frontend5 = __webpack_require__(13);

var _frontend6 = _interopRequireDefault(_frontend5);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var WEWFrontend = function (_elementorModules$Vie) {
	_inherits(WEWFrontend, _elementorModules$Vie);

	function WEWFrontend() {
		_classCallCheck(this, WEWFrontend);

		return _possibleConstructorReturn(this, (WEWFrontend.__proto__ || Object.getPrototypeOf(WEWFrontend)).apply(this, arguments));
	}

	_createClass(WEWFrontend, [{
		key: 'onInit',
		value: function onInit() {
			_get(WEWFrontend.prototype.__proto__ || Object.getPrototypeOf(WEWFrontend.prototype), 'onInit', this).call(this);


			this.modules = {};
		}
	}, {
		key: 'bindEvents',
		value: function bindEvents() {
			jQuery(window).on('elementor/frontend/init', this.onElementorFrontendInit.bind(this));
		}
	}, {
		key: 'initModules',
		value: function initModules() {
			var _this2 = this;

			var handlers = {
				nav_menu: __webpack_require__(0),
				slides: __webpack_require__(2),
				woocommerce: __webpack_require__(4),
				sticky: __webpack_require__(8),
				carousel: __webpack_require__(9),
				motionFX: _frontend6.default,
				search_pro: __webpack_require__(20),
			};

			jQuery.each(handlers, function (moduleName, ModuleClass) {
				_this2.modules[moduleName] = new ModuleClass();
			});
		}
	}, {
		key: 'onElementorFrontendInit',
		value: function onElementorFrontendInit() {
			this.initModules();
		}
	}]);

	return WEWFrontend;
}(elementorModules.ViewModule);

new WEWFrontend();

/***/ }),


/* 8 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

module.exports = function () {
	elementorFrontend.hooks.addAction('frontend/element_ready/section', __webpack_require__(6));
	elementorFrontend.hooks.addAction('frontend/element_ready/widget', __webpack_require__(6));
};
/***/ }),


/* 9 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = function () {
	elementorFrontend.hooks.addAction('frontend/element_ready/wew-media-carousel.default', __webpack_require__(10));
	elementorFrontend.hooks.addAction('frontend/element_ready/wew-testimonial-carousel.default', __webpack_require__(12));
	elementorFrontend.hooks.addAction('frontend/element_ready/wew-reviews.default', __webpack_require__(12));
};

/***/ }),


/* 10 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var Base = __webpack_require__(11),
    WEWMediaCarousel;

WEWMediaCarousel = Base.extend({

	slideshowSpecialElementSettings: ['slides_per_view', 'slides_per_view_tablet', 'slides_per_view_mobile'],

	isSlideshow: function isSlideshow() {
		return 'slideshow' === this.getElementSettings('skin');
	},

	getDefaultSettings: function getDefaultSettings() {
		var defaultSettings = Base.prototype.getDefaultSettings.apply(this, arguments);

		if (this.isSlideshow()) {
			defaultSettings.selectors.thumbsSwiper = '.elementor-thumbnails-swiper';

			defaultSettings.slidesPerView = {
				desktop: 5,
				tablet: 4,
				mobile: 3
			};
		}

		return defaultSettings;
	},

	getElementSettings: function getElementSettings(setting) {
		if (-1 !== this.slideshowSpecialElementSettings.indexOf(setting) && this.isSlideshow()) {
			setting = 'slideshow_' + setting;
		}

		return Base.prototype.getElementSettings.call(this, setting);
	},

	getDefaultElements: function getDefaultElements() {
		var selectors = this.getSettings('selectors'),
		    defaultElements = Base.prototype.getDefaultElements.apply(this, arguments);

		if (this.isSlideshow()) {
			defaultElements.$thumbsSwiper = this.$element.find(selectors.thumbsSwiper);
		}

		return defaultElements;
	},

	getEffect: function getEffect() {
		if ('coverflow' === this.getElementSettings('skin')) {
			return 'coverflow';
		}

		return Base.prototype.getEffect.apply(this, arguments);
	},

	getSlidesPerView: function getSlidesPerView(device) {
		if (this.isSlideshow()) {
			return 1;
		}

		if ('coverflow' === this.getElementSettings('skin')) {
			return this.getDeviceSlidesPerView(device);
		}

		return Base.prototype.getSlidesPerView.apply(this, arguments);
	},

	getSwiperOptions: function getSwiperOptions() {
		var options = Base.prototype.getSwiperOptions.apply(this, arguments);

		if (this.isSlideshow()) {
			options.loopedSlides = this.getSlidesCount();

			delete options.pagination;
			delete options.breakpoints;
		}

		return options;
	},

	onInit: function onInit() {
		Base.prototype.onInit.apply(this, arguments);

		var slidesCount = this.getSlidesCount();

		if (!this.isSlideshow() || 1 >= slidesCount) {
			return;
		}

		var elementSettings = this.getElementSettings(),
		    loop = 'yes' === elementSettings.loop,
		    breakpointsSettings = {},
		    breakpoints = elementorFrontend.config.breakpoints,
		    desktopSlidesPerView = this.getDeviceSlidesPerView('desktop');

		breakpointsSettings[breakpoints.lg - 1] = {
			slidesPerView: this.getDeviceSlidesPerView('tablet'),
			spaceBetween: this.getSpaceBetween('tablet')
		};

		breakpointsSettings[breakpoints.md - 1] = {
			slidesPerView: this.getDeviceSlidesPerView('mobile'),
			spaceBetween: this.getSpaceBetween('mobile')
		};

		var thumbsSliderOptions = {
			slidesPerView: desktopSlidesPerView,
			initialSlide: this.getInitialSlide(),
			centeredSlides: elementSettings.centered_slides,
			slideToClickedSlide: true,
			spaceBetween: this.getSpaceBetween(),
			loopedSlides: slidesCount,
			loop: loop,
			onSlideChangeEnd: function onSlideChangeEnd(swiper) {
				if (loop) {
					swiper.fixLoop();
				}
			},
			breakpoints: breakpointsSettings
		};

		this.swipers.main.controller.control = this.swipers.thumbs = new Swiper(this.elements.$thumbsSwiper, thumbsSliderOptions);

		this.swipers.thumbs.controller.control = this.swipers.main;
	},

	onElementChange: function onElementChange(propertyName) {
		if (1 >= this.getSlidesCount()) {
			return;
		}

		if (!this.isSlideshow()) {
			Base.prototype.onElementChange.apply(this, arguments);

			return;
		}

		if (0 === propertyName.indexOf('width')) {
			this.swipers.main.update();
			this.swipers.thumbs.update();
		}

		if (0 === propertyName.indexOf('space_between')) {
			this.updateSpaceBetween(this.swipers.thumbs, propertyName);
		}
	}
});

module.exports = function ($scope) {
	new WEWMediaCarousel({ $element: $scope });
};

/***/ }),


/* 11 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = elementorModules.frontend.handlers.Base.extend({
	getDefaultSettings() {
		return {
			selectors: {
				swiperContainer: '.elementor-main-swiper',
				swiperSlide: '.swiper-slide'
			},
			slidesPerView: {
				widescreen: 3,
				desktop: 3,
				laptop: 3,
				tablet_extra: 3,
				tablet: 2,
				mobile_extra: 2,
				mobile: 1
			}
		};
	},

	getDefaultElements() {
		const selectors = this.getSettings('selectors'),
			elements = {
				$swiperContainer: this.$element.find(selectors.swiperContainer)
			};
		elements.$slides = elements.$swiperContainer.find(selectors.swiperSlide);
		return elements;
	},
	
	getSlidesCount() {
		return this.elements.$slides.length;
	},

	getInitialSlide() {
		var editSettings = this.getEditSettings();

		return editSettings.activeItemIndex ? editSettings.activeItemIndex - 1 : 0;
	},
	
	getEffect() {
		return this.getElementSettings('effect');
	},

	getDeviceSlidesPerView(device) {
		const slidesPerViewKey = 'slides_per_view' + ('desktop' === device ? '' : '_' + device);
		return Math.min(this.getSlidesCount(), +this.getElementSettings(slidesPerViewKey) || this.getSettings('slidesPerView')[device]);
	},

	getSlidesPerView(device) {
		if ('slide' === this.getEffect()) {
		return this.getDeviceSlidesPerView(device);
		}

		return 1;
	},

	getDeviceSlidesToScroll(device) {
		const slidesToScrollKey = 'slides_to_scroll' + ('desktop' === device ? '' : '_' + device);
		return Math.min(this.getSlidesCount(), +this.getElementSettings(slidesToScrollKey) || 1);
	},

	getSlidesToScroll(device) {
		if ('slide' === this.getEffect()) {
		return this.getDeviceSlidesToScroll(device);
		}

		return 1;
	},

	getSpaceBetween(device) {
		let propertyName = 'space_between';

		if (device && 'desktop' !== device) {
			propertyName += '_' + device;
		}

		return this.getElementSettings(propertyName).size || 0;
	},

	getSwiperOptions() {
		const elementSettings = this.getElementSettings();
		const swiperOptions = {
			grabCursor: true,
			initialSlide: this.getInitialSlide(),
			slidesPerView: this.getSlidesPerView('desktop'),
			slidesPerGroup: this.getSlidesToScroll('desktop'),
			spaceBetween: this.getSpaceBetween(),
			loop: 'yes' === elementSettings.loop,
			speed: elementSettings.speed,
			effect: this.getEffect(),
			preventClicksPropagation: false,
			slideToClickedSlide: true,
			handleElementorBreakpoints: true
		};

		if (elementSettings.show_arrows) {
			swiperOptions.navigation = {
				prevEl: '.elementor-swiper-button-prev',
				nextEl: '.elementor-swiper-button-next'
			};
		}

		if (elementSettings.pagination) {
			swiperOptions.pagination = {
				el: '.swiper-pagination',
				type: elementSettings.pagination,
				clickable: true
			};
		}

		if ('cube' !== this.getEffect()) {
			const breakpointsSettings = {},
				breakpoints = elementorFrontend.config.responsive.activeBreakpoints;
			Object.keys(breakpoints).forEach(breakpointName => {
				breakpointsSettings[breakpoints[breakpointName].value] = {
					slidesPerView: this.getSlidesPerView(breakpointName),
					slidesPerGroup: this.getSlidesToScroll(breakpointName),
					spaceBetween: this.getSpaceBetween(breakpointName)
				};
			});
			swiperOptions.breakpoints = breakpointsSettings;
		}

		if (!this.isEdit && elementSettings.autoplay) {
			swiperOptions.autoplay = {
				delay: elementSettings.autoplay_speed,
				disableOnInteraction: !!elementSettings.pause_on_interaction
			};
		}

		return swiperOptions;
	},

	getDeviceBreakpointValue(device) {
		if (!this.breakpointsDictionary) {
			const breakpoints = elementorFrontend.config.responsive.activeBreakpoints;
			this.breakpointsDictionary = {};
			Object.keys(breakpoints).forEach(breakpointName => {
				this.breakpointsDictionary[breakpointName] = breakpoints[breakpointName].value;
			});
		}

		return this.breakpointsDictionary[device];
	},

	updateSpaceBetween(propertyName) {
		const deviceMatch = propertyName.match('space_between_(.*)'),
			device = deviceMatch ? deviceMatch[1] : 'desktop',
			newSpaceBetween = this.getSpaceBetween(device);

		if ('desktop' !== device) {
			this.swiper.params.breakpoints[this.getDeviceBreakpointValue(device)].spaceBetween = newSpaceBetween;
		} else {
			this.swiper.params.spaceBetween = newSpaceBetween;
		}

		this.swiper.params.spaceBetween = newSpaceBetween;
		this.swiper.update();
	},

	async onInit() {
		elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
		const elementSettings = this.getElementSettings();

		if (1 >= this.getSlidesCount()) {
			return;
		}

		const Swiper = elementorFrontend.utils.swiper;
		this.swiper = await new Swiper(this.elements.$swiperContainer, this.getSwiperOptions());

		if ('yes' === elementSettings.pause_on_hover) {
			this.togglePauseOnHover(true);
		} // Expose the swiper instance in the frontend

		this.elements.$swiperContainer.data('swiper', this.swiper);
	},

	getChangeableProperties() {
		return {
			autoplay: 'autoplay',
			pause_on_hover: 'pauseOnHover',
			pause_on_interaction: 'disableOnInteraction',
			autoplay_speed: 'delay',
			speed: 'speed',
			width: 'width'
		};
	},

	updateSwiperOption(propertyName) {
		if (0 === propertyName.indexOf('width')) {
			this.swiper.update();
			return;
		}

		const elementSettings = this.getElementSettings(),
			  newSettingValue = elementSettings[propertyName],
			  changeableProperties = this.getChangeableProperties();
		let propertyToUpdate = changeableProperties[propertyName],
			valueToUpdate = newSettingValue; // Handle special cases where the value to update is not the value that the Swiper library accepts

		switch (propertyName) {
			case 'autoplay':
				if (newSettingValue) {
				  valueToUpdate = {
					delay: elementSettings.autoplay_speed,
					disableOnInteraction: 'yes' === elementSettings.pause_on_interaction
				  };
				} else {
				  valueToUpdate = false;
				}

			break;

			case 'autoplay_speed':
				propertyToUpdate = 'autoplay';
				valueToUpdate = {
				  delay: newSettingValue,
				  disableOnInteraction: 'yes' === elementSettings.pause_on_interaction
				};
			break;

			case 'pause_on_hover':
				this.togglePauseOnHover('yes' === newSettingValue);
			break;

			case 'pause_on_interaction':
				valueToUpdate = 'yes' === newSettingValue;
			break;
		} // 'pause_on_hover' is implemented by the handler with event listeners, not the Swiper library


		if ('pause_on_hover' !== propertyName) {
		  this.swiper.params[propertyToUpdate] = valueToUpdate;
		}

		this.swiper.update();
	},

	onElementChange(propertyName) {
		if (1 >= this.getSlidesCount()) {
			return;
		}

		if (0 === propertyName.indexOf('width')) {
			this.swiper.update(); // If there is another thumbs slider, like in the Media Carousel widget.

			  if (this.thumbsSwiper) {
					this.thumbsSwiper.update();
			  }

			return;
		} // This is for handling the responsive control 'space_between'.
		// Responsive controls require a separate way of handling, and some currently don't work
		// (Swiper bug, currently exists in v5.3.6) TODO: update Swiper when bug is fixed and handle responsive controls


		if (0 === propertyName.indexOf('space_between')) {
			this.updateSpaceBetween(propertyName);
			return;
		}

		const changeableProperties = this.getChangeableProperties();

		if (changeableProperties.hasOwnProperty(propertyName)) {
			this.updateSwiperOption(propertyName);
		}
	},

	onEditSettingsChange(propertyName) {
		if (1 >= this.getSlidesCount()) {
		return;
		}

		if ('activeItemIndex' === propertyName) {
			this.swiper.slideToLoop(this.getEditSettings('activeItemIndex') - 1);
		}
	}
});
/***/ }),


/* 12 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var Base = __webpack_require__(11),
    WEWTestimonialCarousel;

WEWTestimonialCarousel = Base.extend({

	getDefaultSettings() {
		const defaultSettings = Base.prototype.getDefaultSettings();
		defaultSettings.slidesPerView = {
			desktop: 1
		};
		Object.keys(elementorFrontend.config.responsive.activeBreakpoints).forEach(breakpointName => {
			defaultSettings.slidesPerView[breakpointName] = 1;
		});

		if (defaultSettings.loop) {
		  defaultSettings.loopedSlides = this.getSlidesCount();
		}

		return defaultSettings;
	},

	getEffect() {
		return 'slide';
	}
});

module.exports = function ($scope) {
	new WEWTestimonialCarousel({ $element: $scope });
};

/***/ }),


/* 13 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _handler = __webpack_require__(14);

var _handler2 = _interopRequireDefault(_handler);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var _class = function (_elementorModules$Mod) {
	_inherits(_class, _elementorModules$Mod);

	function _class() {
		_classCallCheck(this, _class);

		var _this = _possibleConstructorReturn(this, (_class.__proto__ || Object.getPrototypeOf(_class)).call(this));

		elementorFrontend.hooks.addAction('frontend/element_ready/global', function ($element) {
			elementorFrontend.elementsHandler.addHandler(_handler2.default, { $element: $element });
		});
		return _this;
	}

	return _class;
}(elementorModules.Module);

exports.default = _class;

/***/ }),


/* 14 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _get = function get(object, property, receiver) { if (object === null) object = Function.prototype; var desc = Object.getOwnPropertyDescriptor(object, property); if (desc === undefined) { var parent = Object.getPrototypeOf(object); if (parent === null) { return undefined; } else { return get(parent, property, receiver); } } else if ("value" in desc) { return desc.value; } else { var getter = desc.get; if (getter === undefined) { return undefined; } return getter.call(receiver); } };

var _motionFx = __webpack_require__(15);

var _motionFx2 = _interopRequireDefault(_motionFx);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var _class = function (_elementorModules$fro) {
	_inherits(_class, _elementorModules$fro);

	function _class() {
		_classCallCheck(this, _class);

		return _possibleConstructorReturn(this, (_class.__proto__ || Object.getPrototypeOf(_class)).apply(this, arguments));
	}

	_createClass(_class, [{
		key: '__construct',
		value: function __construct() {
			var _get2;

			for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
				args[_key] = arguments[_key];
			}

			(_get2 = _get(_class.prototype.__proto__ || Object.getPrototypeOf(_class.prototype), '__construct', this)).call.apply(_get2, [this].concat(args));

			this.toggle = elementorFrontend.debounce(this.toggle, 200);
		}
	}, {
		key: 'bindEvents',
		value: function bindEvents() {
			elementorFrontend.elements.$window.on('resize', this.toggle);
		}
	}, {
		key: 'unbindEvents',
		value: function unbindEvents() {
			elementorFrontend.elements.$window.off('resize', this.toggle);
		}
	}, {
		key: 'initEffects',
		value: function initEffects() {
			this.effects = {
				translateY: {
					interaction: 'scroll',
					actions: ['translateY']
				},
				translateX: {
					interaction: 'scroll',
					actions: ['translateX']
				},
				rotateZ: {
					interaction: 'scroll',
					actions: ['rotateZ']
				},
				scale: {
					interaction: 'scroll',
					actions: ['scale']
				},
				opacity: {
					interaction: 'scroll',
					actions: ['opacity']
				},
				blur: {
					interaction: 'scroll',
					actions: ['blur']
				},
				mouseTrack: {
					interaction: 'mouseMove',
					actions: ['translateXY']
				},
				tilt: {
					interaction: 'mouseMove',
					actions: ['tilt']
				}
			};
		}
	}, {
		key: 'prepareOptions',
		value: function prepareOptions(name) {
			var _this2 = this;

			var elementSettings = this.getElementSettings(),
			    type = 'motion_fx' === name ? 'element' : 'background',
			    interactions = {};

			jQuery.each(elementSettings, function (key, value) {
				var keyRegex = new RegExp('^' + name + '_(.+?)_effect'),
				    keyMatches = key.match(keyRegex);

				if (!keyMatches || !value) {
					return;
				}

				var options = {},
				    effectName = keyMatches[1];

				jQuery.each(elementSettings, function (subKey, subValue) {
					var subKeyRegex = new RegExp(name + '_' + effectName + '_(.+)'),
					    subKeyMatches = subKey.match(subKeyRegex);

					if (!subKeyMatches) {
						return;
					}

					var subFieldName = subKeyMatches[1];

					if ('effect' === subFieldName) {
						return;
					}

					if ('object' === (typeof subValue === 'undefined' ? 'undefined' : _typeof(subValue))) {
						subValue = Object.keys(subValue.sizes).length ? subValue.sizes : subValue.size;
					}

					options[subKeyMatches[1]] = subValue;
				});

				var effect = _this2.effects[effectName],
				    interactionName = effect.interaction;

				if (!interactions[interactionName]) {
					interactions[interactionName] = {};
				}

				effect.actions.forEach(function (action) {
					return interactions[interactionName][action] = options;
				});
			});

			var $element = this.$element,
			    $dimensionsElement = void 0;

			var elementType = this.getElementType();

			if ('element' === type && 'section' !== elementType) {
				$dimensionsElement = $element;

				var childElementSelector = void 0;

				if ('column' === elementType) {
					childElementSelector = '.elementor-column-wrap';
				} else {
					childElementSelector = '.elementor-widget-container';
				}

				$element = $element.find('> ' + childElementSelector);
			}

			var options = {
				type: type,
				interactions: interactions,
				$element: $element,
				$dimensionsElement: $dimensionsElement,
				refreshDimensions: this.isEdit,
				classes: {
					element: 'elementor-motion-effects-element',
					parent: 'elementor-motion-effects-parent',
					backgroundType: 'elementor-motion-effects-element-type-background',
					container: 'elementor-motion-effects-container',
					layer: 'elementor-motion-effects-layer',
					perspective: 'elementor-motion-effects-perspective'
				}
			};

			if ('fixed' === this.getCurrentDeviceSetting('_position')) {
				options.range = 'page';
			}

			if ('background' === type && 'column' === this.getElementType()) {
				options.addBackgroundLayerTo = ' > .elementor-element-populated';
			}

			return options;
		}
	}, {
		key: 'activate',
		value: function activate(name) {
			var options = this.prepareOptions(name);

			if (jQuery.isEmptyObject(options.interactions)) {
				return;
			}

			this[name] = new _motionFx2.default(options);
		}
	}, {
		key: 'deactivate',
		value: function deactivate(name) {
			if (this[name]) {
				this[name].destroy();

				delete this[name];
			}
		}
	}, {
		key: 'toggle',
		value: function toggle() {
			var _this3 = this;

			var currentDeviceMode = elementorFrontend.getCurrentDeviceMode(),
			    elementSettings = this.getElementSettings();

			['motion_fx', 'background_motion_fx'].forEach(function (name) {
				var devices = elementSettings[name + '_devices'],
				    isCurrentModeActive = !devices || -1 !== devices.indexOf(currentDeviceMode);

				if (isCurrentModeActive && (elementSettings[name + '_motion_fx_scrolling'] || elementSettings[name + '_motion_fx_mouse'])) {
					if (_this3[name]) {
						_this3.refreshInstance(name);
					} else {
						_this3.activate(name);
					}
				} else {
					_this3.deactivate(name);
				}
			});
		}
	}, {
		key: 'refreshInstance',
		value: function refreshInstance(instanceName) {
			var instance = this[instanceName];

			if (!instance) {
				return;
			}

			var preparedOptions = this.prepareOptions(instanceName);

			instance.setSettings(preparedOptions);

			instance.refresh();
		}
	}, {
		key: 'onInit',
		value: function onInit() {
			_get(_class.prototype.__proto__ || Object.getPrototypeOf(_class.prototype), 'onInit', this).call(this);

			this.initEffects();

			this.toggle();
		}
	}, {
		key: 'onElementChange',
		value: function onElementChange(propertyName) {
			var _this4 = this;

			if (/motion_fx_((scrolling)|(mouse)|(devices))$/.test(propertyName)) {
				this.toggle();

				return;
			}

			var propertyMatches = propertyName.match('.*?motion_fx');

			if (propertyMatches) {
				var instanceName = propertyMatches[0];

				this.refreshInstance(instanceName);

				if (!this[instanceName]) {
					this.activate(instanceName);
				}
			}

			if (/^_position/.test(propertyName)) {
				['motion_fx', 'background_motion_fx'].forEach(function (instanceName) {
					_this4.refreshInstance(instanceName);
				});
			}
		}
	}, {
		key: 'onDestroy',
		value: function onDestroy() {
			var _this5 = this;

			_get(_class.prototype.__proto__ || Object.getPrototypeOf(_class.prototype), 'onDestroy', this).call(this);

			['motion_fx', 'background_motion_fx'].forEach(function (name) {
				_this5.deactivate(name);
			});
		}
	}]);

	return _class;
}(elementorModules.frontend.handlers.Base);

exports.default = _class;

/***/ }),


/* 15 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _get = function get(object, property, receiver) { if (object === null) object = Function.prototype; var desc = Object.getOwnPropertyDescriptor(object, property); if (desc === undefined) { var parent = Object.getPrototypeOf(object); if (parent === null) { return undefined; } else { return get(parent, property, receiver); } } else if ("value" in desc) { return desc.value; } else { var getter = desc.get; if (getter === undefined) { return undefined; } return getter.call(receiver); } };

var _scroll = __webpack_require__(16);

var _scroll2 = _interopRequireDefault(_scroll);

var _mouseMove = __webpack_require__(17);

var _mouseMove2 = _interopRequireDefault(_mouseMove);

var _actions2 = __webpack_require__(18);

var _actions3 = _interopRequireDefault(_actions2);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var _class = function (_elementorModules$Vie) {
	_inherits(_class, _elementorModules$Vie);

	function _class() {
		_classCallCheck(this, _class);

		return _possibleConstructorReturn(this, (_class.__proto__ || Object.getPrototypeOf(_class)).apply(this, arguments));
	}

	_createClass(_class, [{
		key: 'getDefaultSettings',
		value: function getDefaultSettings() {
			return {
				type: 'element',
				$element: null,
				$dimensionsElement: null,
				addBackgroundLayerTo: null,
				interactions: {},
				refreshDimensions: false,
				range: 'viewport',
				classes: {
					element: 'motion-fx-element',
					parent: 'motion-fx-parent',
					backgroundType: 'motion-fx-element-type-background',
					container: 'motion-fx-container',
					layer: 'motion-fx-layer',
					perspective: 'motion-fx-perspective'
				}
			};
		}
	}, {
		key: 'bindEvents',
		value: function bindEvents() {
			this.onWindowResize = this.onWindowResize.bind(this);

			elementorFrontend.elements.$window.on('resize', this.onWindowResize);
		}
	}, {
		key: 'unbindEvents',
		value: function unbindEvents() {
			elementorFrontend.elements.$window.off('resize', this.onWindowResize);
		}
	}, {
		key: 'addBackgroundLayer',
		value: function addBackgroundLayer() {
			var settings = this.getSettings();

			this.elements.$motionFXContainer = jQuery('<div>', { class: settings.classes.container });

			this.elements.$motionFXLayer = jQuery('<div>', { class: settings.classes.layer });

			this.updateBackgroundLayerSize();

			this.elements.$motionFXContainer.prepend(this.elements.$motionFXLayer);

			var $addBackgroundLayerTo = settings.addBackgroundLayerTo ? this.$element.find(settings.addBackgroundLayerTo) : this.$element;

			$addBackgroundLayerTo.prepend(this.elements.$motionFXContainer);
		}
	}, {
		key: 'removeBackgroundLayer',
		value: function removeBackgroundLayer() {
			this.elements.$motionFXContainer.remove();
		}
	}, {
		key: 'updateBackgroundLayerSize',
		value: function updateBackgroundLayerSize() {
			var settings = this.getSettings(),
			    speed = {
				x: 0,
				y: 0
			},
			    mouseInteraction = settings.interactions.mouseMove,
			    scrollInteraction = settings.interactions.scroll;

			if (mouseInteraction && mouseInteraction.translateXY) {
				speed.x = mouseInteraction.translateXY.speed * 10;
				speed.y = mouseInteraction.translateXY.speed * 10;
			}

			if (scrollInteraction) {
				if (scrollInteraction.translateX) {
					speed.x = scrollInteraction.translateX.speed * 10;
				}

				if (scrollInteraction.translateY) {
					speed.y = scrollInteraction.translateY.speed * 10;
				}
			}

			this.elements.$motionFXLayer.css({
				width: 100 + speed.x + '%',
				height: 100 + speed.y + '%'
			});
		}
	}, {
		key: 'defineDimensions',
		value: function defineDimensions() {
			var $dimensionsElement = this.getSettings('$dimensionsElement') || this.$element,
			    elementOffset = $dimensionsElement.offset();

			var dimensions = {
				elementHeight: $dimensionsElement.outerHeight(),
				elementWidth: $dimensionsElement.outerWidth(),
				elementTop: elementOffset.top,
				elementLeft: elementOffset.left
			};

			dimensions.elementRange = dimensions.elementHeight + innerHeight;

			this.setSettings('dimensions', dimensions);

			if ('background' === this.getSettings('type')) {
				this.defineBackgroundLayerDimensions();
			}
		}
	}, {
		key: 'defineBackgroundLayerDimensions',
		value: function defineBackgroundLayerDimensions() {
			var dimensions = this.getSettings('dimensions');

			dimensions.layerHeight = this.elements.$motionFXLayer.height();
			dimensions.layerWidth = this.elements.$motionFXLayer.width();
			dimensions.movableX = dimensions.layerWidth - dimensions.elementWidth;
			dimensions.movableY = dimensions.layerHeight - dimensions.elementHeight;

			this.setSettings('dimensions', dimensions);
		}
	}, {
		key: 'initInteractionsTypes',
		value: function initInteractionsTypes() {
			this.interactionsTypes = {
				scroll: _scroll2.default,
				mouseMove: _mouseMove2.default
			};
		}
	}, {
		key: 'prepareSpecialActions',
		value: function prepareSpecialActions() {
			var settings = this.getSettings(),
			    hasTiltEffect = !!(settings.interactions.mouseMove && settings.interactions.mouseMove.tilt);

			this.elements.$parent.toggleClass(settings.classes.perspective, hasTiltEffect);
		}
	}, {
		key: 'cleanSpecialActions',
		value: function cleanSpecialActions() {
			var settings = this.getSettings();

			this.elements.$parent.removeClass(settings.classes.perspective);
		}
	}, {
		key: 'runInteractions',
		value: function runInteractions() {
			var _this2 = this;

			var settings = this.getSettings();

			this.prepareSpecialActions();

			jQuery.each(settings.interactions, function (interactionName, actions) {
				_this2.interactions[interactionName] = new _this2.interactionsTypes[interactionName]({
					motionFX: _this2,
					callback: function callback() {
						for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
							args[_key] = arguments[_key];
						}

						jQuery.each(actions, function (actionName, actionData) {
							var _actions;

							return (_actions = _this2.actions).runAction.apply(_actions, [actionName, actionData].concat(args));
						});
					}
				});

				_this2.interactions[interactionName].runImmediately();
			});
		}
	}, {
		key: 'destroyInteractions',
		value: function destroyInteractions() {
			this.cleanSpecialActions();

			jQuery.each(this.interactions, function (interactionName, interaction) {
				return interaction.destroy();
			});

			this.interactions = {};
		}
	}, {
		key: 'refresh',
		value: function refresh() {
			this.actions.setSettings(this.getSettings());

			if ('background' === this.getSettings('type')) {
				this.updateBackgroundLayerSize();

				this.defineBackgroundLayerDimensions();
			}

			this.actions.refresh();

			this.destroyInteractions();

			this.runInteractions();
		}
	}, {
		key: 'destroy',
		value: function destroy() {
			this.destroyInteractions();

			this.actions.refresh();

			var settings = this.getSettings();

			this.$element.removeClass(settings.classes.element);

			this.elements.$parent.removeClass(settings.classes.parent);

			if ('background' === settings.type) {
				this.$element.removeClass(settings.classes.backgroundType);

				this.removeBackgroundLayer();
			}
		}
	}, {
		key: 'onInit',
		value: function onInit() {
			_get(_class.prototype.__proto__ || Object.getPrototypeOf(_class.prototype), 'onInit', this).call(this);

			var settings = this.getSettings();

			this.$element = settings.$element;

			this.elements.$parent = this.$element.parent();

			this.$element.addClass(settings.classes.element);

			this.elements.$parent = this.$element.parent();

			this.elements.$parent.addClass(settings.classes.parent);

			if ('background' === settings.type) {
				this.$element.addClass(settings.classes.backgroundType);

				this.addBackgroundLayer();
			}

			this.defineDimensions();

			settings.$targetElement = 'element' === settings.type ? this.$element : this.elements.$motionFXLayer;

			this.interactions = {};

			this.actions = new _actions3.default(settings);

			this.initInteractionsTypes();

			this.runInteractions();
		}
	}, {
		key: 'onWindowResize',
		value: function onWindowResize() {
			this.defineDimensions();
		}
	}]);

	return _class;
}(elementorModules.ViewModule);

exports.default = _class;

/***/ }),


/* 16 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _base = __webpack_require__(19);

var _base2 = _interopRequireDefault(_base);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var _class = function (_BaseInteraction) {
	_inherits(_class, _BaseInteraction);

	function _class() {
		_classCallCheck(this, _class);

		return _possibleConstructorReturn(this, (_class.__proto__ || Object.getPrototypeOf(_class)).apply(this, arguments));
	}

	_createClass(_class, [{
		key: 'run',
		value: function run() {
			if (pageYOffset === this.windowScrollTop) {
				return;
			}

			var motionFXSettings = this.motionFX.getSettings();

			if (motionFXSettings.refreshDimensions) {
				this.motionFX.defineDimensions();
			}

			this.windowScrollTop = pageYOffset;

			var passedRangePercents = void 0;

			if ('page' === this.motionFX.getSettings('range')) {
				passedRangePercents = document.documentElement.scrollTop / (document.body.scrollHeight - innerHeight) * 100;
			} else {
				var dimensions = motionFXSettings.dimensions,
				    elementTopWindowPoint = dimensions.elementTop - pageYOffset,
				    elementEntrancePoint = elementTopWindowPoint - innerHeight;

				passedRangePercents = 100 / dimensions.elementRange * (elementEntrancePoint * -1);
			}

			this.runCallback(passedRangePercents);
		}
	}]);

	return _class;
}(_base2.default);

exports.default = _class;
/***/ }),


/* 17 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _get = function get(object, property, receiver) { if (object === null) object = Function.prototype; var desc = Object.getOwnPropertyDescriptor(object, property); if (desc === undefined) { var parent = Object.getPrototypeOf(object); if (parent === null) { return undefined; } else { return get(parent, property, receiver); } } else if ("value" in desc) { return desc.value; } else { var getter = desc.get; if (getter === undefined) { return undefined; } return getter.call(receiver); } };

var _base = __webpack_require__(19);

var _base2 = _interopRequireDefault(_base);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var MouseMoveInteraction = function (_BaseInteraction) {
	_inherits(MouseMoveInteraction, _BaseInteraction);

	function MouseMoveInteraction() {
		_classCallCheck(this, MouseMoveInteraction);

		return _possibleConstructorReturn(this, (MouseMoveInteraction.__proto__ || Object.getPrototypeOf(MouseMoveInteraction)).apply(this, arguments));
	}

	_createClass(MouseMoveInteraction, [{
		key: 'bindEvents',
		value: function bindEvents() {
			if (!MouseMoveInteraction.mouseTracked) {
				elementorFrontend.elements.$window.on('mousemove', MouseMoveInteraction.updateMousePosition);

				MouseMoveInteraction.mouseTracked = true;
			}
		}
	}, {
		key: 'run',
		value: function run() {
			var mousePosition = MouseMoveInteraction.mousePosition,
			    oldMousePosition = this.oldMousePosition;

			if (oldMousePosition.x === mousePosition.x && oldMousePosition.y === mousePosition.y) {
				return;
			}

			this.oldMousePosition = {
				x: mousePosition.x,
				y: mousePosition.y
			};

			var passedPercentsX = 100 / innerWidth * mousePosition.x,
			    passedPercentsY = 100 / innerHeight * mousePosition.y;

			this.runCallback(passedPercentsX, passedPercentsY);
		}
	}, {
		key: 'onInit',
		value: function onInit() {
			this.oldMousePosition = {};

			_get(MouseMoveInteraction.prototype.__proto__ || Object.getPrototypeOf(MouseMoveInteraction.prototype), 'onInit', this).call(this);
		}
	}]);

	return MouseMoveInteraction;
}(_base2.default);

exports.default = MouseMoveInteraction;


MouseMoveInteraction.mousePosition = {};

MouseMoveInteraction.updateMousePosition = function (event) {
	MouseMoveInteraction.mousePosition = {
		x: event.clientX,
		y: event.clientY
	};
};
/***/ }),


/* 18 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var _class = function (_elementorModules$Mod) {
	_inherits(_class, _elementorModules$Mod);

	function _class() {
		_classCallCheck(this, _class);

		return _possibleConstructorReturn(this, (_class.__proto__ || Object.getPrototypeOf(_class)).apply(this, arguments));
	}

	_createClass(_class, [{
		key: 'getMovePointFromPassedPercents',
		value: function getMovePointFromPassedPercents(movableRange, passedPercents) {
			var movePoint = passedPercents / movableRange * 100;

			return +movePoint.toFixed(2);
		}
	}, {
		key: 'getEffectValueFromMovePoint',
		value: function getEffectValueFromMovePoint(range, movePoint) {
			return range * movePoint / 100;
		}
	}, {
		key: 'getStep',
		value: function getStep(passedPercents, options) {
			if ('element' === this.getSettings('type')) {
				return this.getElementStep(passedPercents, options);
			}

			return this.getBackgroundStep(passedPercents, options);
		}
	}, {
		key: 'getElementStep',
		value: function getElementStep(passedPercents, options) {
			return -(passedPercents - 50) * options.speed;
		}
	}, {
		key: 'getBackgroundStep',
		value: function getBackgroundStep(passedPercents, options) {
			var movableRange = this.getSettings('dimensions.movable' + options.axis.toUpperCase());

			return -this.getEffectValueFromMovePoint(movableRange, passedPercents);
		}
	}, {
		key: 'getDirectionMovePoint',
		value: function getDirectionMovePoint(passedPercents, direction, range) {
			var movePoint = void 0;

			if (passedPercents < range.start) {
				if ('out-in' === direction) {
					movePoint = 0;
				} else if ('in-out' === direction) {
					movePoint = 100;
				} else {
					movePoint = this.getMovePointFromPassedPercents(range.start, passedPercents);

					if ('in-out-in' === direction) {
						movePoint = 100 - movePoint;
					}
				}
			} else if (passedPercents < range.end) {
				if ('in-out-in' === direction) {
					movePoint = 0;
				} else if ('out-in-out' === direction) {
					movePoint = 100;
				} else {
					movePoint = this.getMovePointFromPassedPercents(range.end - range.start, passedPercents - range.start);

					if ('in-out' === direction) {
						movePoint = 100 - movePoint;
					}
				}
			} else if ('in-out' === direction) {
				movePoint = 0;
			} else if ('out-in' === direction) {
				movePoint = 100;
			} else {
				movePoint = this.getMovePointFromPassedPercents(100 - range.end, 100 - passedPercents);

				if ('in-out-in' === direction) {
					movePoint = 100 - movePoint;
				}
			}

			return movePoint;
		}
	}, {
		key: 'translateX',
		value: function translateX(actionData, passedPercents) {
			actionData.axis = 'x';
			actionData.unit = 'px';

			this.transform('translateX', passedPercents, actionData);
		}
	}, {
		key: 'translateY',
		value: function translateY(actionData, passedPercents) {
			actionData.axis = 'y';
			actionData.unit = 'px';

			this.transform('translateY', passedPercents, actionData);
		}
	}, {
		key: 'translateXY',
		value: function translateXY(actionData, passedPercentsX, passedPercentsY) {
			this.translateX(actionData, passedPercentsX);

			this.translateY(actionData, passedPercentsY);
		}
	}, {
		key: 'tilt',
		value: function tilt(actionData, passedPercentsX, passedPercentsY) {
			var options = {
				speed: actionData.speed / 10,
				direction: actionData.direction
			};

			this.rotateX(options, passedPercentsY);

			this.rotateY(options, 100 - passedPercentsX);
		}
	}, {
		key: 'rotateX',
		value: function rotateX(actionData, passedPercents) {
			actionData.axis = 'x';
			actionData.unit = 'deg';

			this.transform('rotateX', passedPercents, actionData);
		}
	}, {
		key: 'rotateY',
		value: function rotateY(actionData, passedPercents) {
			actionData.axis = 'y';
			actionData.unit = 'deg';

			this.transform('rotateY', passedPercents, actionData);
		}
	}, {
		key: 'rotateZ',
		value: function rotateZ(actionData, passedPercents) {
			actionData.unit = 'deg';

			this.transform('rotateZ', passedPercents, actionData);
		}
	}, {
		key: 'scale',
		value: function scale(actionData, passedPercents) {
			var movePoint = this.getDirectionMovePoint(passedPercents, actionData.direction, actionData.range);

			this.updateRulePart('transform', 'scale', 1 + actionData.speed * movePoint / 1000);
		}
	}, {
		key: 'transform',
		value: function transform(action, passedPercents, actionData) {
			if (actionData.direction) {
				passedPercents = 100 - passedPercents;
			}

			this.updateRulePart('transform', action, this.getStep(passedPercents, actionData) + actionData.unit);
		}
	}, {
		key: 'opacity',
		value: function opacity(actionData, passedPercents) {
			var movePoint = this.getDirectionMovePoint(passedPercents, actionData.direction, actionData.range),
			    level = actionData.level / 10,
			    opacity = 1 - level + this.getEffectValueFromMovePoint(level, movePoint);

			this.$element.css('opacity', opacity);
		}
	}, {
		key: 'blur',
		value: function blur(actionData, passedPercents) {
			var movePoint = this.getDirectionMovePoint(passedPercents, actionData.direction, actionData.range),
			    blur = actionData.level - this.getEffectValueFromMovePoint(actionData.level, movePoint);

			this.updateRulePart('filter', 'blur', blur + 'px');
		}
	}, {
		key: 'updateRulePart',
		value: function updateRulePart(ruleName, key, value) {
			if (!this.rulesVariables[ruleName]) {
				this.rulesVariables[ruleName] = {};
			}

			if (!this.rulesVariables[ruleName][key]) {
				this.rulesVariables[ruleName][key] = true;

				this.updateRule(ruleName);
			}

			var cssVarKey = '--' + key;

			this.$element[0].style.setProperty(cssVarKey, value);
		}
	}, {
		key: 'updateRule',
		value: function updateRule(ruleName) {
			var value = '';

			jQuery.each(this.rulesVariables[ruleName], function (variableKey) {
				value += variableKey + '(var(--' + variableKey + '))';
			});

			this.$element.css(ruleName, value);
		}
	}, {
		key: 'runAction',
		value: function runAction(actionName, actionData, passedPercents) {
			if (actionData.affectedRange) {
				if (actionData.affectedRange.start > passedPercents) {
					passedPercents = actionData.affectedRange.start;
				}

				if (actionData.affectedRange.end < passedPercents) {
					passedPercents = actionData.affectedRange.end;
				}
			}

			for (var _len = arguments.length, args = Array(_len > 3 ? _len - 3 : 0), _key = 3; _key < _len; _key++) {
				args[_key - 3] = arguments[_key];
			}

			this[actionName].apply(this, [actionData, passedPercents].concat(args));
		}
	}, {
		key: 'refresh',
		value: function refresh() {
			this.rulesVariables = {};

			this.$element.css({
				transform: '',
				filter: '',
				opacity: ''
			});
		}
	}, {
		key: 'onInit',
		value: function onInit() {
			this.$element = this.getSettings('$targetElement');

			this.refresh();
		}
	}]);

	return _class;
}(elementorModules.Module);

exports.default = _class;

/***/ }),


/* 19 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _get = function get(object, property, receiver) { if (object === null) object = Function.prototype; var desc = Object.getOwnPropertyDescriptor(object, property); if (desc === undefined) { var parent = Object.getPrototypeOf(object); if (parent === null) { return undefined; } else { return get(parent, property, receiver); } } else if ("value" in desc) { return desc.value; } else { var getter = desc.get; if (getter === undefined) { return undefined; } return getter.call(receiver); } };

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var _class = function (_elementorModules$Vie) {
	_inherits(_class, _elementorModules$Vie);

	function _class() {
		_classCallCheck(this, _class);

		return _possibleConstructorReturn(this, (_class.__proto__ || Object.getPrototypeOf(_class)).apply(this, arguments));
	}

	_createClass(_class, [{
		key: '__construct',
		value: function __construct(options) {
			var _this2 = this;

			this.motionFX = options.motionFX;

			this.runImmediately = this.run;

			this.run = function () {
				_this2.animationFrameRequest = requestAnimationFrame(_this2.run.bind(_this2));

				if ('page' === _this2.motionFX.getSettings('range')) {
					_this2.runImmediately();

					return;
				}

				var dimensions = _this2.motionFX.getSettings('dimensions'),
				    elementTopWindowPoint = dimensions.elementTop - pageYOffset,
				    elementEntrancePoint = elementTopWindowPoint - innerHeight,
				    elementExitPoint = elementTopWindowPoint + dimensions.elementHeight;

				if (elementEntrancePoint <= 0 && elementExitPoint >= 0) {
					_this2.runImmediately();
				}
			};
		}
	}, {
		key: 'runCallback',
		value: function runCallback() {
			var callback = this.getSettings('callback');

			callback.apply(undefined, arguments);
		}
	}, {
		key: 'destroy',
		value: function destroy() {
			cancelAnimationFrame(this.animationFrameRequest);
		}
	}, {
		key: 'onInit',
		value: function onInit() {
			_get(_class.prototype.__proto__ || Object.getPrototypeOf(_class.prototype), 'onInit', this).call(this);

			this.run();
		}
	}]);

	return _class;
}(elementorModules.ViewModule);

exports.default = _class;
/***/ }),


/* 20 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

module.exports = function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/wew-search-pro.default', __webpack_require__(21));
};
/***/ }),


/* 21 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var WEWSearchProHandler = elementorModules.frontend.handlers.Base.extend({

    getDefaultSettings: function getDefaultSettings() {
        return {
            selectors: {
                wrapper: '.woovina-search-pro',
                container: '.woovina-search-pro__container',
                icon: '.woovina-search-pro__icon',
                input: '.woovina-search-pro__input',
                toggle: '.woovina-search-pro__toggle',
                submit: '.woovina-search-pro__submit',
                closeButton: '.dialog-close-button'
            },
            classes: {
                isFocus: 'woovina-search-pro--focus',
                isFullScreen: 'woovina-search-pro--full-screen',
                lightbox: 'elementor-lightbox'
            }
        };
    },

    getDefaultElements: function getDefaultElements() {
        var selectors = this.getSettings('selectors'),
            elements = {};

        elements.$wrapper = this.$element.find(selectors.wrapper);
        elements.$container = this.$element.find(selectors.container);
        elements.$input = this.$element.find(selectors.input);
        elements.$icon = this.$element.find(selectors.icon);
        elements.$toggle = this.$element.find(selectors.toggle);
        elements.$submit = this.$element.find(selectors.submit);
        elements.$closeButton = this.$element.find(selectors.closeButton);

        return elements;
    },

    bindEvents: function bindEvents() {
        var self = this,
            $container = self.elements.$container,
            $closeButton = self.elements.$closeButton,
            $input = self.elements.$input,
            $wrapper = self.elements.$wrapper,
            $icon = self.elements.$icon,
            skin = this.getElementSettings('skin'),
            classes = this.getSettings('classes');

        if ('full_screen' === skin) {
            // Activate full-screen mode on click
            self.elements.$toggle.on('click', function () {
                $container.toggleClass(classes.isFullScreen).toggleClass(classes.lightbox);
                $input.focus();
            });

            // Deactivate full-screen mode on click or on esc.
            $container.on('click', function (event) {
                if ($container.hasClass(classes.isFullScreen) && $container[0] === event.target) {
                    $container.removeClass(classes.isFullScreen).removeClass(classes.lightbox);
                }
            });
            $closeButton.on('click', function () {
                $container.removeClass(classes.isFullScreen).removeClass(classes.lightbox);
            });
            elementorFrontend.elements.$document.keyup(function (event) {
                var ESC_KEY = 27;

                if (ESC_KEY === event.keyCode) {
                    if ($container.hasClass(classes.isFullScreen)) {
                        $container.click();
                    }
                }
            });
        } else {
            // Apply focus style on wrapper element when input is focused
            $input.on({
                focus: function focus() {
                    $wrapper.addClass(classes.isFocus);
                },
                blur: function blur() {
                    $wrapper.removeClass(classes.isFocus);
                }
            });
        }

        if ('minimal' === skin) {
            // Apply focus style on wrapper element when icon is clicked in minimal skin
            $icon.on('click', function () {
                $wrapper.addClass(classes.isFocus);
                $input.focus();
            });
        }
    }
});

module.exports = function ($scope) {
    new WEWSearchProHandler({ $element: $scope });
};
/***/ }),

/******/ ]);