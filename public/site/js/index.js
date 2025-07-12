document.querySelectorAll(".ajax-tab").forEach(function(tabElement) {
	var section = tabElement.closest('.ajax-tab').getAttribute('data-section');
	tabElement.querySelector('.tab-content-item').classList.add('active');
	var view = tabElement.closest('.ajax-tab').getAttribute('data-view');
	tabElement.querySelectorAll('.item-tab').forEach(function(tab) {
		tab.addEventListener('click', function() {
			var tabId = this.getAttribute('data-tab'),
				url = this.getAttribute('data-url'),
				tabsContainer = this.closest('.ajax-tab');
			tabsContainer.querySelectorAll('.item-tab, .tab-content-item').forEach(function(element) {
				element.classList.remove('active');
			});
			this.classList.add('active');
			tabsContainer.querySelector("." + tabId).classList.add('active');
			if (!this.classList.contains('has-item')) {
				this.classList.add('has-item');
				getContentTab(url, "." + section + " ." + tabId, view);
			}
		});
	});
});
function getContentTab(url, selector, view) {
	switch (view) {
		case 'view_tab_1':
			url += "?view=datatab";
			break;
		case 'view_tab_2':
			url += "?view=datatab2";
			break;
		case 'view_tab_3':
			url += "?view=datatab3";
			break;
	}
	var fill = document.querySelector(selector);
	fetch(url)
		.then(response => {
		if (!response.ok) {
			throw new Error('Network response was not ok');
		}
		return response.text();
	})
		.then(data => {
		var content = document.createElement('div');
		content.innerHTML = data;
		setTimeout(function() {
			fill.querySelector('.fill-content').innerHTML = content.innerHTML;
			resizeImages('.image_thumb');
			lazyLoadImages(theme.settings.lazyload);
			document.querySelectorAll('.add_to_cart').forEach(function(button) {
				button.addEventListener('click', function(e) {
					e.preventDefault();
					var form = button.closest('form');
					var formData = new FormData(form);
					var data = new URLSearchParams(formData).toString();

					fetch('/cart/add.js', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded'
						},
						body: data
					})
						.then(response => response.json())
						.then(lineItem => {
						ajaxCart.load();
						if (window.innerWidth <= 767){
							document.querySelectorAll('.popup-cart-mobile, .backdrop__body-backdrop___1rvky').forEach(function(el) {
								el.classList.add('active');
							});
						} else {
							document.querySelectorAll('.popup-cart-desktop, .backdrop__body-backdrop___1rvky').forEach(function(el) {
								el.classList.add('active');
							});
						}

						AddCartMobile(lineItem);
					})
						.catch(error => {
						console.error('Error:', error);
					});
				});
			});
			document.querySelectorAll('.favorite-link').forEach(link => link.addEventListener('click', toggleFavorite));
			document.querySelectorAll('.btn-compare').forEach(button => button.addEventListener('click', toggleComparison));
			setupSwatchHover();
		}, 50);
	})
		.catch(error => {
		console.error('There has been a problem with your fetch operation:', error);
	});
}