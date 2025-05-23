!(function (t) {
	const e = {
			message: null,
			overlayCSS: { background: '#fff', opacity: 0.6, cursor: 'wait' },
			fadeIn: 10,
			fadeOut: 400,
			showOverlay: !1,
		},
		a = {
			message: null,
			overlayCSS: { background: '#fff', opacity: 1, cursor: 'wait' },
			fadeIn: 10,
			fadeOut: 100,
			showOverlay: !1,
		};
	(t.fn.flatsomeVariationImages = function () {
		return this.each(function () {
			const i = t(this);
			if (i.hasClass('ux-variation-images-js-attached')) return;
			const o = i.closest('.product'),
				n = jQuery('.product-gallery-slider', o),
				r = jQuery('.product-thumbnails', o);
			let l = 0,
				s = !1,
				d = {};
			const c = t.Deferred(),
				f = t.Deferred();
			n.one('flatsome-flickity-ready', () => c.resolve()),
				r.one('flatsome-flickity-ready', () => f.resolve()),
				(r.length && !r.is(':hidden')) || f.resolve();
			const u = t.when(c, f).then(() => {
				var t;
				(t = o),
					s ||
						((d[0] = {
							promise: null,
							data: {
								uniqueMainImage: !0,
								images: t.find(
									'.product-gallery-slider .flickity-slider > *',
								),
								thumbs: t.find(
									'.product-thumbnails .flickity-slider > *',
								),
							},
						}),
						(s = !0)),
					n.on('select.flickity', (t, e) => {
						l = e;
					}),
					i.on('click', '.reset_variations', () => {
						m(0);
					}),
					i.on('hide_variation', () => {
						m(0);
					});
			});
			function m(i = 0) {
				if (!o.length) return;
				let n = o.attr('data-gallery-variation-id');
				if (
					('undefined' === n &&
						((n = 0), o.attr('data-gallery-variation-id', n)),
					parseInt(n) === i)
				)
					return;
				if ((o.attr('data-gallery-variation-id', i), 0 === i))
					return (
						g(d[i]),
						void r.removeClass(
							'ux-additional-variation-images-thumbs-placeholder--visible',
						)
					);
				const l = (function (i, n) {
					const r = t.Deferred(() => {
						o.find('.product-gallery-slider').block(e),
							o
								.find(
									'.product-thumbnails, .vertical-thumbnails',
								)
								.block(a);
					});
					if (d[i] && 'resolved' === d[i].promise.state())
						return r.resolve(i, d[i].data);
					if (!d[i] || 'rejected' === d[i].promise.state()) {
						const e = (function (e) {
							return t.post(flatsomeVars.ajaxurl, {
								action: 'flatsome_additional_variation_images_load_images_ajax_frontend',
								variation_id: e,
							});
						})(i);
						d[i] = { promise: e, data: null };
					}
					return (
						t.when(d[i].promise).then(
							(t) => {
								(d[i].data = t.data || null),
									r.resolve(i, d[i].data);
							},
							() => {
								r.reject();
							},
						),
						r.promise()
					);
				})(i);
				l.then(() => {
					g(d[i]);
				}),
					l.always(() => {
						o.find('.product-gallery-slider').unblock(),
							o
								.find(
									'.product-thumbnails, .vertical-thumbnails',
								)
								.unblock();
					});
			}
			function g({ data: { uniqueMainImage: e, images: a, thumbs: i } }) {
				!e && a.slice(1).length < 1
					? m(0)
					: (n.find('.flickity-page-dots').fadeToggle(10),
					  n.flickity(
							'remove',
							n.find('.flickity-slider > *:not(:first)'),
					  ),
					  t.each(a.slice(1), (e, a) => {
							n.flickity('append', t(a));
					  }),
					  r.data('flickity') &&
							(r.flickity(
								'remove',
								r.find('.flickity-slider > *:not(:first)'),
							),
							t.each(i.slice(1), (e, a) => {
								r.flickity('append', t(a));
							}),
							r.toggleClass(
								'ux-additional-variation-images-thumbs-placeholder--visible',
								i.slice(1).length > 0 &&
									r.hasClass(
										'ux-additional-variation-images-thumbs-placeholder',
									),
							)),
					  o.imagesLoaded(() => {
							l <= a.length - 1
								? n.flickity('select', l)
								: n.flickity('select', 0),
								i.length > 4
									? r.removeClass('slider-no-arrows')
									: r.addClass('slider-no-arrows'),
								n.find('.flickity-page-dots').fadeToggle(400),
								jQuery(document).trigger(
									'flatsome-product-gallery-tools-init',
								),
								'undefined' != typeof PhotoSwipe &&
									'undefined' !=
										typeof wc_single_product_params &&
									t('.woocommerce-product-gallery')
										.off('click')
										.off('click.flatsome')
										.on(
											'click.flatsome',
											'.woocommerce-product-gallery__image a',
											p,
										);
					  }));
			}
			function p(e) {
				e.preventDefault();
				const a = t('.pswp')[0],
					i = (function () {
						const e = n.find('.flickity-slider > *');
						let a = [];
						return (
							e.length > 0 &&
								e.each(function (e, i) {
									var o = t(i).find('img');
									if (o.length) {
										const t = o.attr('data-large_image'),
											e = o.attr(
												'data-large_image_width',
											),
											i = o.attr(
												'data-large_image_height',
											),
											n = {
												alt: o.attr('alt'),
												src: t,
												w: e,
												h: i,
												title: o.attr('data-caption')
													? o.attr('data-caption')
													: o.attr('title'),
											};
										a.push(n);
									}
								}),
							a
						);
					})(),
					o = t(e.target);
				let r;
				r =
					o.is('.woocommerce-product-gallery__trigger') ||
					o.is('.woocommerce-product-gallery__trigger img')
						? this.$target.find('.flex-active-slide')
						: o.closest('.woocommerce-product-gallery__image');
				const l = t.extend(
					{
						index: t(r).index(),
						addCaptionHTMLFn: function (t, e) {
							return t.title
								? ((e.children[0].textContent = t.title), !0)
								: ((e.children[0].textContent = ''), !1);
						},
					},
					wc_single_product_params.photoswipe_options,
				);
				new PhotoSwipe(a, PhotoSwipeUI_Default, i, l).init();
			}
			i.on('found_variation', (e, a) => {
				'resolved' !== u.state()
					? t.when(u).done(() => {
							m(parseInt(a.variation_id));
					  })
					: m(parseInt(a.variation_id));
			}),
				i.addClass('ux-variation-images-js-attached');
		});
	}),
		t(function () {
			const e = '.variations_form';
			t(e).flatsomeVariationImages(),
				t(document).on('wc_variation_form', function () {
					t(e).flatsomeVariationImages();
				}),
				t(document).ajaxComplete(function () {
					setTimeout(() => {
						t(e).flatsomeVariationImages();
					}, 100);
				});
		});
})(jQuery);
