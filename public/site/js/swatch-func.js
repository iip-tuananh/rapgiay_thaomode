document.addEventListener('DOMContentLoaded', function() {
	setTimeout(function() {
		if (theme.settings.productSize > 0) SwatchGrid();
	}, 1000);
});


function SwatchGrid() {
	
	document.querySelectorAll('.detail-grid').forEach(function(grid) {
		var Form = grid;
		var dataid = Form.getAttribute('data-id-product');
		var dataurl = Form.getAttribute('data-url');

		var FormCallback = function(variant, selector) {
			if (variant) {
				var form = Form;
				if (theme.settings.swatch) {
					var form = Form.querySelector('#' + selector.domIdPrefix).closest('form');
					if (variant) {
						for (var i = 0, length = variant.options.length; i < length; i++) {
							var optionValue = variant.options[i];
							var radioButtonGroup = form.querySelector('.swatch[data-option-index="' + i + '"]');
							var radioButtons = radioButtonGroup.querySelectorAll('[type="radio"]');
							var radioButton = Array.from(radioButtons).find(function (radio) {
								return radio.value === optionValue;
							});

							if (radioButton) {
								radioButton.checked = true;
							}
						}
					}
				} 
			}

			var addToCart = Form.querySelector('.btn_buy.addcart');
			var btnNow = Form.querySelector('.btn-buy-now');
			var former = Form.querySelector('.action-cart');
			var saleLabel = Form.querySelector('.product-image');
			var productPrice = Form.querySelector('.price');
			var comparePrice = Form.querySelector('.compare-price');
			var addNowText = 'Mua ngay';
			var addOneText = 'Thêm vào giỏ hàng';

			if (variant && variant.available) {
				saleLabel.classList.remove('sale');
				former.classList.remove('d-none');
				btnNow.removeAttribute('disabled');
				btnNow.classList.remove('d-none');
				addToCart.innerHTML = addOneText;
				addToCart.removeAttribute('disabled');

				if (variant.price === 0) {
					productPrice.innerHTML = 'Liên hệ';
					comparePrice.style.display = 'none';
					former.classList.add('d-none');
				} else {
					former.classList.remove('d-none');
					productPrice.innerHTML = Bizweb.formatMoney(variant.price, theme.settings.moneyFormat);
					addToCart.innerHTML = addOneText;

					if (variant.compare_at_price > variant.price) {
						comparePrice.innerHTML = Bizweb.formatMoney(variant.compare_at_price, theme.settings.moneyFormat);
						comparePrice.style.display = 'inline-block';
						var discount = Math.ceil((variant.compare_at_price - variant.price) / variant.compare_at_price * 100);
						if (discount > 99) {
							var pt = 99;
						} else {
							var pt = discount;
						}
						saleLabel.classList.add('sale');
						saleLabel.setAttribute('data-sale', 'Giảm ' + pt + '%');
					} else {
						comparePrice.style.display = 'none';
					}
				}
			} else {
				saleLabel.classList.remove('sale');
				btnNow.setAttribute('disabled', 'disabled');
				btnNow.classList.add('d-none');
				addToCart.innerHTML = 'Hết hàng';
				addToCart.setAttribute('disabled', 'disabled');
				former.classList.add('d-none');
				if (variant) {
					if (variant.price !== 0) {
						former.classList.remove('d-none');
						btnNow.setAttribute('disabled', 'disabled');
						btnNow.classList.add('d-none');
						productPrice.innerHTML = Bizweb.formatMoney(variant.price, theme.settings.moneyFormat);

						if (variant.compare_at_price > variant.price) {
							comparePrice.innerHTML = Bizweb.formatMoney(variant.compare_at_price, theme.settings.moneyFormat);
							comparePrice.style.display = 'inline-block';
							var discount = Math.ceil((variant.compare_at_price - variant.price) / variant.compare_at_price * 100);
							if (discount > 99) {
								var pt = 99;
							} else {
								var pt = discount;
							}
							saleLabel.classList.add('sale');
							saleLabel.setAttribute('data-sale', 'Giảm ' + pt + '%');
						} else {
							comparePrice.style.display = 'none';
						}
					} else {
						productPrice.innerHTML = 'Liên hệ';
						comparePrice.style.display = 'none';
						former.classList.add('d-none');
					}
				} else {
					productPrice.innerHTML = 'Liên hệ';
					comparePrice.style.display = 'none';
					former.classList.add('d-none');
				}
			}
			getQueryResult(variant.id);

		};

		function getQueryResult(id) {
			var select = document.getElementById('product-grid-selectors-' + dataid);
			var selectedOption = select.querySelector('option[value="' + id + '"]');

			var imgVariant = selectedOption.getAttribute('data-image');

			var swiper = new Swiper(Form.querySelector('.swiper-container'), {
				pagination: {
					el: Form.querySelector('.swiper-pagination'),
					clickable: true,
				},
			});

			var slideToIndex = -1;

			Form.querySelectorAll('.product-image .swiper-slide').forEach(function(el, index){
				var imgThis = el.querySelector('img').getAttribute('src'); 
				if(imgVariant.split("?")[0] == imgThis.split("?")[0]) {
					var pst = el.dataset.hash;
					slideToIndex = pst;
				}
			});
			if (slideToIndex !== -1) {
				swiper.slideTo(slideToIndex, 1000, false);
			}
		}

		function changeSwatch() {
			if (Form.querySelectorAll('.selector-wrapper').length <= 1 && dataurl != '') {
				async function GetApiProduct(url) {
					const response = await fetch(url);
					var productJson = await response.json();
					if (response) {}
					callBackProduct(productJson);
				}
				GetApiProduct('/products'+dataurl+ '.json');
				function callBackProduct(productJson) {
					new Bizweb.OptionSelectors('product-grid-selectors-' + dataid, {
						product: productJson,
						onVariantSelected: FormCallback, 
						enableHistoryState: true
					});  
				}
			}
		}

		if (theme.settings.swatch) {
			Form.querySelectorAll('.swatch input[type="radio"]').forEach(function(radio) {
				radio.addEventListener('change', function() {
					changeSwatch();
					var optionIndexs = this.closest('.swatch').getAttribute('data-option-index');
					var optionValues = this.value;
					this.closest('form').querySelectorAll('.single-option-selector')[optionIndexs].value = optionValues;
					this.closest('form').querySelectorAll('.single-option-selector')[optionIndexs].dispatchEvent(new Event('change'));
				});
			});
		} else {
			changeSwatch();
			var variantOptions = Form.querySelector('#product-grid-selectors-' + dataid);
			if (variantOptions) {
				variantOptions.addEventListener('change', function() {
					changeSwatch();
				});
			}
		}

		document.querySelectorAll('.add_to_cart').forEach(function(button) {
			button.addEventListener('click', addToCartWithAnimation);
		});
		document.querySelectorAll('.add_to_cart_fast').forEach(function(button) {
			button.addEventListener('click', addToCartAndCheckout);  
		});


	});

}