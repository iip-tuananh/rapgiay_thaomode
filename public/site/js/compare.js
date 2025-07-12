class Notification {
	show(message, duration, type) {
		const notification = document.createElement('div');
		notification.className = `notifyed ${type}`;
		notification.innerHTML = message;

		const notificationContainer = document.getElementById('notification-container') || Object.assign(document.createElement('div'), { id: 'notification-container' });
		document.body.appendChild(notificationContainer);
		notificationContainer.appendChild(notification);

		setTimeout(() => notificationContainer.removeChild(notification), duration);
	}
}

const notifier2 = new Notification();
document.querySelectorAll('.btn-compare').forEach(button => button.addEventListener('click', toggleComparison));

document.addEventListener('DOMContentLoaded', () => {
	updateCompare(); // Cập nhật giao diện khi trang được tải lại
	const popupCompare = document.querySelector('.popup-compare');
	if (popupCompare) {
		popupCompare.classList.remove('show');
	}

});
function toggleComparison(event) {
	event.preventDefault();

	const productUrl = event.target.closest('a').dataset.url;
	const productImg = event.target.closest('a').dataset.img;
	const productName = event.target.closest('a').dataset.name;
	const productType = event.target.closest('a').dataset.type;

	const comparisonList = JSON.parse(localStorage.getItem('comparisonList')) || [];
	const productInfo = JSON.parse(localStorage.getItem('productInfo')) || {};

	const index = comparisonList.indexOf(productUrl);

	if (index === -1) {
		if (comparisonList.length > 0) {
			const existingProductType = productInfo[comparisonList[0]].type;
			if (productType !== existingProductType) {
				notifier2.show('<div class="title">Thông báo</div><div class="content">Bạn chỉ có thể so sánh các sản phẩm cùng loại.</div>', 3000, 'error');
				return;
			}
		}

		if (comparisonList.length >= 3) {
			notifier2.show('<div class="title">Thông báo</div><div class="content">Bạn chỉ có thể so sánh tối đa 3 sản phẩm.</div>', 3000, 'error');
			return;
		}

		comparisonList.push(productUrl);
		productInfo[productUrl] = { img: productImg, name: productName, type: productType };
		notifier2.show('<div class="title">Thông báo</div><div class="content">Sản phẩm đã được thêm vào danh sách so sánh.</div>', 3000, 'success');
	} else {
		comparisonList.splice(index, 1);
		delete productInfo[productUrl];
		notifier2.show('<div class="title">Thông báo</div><div class="content">Sản phẩm đã bị xóa khỏi danh sách so sánh.</div>', 3000, 'warning');
	}

	localStorage.setItem('comparisonList', JSON.stringify(comparisonList));
	localStorage.setItem('productInfo', JSON.stringify(productInfo));
	updateCompare();
}

function updateCompare() {
	const comparisonList = JSON.parse(localStorage.getItem('comparisonList')) || [];
	const productInfo = JSON.parse(localStorage.getItem('productInfo')) || {};

	document.querySelectorAll('.btn-compare').forEach(button => {
		const productUrl = button.dataset.url;

		const isActive = comparisonList.includes(productUrl);

		button.setAttribute('title', isActive ? 'Xóa khỏi so sánh' : 'Thêm vào so sánh');
		button.classList.toggle('active', isActive);
	});

	const comparisonCount = document.querySelector('.comparison-count');
	if (comparisonCount) comparisonCount.textContent = comparisonList.length;

	const popupCompare = document.querySelector('.popup-compare');
	if (popupCompare) {
		popupCompare.classList.toggle('show', comparisonList.length > 0);
	}


	const listCompare = document.getElementById('list-compare');

	if (listCompare) {
		let htmlContent = '';
		const maxItemsToShow = 3;
		const comparisonListLength = comparisonList.length;

		for (let i = 0; i < maxItemsToShow; i++) {
			if (i < comparisonListLength) {
				const productUrl = comparisonList[i];
				const product = productInfo[productUrl] || {};
				const imgSrc = product.img; 
				const productName = product.name; 

				htmlContent += `
<div class="compare-item">
<div class="compare-thumb">
<a href="${productUrl}">
<img src="${imgSrc}" alt="${productName}">
</a>
</div>
<div class="compare-info">
<h3><a href="${productUrl}">${productName}</a></h3>
</div>
<button class="remove-compare" data-url="${productUrl}"></button>
</div>
`;
			} else {
				htmlContent += `
<div class="compare-item default-item">
<a href="javascript:" class="addCompare">
<span class="add-icon">+</span>
<p>Thêm sản phẩm</p>
</a>
</div>
`;
			}
		}

		listCompare.innerHTML = htmlContent;
	}

	// Handle compare-fixed div
	let compareFixed = document.querySelector('.compare-fixed');

	if (comparisonList.length > 0) {
		if (!compareFixed) {
			// Create the compare-fixed div if it doesn't exist
			compareFixed = document.createElement('div');
			compareFixed.className = 'compare-fixed';
			compareFixed.innerHTML = `
<span class="fixed-count">${comparisonList.length}</span> 
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
<path d="M2315 5109 c-800 -83 -1501 -518 -1927 -1196 -604 -961 -490 -2237 274 -3068 425 -462 951 -737 1583 -827 119 -17 512 -16 635 1 622 86 1148 360 1572 820 349 378 572 862 650 1406 17 118 17 512 0 630 -59 416 -191 769 -410 1099 -92 140 -185 254 -315 385 -399 404 -893 653 -1462 737 -123 18 -478 26 -600 13z m-378 -1440 c45 -17 611 -585 635 -638 35 -76 4 -171 -70 -214 -39 -23 -125 -27 -162 -7 -14 7 -85 71 -157 143 l-133 131 0 -729 c-1 -402 -5 -750 -9 -774 -21 -105 -123 -165 -224 -132 -45 15 -93 68 -106 118 -7 25 -11 295 -11 783 l-1 745 -127 -132 c-154 -160 -199 -185 -283 -163 -88 24 -138 103 -125 195 7 44 18 58 159 204 230 236 461 459 488 470 33 13 92 13 126 0z m1376 -3 c42 -17 83 -66 97 -114 6 -24 10 -300 10 -781 l0 -744 116 122 c151 158 211 193 294 171 107 -29 157 -136 111 -235 -23 -49 -593 -619 -634 -635 -40 -14 -94 -12 -131 5 -17 8 -165 149 -328 313 -248 248 -298 304 -308 339 -22 74 11 157 78 196 39 23 125 27 162 7 14 -7 84 -71 157 -143 l132 -130 3 759 c3 828 0 786 60 841 46 43 120 55 181 29z"/>
</g>
</svg>
`;
			document.body.appendChild(compareFixed);
			compareFixed.addEventListener('click', () => {
				const popupCompare = document.querySelector('.popup-compare');
				if (popupCompare) {
					popupCompare.classList.toggle('show');
				}
			});
		} else {
			compareFixed.querySelector('.fixed-count').textContent = comparisonList.length;
		}
	} else if (compareFixed) {
		document.body.removeChild(compareFixed);
	}

	document.querySelectorAll('.remove-compare').forEach(button => {
		button.addEventListener('click', (event) => {
			const productUrl = event.target.dataset.url;
			removeProductFromComparison(productUrl);
		});
	});
}

document.addEventListener('click', function(event) {
	if (event.target.closest('.list-compare .compare-item .addCompare')) {
		let target = event.target.closest('.list-compare .compare-item .addCompare');

		if (target) {
			let comparisonList = JSON.parse(localStorage.getItem('comparisonList')) || [];
			let productInfo = JSON.parse(localStorage.getItem('productInfo')) || {};

			let typeCom = comparisonList.length > 0 ? productInfo[comparisonList[0]]?.type : null;
			let url = typeCom ? `/search?q=product_type.filter_key:("${typeCom}")&view=type-compare` : '';

			if (url) {
			fetch(url, { method: 'GET' })
				.then(response => response.text())
					.then(data => {
					let popup = document.querySelector('.popup-search-compare');
					if (popup) {
						popup.innerHTML = data;
						popup.classList.add('show');
					}

					let backdrop = document.querySelector('.backdrop__body-backdrop___1rvky');
					if (backdrop) {
						backdrop.classList.add('active');
					}

					resizeImages('.image_thumb');
					lazyLoadImages(theme.settings.lazyload);

					document.querySelectorAll('.btn-compare').forEach(button => {
						button.addEventListener('click', toggleComparison);
					});

					updateCompare();
				})
					.catch(error => {
					console.error('Lỗi trong quá trình tải dữ liệu:', error);
				});
	} else {
		console.warn('Không có loại sản phẩm để so sánh.');
	}
}
						  }
						  });

function searchProducts() {
	var input = document.querySelector('#searchCompare').value;

	let comparisonList = JSON.parse(localStorage.getItem('comparisonList')) || [];

	var typeCom = comparisonList.find(item => item.type)?.type;

	var minLength = input.length >= 3;

	if (minLength) {
	var url = '/search?query=' + encodeURIComponent(input) + '&product_type.filter_key=("'+typeCom+'")&view=filter-compare';
	fetch(url, { method: 'GET' })
		.then(response => response.text())
			.then(data => {
			var resultCompare = document.querySelector('#result-compare');
			if (resultCompare) {
				resultCompare.innerHTML = data;
			}

			resizeImages('.image_thumb');
			lazyLoadImages(theme.settings.lazyload);

			document.querySelectorAll('.btn-compare').forEach(button => {
				button.addEventListener('click', toggleComparison);
			});

			updateCompare();
		})
			.catch(error => {
			console.error('Yêu cầu thất bại: ' + error.message);
		});
} else {
	var resultCompare = document.querySelector('#result-compare');
	if (resultCompare) {
		resultCompare.innerHTML = input.length > 0 ? '<p>Đang tìm kiếm...</p>' : '';
	}
}
}

function removeProductFromComparison(productUrl) {
	const comparisonList = JSON.parse(localStorage.getItem('comparisonList')) || [];
	const productInfo = JSON.parse(localStorage.getItem('productInfo')) || {};

	const index = comparisonList.indexOf(productUrl);
	if (index !== -1) {
		comparisonList.splice(index, 1);
		delete productInfo[productUrl];

		localStorage.setItem('comparisonList', JSON.stringify(comparisonList));
		localStorage.setItem('productInfo', JSON.stringify(productInfo));

		notifier2.show('<div class="title">Thông báo</div><div class="content">Sản phẩm đã bị xóa khỏi danh sách so sánh.</div>', 3000, 'warning');

		updateCompare(); 
	}
}

function removeAllCompare() {
	localStorage.removeItem('comparisonList');
	localStorage.removeItem('productInfo');

	notifier2.show('<div class="title">Thông báo</div><div class="content">Danh sách so sánh đã được xóa.</div>', 3000, 'warning');

	updateCompare(); 
}

function collapseCompare() {
	const popupCompare = document.querySelector('.popup-compare');
	if (popupCompare) {
		popupCompare.classList.remove('show');
	}
}

async function renderComparisonList() {
	const comparisonList = JSON.parse(localStorage.getItem('comparisonList')) || [];
	const comparisonPage = document.querySelector('.page-comparison');
	comparisonPage.innerHTML = '';

	if (comparisonList.length > 0) {
		for (const productUrl of comparisonList) {
			try {
				const response = await fetch(`${productUrl}?view=compare`);
				if (response.ok) {
					const productView = await response.text();
					comparisonPage.insertAdjacentHTML('beforeend', productView);
				} else {
					console.error('Unable to load product comparison content.');
				}
			} catch (error) {
				console.error('Error loading product comparison content:', error);
			}
		}
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
		setupSwatchHover();
	} else {
		comparisonPage.innerHTML = '<div class="col-12 col-lg-12"><div class="alert alert-warning alert-dismissible margin-top-15 section" role="alert">Không có sản phẩm nào trong danh sách so sánh.</div></div>';
	}
}

if (window.location.pathname.includes(theme.settings.urlpage_comparison)) {
	renderComparisonList();
	document.addEventListener('click', event => {
		const target = event.target.closest('a');
		if (target?.classList.contains('btn-compare')) {
			event.preventDefault();
			const productUrl = target.dataset.url;
			const comparisonList = JSON.parse(localStorage.getItem('comparisonList')) || [];
			const index = comparisonList.indexOf(productUrl);
			if (index === -1) {
			comparisonList.push(productUrl);
			} else {
			comparisonList.splice(index, 1);
			}
			localStorage.setItem('comparisonList', JSON.stringify(comparisonList));
			renderComparisonList();
			updateCompare();
			}
			});
			}

			updateCompare();