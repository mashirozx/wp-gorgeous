var Mashiro = {
	SETTINGS: {
		debug: true,
		moblie_max_width: 860,
		scroll_sensitive: 100,
		scroll_speed: 10,
		thumb_list_right_offset: 500,
		herder_height: 80,
	},

	VARBLES: {

	},

	V_TEMP_VARBLES: {
		scroll_l: null,
	},

	F_NORMALIZE: function () {
		if ($(window).width() > Mashiro.SETTINGS.moblie_max_width) {
			// ### Scripts work ONLY on desktop
			this.F_INDEX_COVER_INI();
			this.F_HORIZONTAL_SCROLL();
			this.F_PAD_USER_ALERT();
			this.F_PAD_TOUCH_FIX();
			this.F_HEADER_BAR_SHOW_TITLE();
			this.F_READ_MODE();

		} else {
			// ### Scripts work ONLY on mobile
			if (!this.V_HORIZONTAL_SCROLL_VARBLES.has_thumb_list) {
				$('.main-container').css('top', '-100%');
			} else {
				$('.main-container').css('top', '0');
			}
			this.F_MOBILE_OPEN_NAV();
			this.F_MOBILE_GO_TOP();

		}
		// ### Common scripts
		window.debug = function (x) {
			if (Mashiro.SETTINGS.debug) console.log('Debug info: ' + x);
		};
		$(window).on('load', function () {
			$('.loading-page').css('display', 'none')
		});
		this.F_COVER_COLOR_INI();
		this.F_PAGE_MAIN_COLOR();
		this.F_AJAX_NEXT_THUMB_LIST();
		this.F_PJAX();
		this.F_SIDE_BUTTOMS();
		this.F_TOC_BOT();
		this.F_ANIMATE();

	},

	F_PJAX_RELOAD: function () {
		if ($(window).width() > Mashiro.SETTINGS.moblie_max_width) {
			// ### Scripts work ONLY on desktop
			this.V_HORIZONTAL_SCROLL_VARBLES.has_thumb_list = $('div').hasClass('post-thumb-list');
			this.V_TEMP_VARBLES.scroll_l = this.V_HORIZONTAL_SCROLL_VARBLES.scroll_l;
			this.V_HORIZONTAL_SCROLL_VARBLES.scroll_l = 0;
			// if is home, initial/re-initial scroll varbles.
			if (this.V_HORIZONTAL_SCROLL_VARBLES.has_thumb_list) {
				this.V_HORIZONTAL_SCROLL_VARBLES.eof_l = document.querySelector('.post-thumb-item-eof').offsetLeft;
				this.F_HORIZONTAL_SCROLL();
			}
			this.F_PAD_TOUCH_FIX();
			this.F_HEADER_BAR_SHOW_TITLE();
			this.F_READ_MODE();

		} else {
			// ### Scripts work ONLY on mobile
			this.V_HORIZONTAL_SCROLL_VARBLES.has_thumb_list = $('div').hasClass('post-thumb-list');
			if (!this.V_HORIZONTAL_SCROLL_VARBLES.has_thumb_list) {
				$('.main-container').css('top', '-100%');
			} else {
				$('.main-container').css('top', '0');
			}

		}
		// ### Common scripts
		this.F_PAGE_MAIN_COLOR();
		this.F_SIDE_BUTTOMS();
		this.F_TOC_BOT();
		this.F_ANIMATE(true);

	},

	F_PJAX_BACK_RELOAD: function () {
		if ($(window).width() > Mashiro.SETTINGS.moblie_max_width) {
			// ### Scripts work ONLY on desktop
			this.V_HORIZONTAL_SCROLL_VARBLES.has_thumb_list = $('div').hasClass('post-thumb-list');
			this.V_HORIZONTAL_SCROLL_VARBLES.scroll_l = this.V_TEMP_VARBLES.scroll_l;
			// if is home, initial/re-initial scroll varbles.
			if (this.V_HORIZONTAL_SCROLL_VARBLES.has_thumb_list) {
				this.V_HORIZONTAL_SCROLL_VARBLES.eof_l = document.querySelector('.post-thumb-item-eof').offsetLeft;
				this.F_HORIZONTAL_SCROLL();
			}
			this.F_HEADER_BAR_SHOW_TITLE();
			this.F_READ_MODE();

		} else {
			// ### Scripts work ONLY on mobile
			this.V_HORIZONTAL_SCROLL_VARBLES.has_thumb_list = $('div').hasClass('post-thumb-list');
			if (!this.V_HORIZONTAL_SCROLL_VARBLES.has_thumb_list) {
				$('.main-container').css('top', '-100%');
			} else {
				$('.main-container').css('top', '0');
			}

		}
		// ### Common scripts
		this.F_PAGE_MAIN_COLOR();
		this.F_SIDE_BUTTOMS();
		this.F_TOC_BOT();

	},

	F_PAGE_MAIN_COLOR: function () {
		var getPageMainColor = function () {
			//debug('load');
			if ($('img').hasClass('page-feature-image')) {
				var vibrant = new Vibrant($('#page-feature-image')[0]);
			} else {
				var vibrant = new Vibrant($('#cover')[0]);
			}

			var swatches = vibrant.swatches();
			$('#mobile-open-nav-icon').css('--theme-color', swatches['DarkVibrant'].getHex());
			$('#mobile-open-nav-iconflat').css('--theme-color', swatches['DarkVibrant'].getHex());
		}
		// This might not be a good form
		try {
			getPageMainColor();
		} catch (e) {
			$(window).on('load', function () {
				getPageMainColor();
			});
		}
	},

	F_MOBILE_OPEN_NAV: function () {
		$('#mobile-open-nav-iconflat').on("click", function () {
			//debug('detect click');
			if ($('#mobile-open-nav-iconflat').attr('class').indexOf('opened') === -1) {
				// open nav
				//debug('open');
				//$('#mobile-nav-container').css('right','0');
				$('#mobile-nav-container,#main-container').removeClass('out');
				$('#mobile-nav-container,#main-container').addClass('in');
				setTimeout(function () {
					$('#mobile-open-nav-iconflat').addClass('opened');
					$('#mobile-open-nav').css('right', 'calc(100% - 60px)');
				}, 100);
			} else {
				// close nav
				//debug('close');
				//$('#mobile-nav-container').css('right','-100%');
				$('#mobile-nav-container,#main-container').removeClass('in');
				$('#mobile-nav-container,#main-container').addClass('out');
				$('#mobile-open-nav-iconflat').removeClass('opened');
				$('#mobile-open-nav').css('right', '10px');
			}
		});
	},

	F_READ_MODE: function () {
		$("#open-read-mode").on("click", function () {
			$("#entry-content").clone().prop({
				'id': 'read-mode-entry-content',
				'class': "entry-content read-mode"
			}).appendTo("#read-mode-scroll-layer");
			$('#read-mode-container').css({
				'top': 0
			});
		});
		$("#close-read-mode").on("click", function () {
			$('#read-mode-container').css({
				'top': '-100%'
			});
			$('#read-mode-entry-content').remove();
		});
	},

	F_TOC_BOT: function () {
		$(document).ready(function () {
			if ($("div").hasClass("toc")) {
				// Adding tag id
				var id = 1;
				$(".entry-content article").children("h1,h2,h3,h4,h5").each(function () {
					var hyphenated = "mashiro-" + id;
					$(this).attr('id', hyphenated);
					id++;
				});
				// Initial Tocbot
				tocbot.init({
					// Where to render the table of contents.
					tocSelector: '.toc',
					// Where to grab the headings to build the table of contents.
					contentSelector: '.markdown-body',
					// Which headings to grab inside of the contentSelector element.
					headingSelector: 'h1, h2, h3, h4, h5',
					scrollContainer: '#entry-viewbox',
				});
			}
		});
	},

	F_ANIMATE: function (pjax) {
		$('.animated').each(function () {
			/* 
			 * Animation: onload, onshow, onhover, onclick
			 */

			if ($(this).attr('data-animate').indexOf('null') === 0) { // [ no event ]
				//return false;
			} else if ($(this).attr('data-animate').indexOf('onshow') === 0) { // [ onshow ]
				var node = $(this),
					top = node.offset().top,
					scroll_top = document.querySelector('#entry-viewbox').scrollTop,
					show_animate = function () {
						if (scroll_top + Mashiro.SETTINGS.herder_height >= top) {
							node.addClass(node.attr('data-animate'));
						}
					};
				document.addEventListener('scroll', show_animate, false);
				// When there is no scroll event (like the article feature imager)
				if (pjax) {
					if (scroll_top + Mashiro.SETTINGS.herder_height == top) {
						node.addClass(node.attr('data-animate'));
					}
				} else {
					$(window).on('load', function () {
						if (scroll_top + Mashiro.SETTINGS.herder_height == top) {
							node.addClass(node.attr('data-animate'));
						}
					});
				}
			} else if ($(this).attr('data-animate').indexOf('onload') === 0) { //[ onload ]
				var node = $(this);
				if (pjax) {
					node.removeClass(node.attr('data-animate'));
					node.addClass(node.attr('data-animate'));
				} else {
					$(window).on('load', function () {
						node.addClass(node.attr('data-animate'));
					});
				}
			} else if ($(this).attr('data-animate').indexOf('onhover') === 0) { //[ onhover ]

			}

		});

	},

	F_SIDE_BUTTOMS: function () {
		$("#button-show-comment").on("click", function () {
			$('#comment-box').css('right', '0');
		});
		$("#button-hide-comment").on("click", function () {
			$('#comment-box').css('right', '-50vw');
		});
		$("#nav-go-top").on("click", function () {
			//$( "#entry-viewbox" ).scrollTop( 0 );
			$("#entry-viewbox").animate({
				scrollTop: 0
			}, '500');
		});
	},

	F_MOBILE_GO_TOP: function () {
		
		$(document).scroll(function () {
			debug('html scroll');
			if ($("html").scrollTop() > 100) {
				$('#mobile-go-top').css('bottom', '10px')
			} else {
				$('#mobile-go-top').css('bottom', '-80px')
			}
		});

		$("#mobile-go-top").on("click", function () {
			$("html").animate({
				scrollTop: 0
			}, '500');
		});
	},

	F_HEADER_BAR_SHOW_TITLE: function () {
		var position = $("#entry-viewbox").scrollTop();
		$("#entry-viewbox").scroll(function () {
			//debug("$('.entry-census').offset().top = " + $('.entry-census').offset().top);

			// Scroll up
			var scroll = $("#entry-viewbox").scrollTop();
			if (scroll > position) {
				//debug('Scrolling Down Scripts');
				if ($('.entry-census').offset().top < 127) {
					//debug('F_HEADER_BAR_SHOW_TITLE:true');
					$('#header-layer-top').css('top', '-80px');
					$('#header-layer-bottom').css('top', '0');
				} else {
					//debug('F_HEADER_BAR_SHOW_TITLE:false');
					$('#header-layer-top').css('top', '0');
					$('#header-layer-bottom').css('top', '80px');
				}
				//$('#site-footer').removeClass('slideInUp').addClass('slideOutDown');
				//setTimeout("$('#site-footer').css('display','none')",500);
			} else {
				//debug('Scrolling Up Scripts');
				$('#header-layer-top').css('top', '0');
				$('#header-layer-bottom').css('top', '80px');
				//$('#site-footer').removeClass('slideOutDown').addClass('slideInUp');
				//$('#site-footer').css('display','block');
			}
			position = scroll;
		});
		Mashiro.F_Scroll_PROGRESS();
	},

	F_Scroll_PROGRESS: function () {
		$('#entry-viewbox').scroll(function () {
			var scrolled = $('#entry-viewbox').scrollTop() / ($('#entry-container').height() - $('#entry-viewbox').height()) * 100;
			$('#nav-go-top').html('<i class="fa fa-arrow-up" aria-hidden="true"></i> ' + scrolled.toFixed(0) + '%');
		});
	},

	F_PAD_USER_ALERT: function () {
		// r = Marginal ScreenWidth/ScreenHeight
		var r = 1.25,
			h = Math.max($(window).height(), $(window).width()),
			w = Math.min($(window).height(), $(window).width());
		if (GYST && w > Mashiro.SETTINGS.moblie_max_width && w / h < r) {
			GYST.landScape({
				mode: 'landscape'
			});
		}
	},

	F_PAD_TOUCH_FIX: function () {
		var is_touch_device = function () {
			try {
				document.createEvent("TouchEvent");
				return true;
			} catch (e) {
				return false;
			}
		};
		if (is_touch_device()) {
			//$('#touch-device-fit').css('overflow-x', 'auto');
		}
	},

	// Normalize index cover
	F_INDEX_COVER_INI: function () {
		$(window).on('load', function () {
			var cover = {};
			cover.t = $('#cover');
			cover.w = cover.t[0].naturalWidth;
			cover.h = cover.t[0].naturalHeight;

			(cover.o = function () {
				$('#mark').height($(window).height());
				$('#vibrant').height($(window).height());
			})();

			(cover.f = function () {

				var _w = $('#mark').width(),
					_h = $('#mark').height(),
					x, y, i, e;

				e = (_w >= 1000 || _h >= 1000) ? 1000 : 500;

				if (_w >= _h) {
					i = _w / e * 50;
					y = i;
					x = i * _w / _h;
				} else {
					i = _h / e * 50;
					x = i;
					y = i * _h / _w;
				}

				$('#layer').css({
					'width': _w + x,
					'height': _h + y,
					'marginLeft': -0.5 * x,
					'marginTop': -0.5 * y
				})

				$('#cover').css({
					'width': _w + x,
					'height': _h + y,
				})

				if (!cover.w) {
					cover.w = cover.t.width();
					cover.h = cover.t.height();
				}

				(function () {
					var id = $('#cover')[0],
						w = cover.w,
						h = cover.h,
						_height = $(id).parent().height(),
						_width = $(id).parent().width(),
						ratio = h / w;

					if (_height / _width > ratio) {
						id.style.height = _height + 'px';
						id.style.width = _height / ratio + 'px';
					} else {
						id.style.width = _width + 'px';
						id.style.height = _width * ratio + 'px';
					}

					id.style.left = (_width - parseInt(id.style.width)) / 2 + 'px';
					id.style.top = (_height - parseInt(id.style.height)) / 2 + 'px';
				})();

			})();
			var scene = document.getElementById('mark');
			var parallaxInstance = new Parallax(scene);
		});
	},

	F_COVER_COLOR_INI: function () {
		$(window).on('load', function () {
			var vibrant = new Vibrant($('#cover')[0]);
			var swatches = vibrant.swatches()

			if (swatches['DarkVibrant']) {
				$('#vibrant polygon').css('fill', swatches['DarkVibrant'].getHex());
				$('#vibrant div').css('background-color', swatches['DarkVibrant'].getHex());
			}
			if (swatches['Vibrant']) {
				$('#cover-arrow-right').css({
					'color': swatches['DarkVibrant'].getHex(),
					'background': '#fff',
					'opacity': '0.9'
				});
			}
		});
	},

	// horizontal scroll event
	V_HORIZONTAL_SCROLL_VARBLES: {
		has_thumb_list: $('div').hasClass('post-thumb-list'),
		eof_l: $('div').hasClass('post-thumb-list') ? document.querySelector('.post-thumb-item-eof').offsetLeft : null,
		eof_r: 600, // List right offset
		scroll_l: -1,
	},

	F_HORIZONTAL_SCROLL: function () {
		var w = $(window).width();
		var F_TRANSFORM = function (e, x) {
			$(e).css({
				'-webkit-transform': 'translateX(' + x + 'px)',
				'-moz-transform': 'translateX(' + x + 'px)',
				'-ms-transform': 'translateX(' + x + 'px)',
				'-o-transform': 'translateX(' + x + 'px)',
				'transform': 'translateX(' + x + 'px)'
			})
		};

		/*
		 * idea: in some condition, the scroll control function 
		 * stop working while scrolling from right to left at 
		 * the left side of screen. I guess in these condition,
		 * using a (l * scroll_sensitive) controler would be 
		 * better than (l)...
		 */

		if (this.V_HORIZONTAL_SCROLL_VARBLES.has_thumb_list) {
			$('#cover-container').on('mousewheel', function (event) {
				//console.log(event.deltaX, event.deltaY, event.deltaFactor);
				var dx = event.deltaX,
					dy = event.deltaY;
				// scroll controler l = -1 -> 0 (cover go left)
				if (Mashiro.V_HORIZONTAL_SCROLL_VARBLES.scroll_l == -1 && dy < 0) {
					F_TRANSFORM('#main-container', -w);
					Mashiro.V_HORIZONTAL_SCROLL_VARBLES.scroll_l = 0;
				}
			});

			// Click to scroll cover
			$("#cover-arrow-right").on("click", function () {
				F_TRANSFORM('#main-container', -w);
				Mashiro.V_HORIZONTAL_SCROLL_VARBLES.scroll_l = 0;
			});

			$('#post-thumb-list').on('mousewheel', function (event) {
				//console.log(event.deltaX, event.deltaY, event.deltaFactor);
				var dx = event.deltaX,
					dy = event.deltaY;
				// scroll controler l = 0 -> -1 (cover go right)
				if (Mashiro.V_HORIZONTAL_SCROLL_VARBLES.has_thumb_list) {
					if (Mashiro.V_HORIZONTAL_SCROLL_VARBLES.scroll_l == 0 && dy > 0) {
						F_TRANSFORM('#main-container', 0);
						Mashiro.V_HORIZONTAL_SCROLL_VARBLES.scroll_l = -1;
					}
				}
				/* 
				 * TO DO: Scroll with $.scrollLeft()
				 */
				// scroll controler l = 0, scroll list from left to right
				if (Mashiro.V_HORIZONTAL_SCROLL_VARBLES.scroll_l == 0 && dy < 0) {
					Mashiro.V_HORIZONTAL_SCROLL_VARBLES.scroll_l -= dy;
					//F_TRANSFORM('#post-thumb-list', -Mashiro.V_HORIZONTAL_SCROLL_VARBLES.scroll_l * Mashiro.SETTINGS.scroll_sensitive);
					var d = Mashiro.V_HORIZONTAL_SCROLL_VARBLES.scroll_l * Mashiro.SETTINGS.scroll_sensitive;
					//debug(d);
					//$('#horizontal-scroll-container').scrollLeft( d );
					$('#horizontal-scroll-container').animate({
						scrollLeft: d
					}, Mashiro.SETTINGS.scroll_speed);
				}
				// scroll controler l >0, list scroll handler
				if (Mashiro.V_HORIZONTAL_SCROLL_VARBLES.scroll_l > 0) {
					Mashiro.V_HORIZONTAL_SCROLL_VARBLES.scroll_l -= dy;
					if (Mashiro.V_HORIZONTAL_SCROLL_VARBLES.eof_l + Mashiro.V_HORIZONTAL_SCROLL_VARBLES.eof_r - w < Mashiro.V_HORIZONTAL_SCROLL_VARBLES.scroll_l * Mashiro.SETTINGS.scroll_sensitive) {
						Mashiro.V_HORIZONTAL_SCROLL_VARBLES.scroll_l += dy;
					}
					//F_TRANSFORM('#post-thumb-list', -Mashiro.V_HORIZONTAL_SCROLL_VARBLES.scroll_l * Mashiro.SETTINGS.scroll_sensitive);

					var d = Mashiro.V_HORIZONTAL_SCROLL_VARBLES.scroll_l * Mashiro.SETTINGS.scroll_sensitive;
					//debug(d);
					//$('#horizontal-scroll-container').scrollLeft( d );
					$('#horizontal-scroll-container').animate({
						scrollLeft: d
					}, Mashiro.SETTINGS.scroll_speed);
				}
			});
		} else {
			F_TRANSFORM('#main-container', -w);
		}
	},

	F_AJAX_NEXT_THUMB_LIST: function () {
		$('body').on('click', '#pagination a', function () {
			$(this).addClass("loading").text("");
			$.ajax({
				type: "POST",
				url: $(this).attr("href") + "#post-thumb-list",
				success: function (data) {
					result = $(data).find("#post-thumb-list .post-thumb-item");
					nextHref = $(data).find("#pagination a").attr("href");
					//$(".post-thumb-item-eof").remove();
					$("#post-thumb-list").append(result.fadeIn(500));
					$("#pagination a").removeClass("loading").text("Next");
					if (nextHref != undefined) {
						$("#pagination a").attr("href", nextHref);
					} else {
						$("#pagination").html("<span>No more...</span>");
					}
					$('#post-thumb-list').append($('.post-thumb-item-eof'));
					if ($(window).width() > Mashiro.SETTINGS.moblie_max_width) {
						Mashiro.V_HORIZONTAL_SCROLL_VARBLES.eof_l = document.querySelector('.post-thumb-item-eof').offsetLeft;
					}
				}
			});
			return false;
		});
	},

	F_PJAX: function () {
		$(document).pjax('a[target!=_top]', '#page', {
			fragment: '#page',
			timeout: 8000,
			maxCacheLength: Mashiro.SETTINGS.debug ? 20 : 0,
		}).on('pjax:beforeSend', function () {
			//debug('pjax:beforeSend');
		}).on('pjax:send', function () {
			//debug('pjax:send');
			NProgress.start();
		}).on('pjax:complete', function () {
			//debug('pjax:complete');
			Mashiro.F_PJAX_RELOAD();
			NProgress.done();
		}).on('pjax:popstate ', function (event) {
			if (event.direction == "back") {
				//debug('pajx:popstate->back');
				setTimeout(function () {
					Mashiro.F_PJAX_BACK_RELOAD();
				}, 30);
			}
		}).on('submit', '.search-form,.s-search', function (event) {
			//debug('pjax: other condition');
		});
	}


}

Mashiro.F_NORMALIZE();
