class Notify {
	show(message, duration, type) {
		const notification = document.createElement('div');
		notification.className = `notifyed ${type}`;
		notification.innerHTML = message;

		const notiWish = document.getElementById('noti-wish') || Object.assign(document.createElement('div'), { id: 'noti-wish' });
		document.body.appendChild(notiWish);
		notiWish.appendChild(notification);

		setTimeout(() => notiWish.removeChild(notification), duration);
	}
}

const notifier = new Notify();
document.querySelectorAll('.favorite-link').forEach(link => link.addEventListener('click', toggleFavorite));

function toggleFavorite(event) {
	event.preventDefault();
	const productUrl = event.target.closest('a').dataset.url;
	const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
	const index = favorites.indexOf(productUrl);

	index === -1 ? favorites.push(productUrl) : favorites.splice(index, 1);
	const message = index === -1
	? '<div class="title">Thông báo</div><div class="content">Sản phẩm của bạn đã thêm vào danh sách yêu thích.</div>'
	: '<div class="title">Thông báo</div><div class="content">Sản phẩm của bạn đã xóa khỏi sách yêu thích.</div>';
	const type = index === -1 ? 'success' : 'warning';

	notifier.show(message, 3000, type);
	localStorage.setItem('favorites', JSON.stringify(favorites));
	updateWishlist();
}

function updateWishlist() {
	const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
	document.querySelectorAll('.favorite-link').forEach(link => {
		const productUrl = link.dataset.url;
		link.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 25" fill="none"> <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9932 5.44636C9.9938 3.10895 6.65975 2.48019 4.15469 4.62056C1.64964 6.76093 1.29697 10.3395 3.2642 12.8709C4.89982 14.9757 9.84977 19.4146 11.4721 20.8514C11.6536 21.0121 11.7444 21.0925 11.8502 21.1241C11.9426 21.1516 12.0437 21.1516 12.1361 21.1241C12.2419 21.0925 12.3327 21.0121 12.5142 20.8514C14.1365 19.4146 19.0865 14.9757 20.7221 12.8709C22.6893 10.3395 22.3797 6.73842 19.8316 4.62056C17.2835 2.5027 13.9925 3.10895 11.9932 5.44636Z" stroke="#231f20" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </svg>';
		link.setAttribute('title', favorites.includes(productUrl) ? 'Bỏ yêu thích' : 'Thêm vào yêu thích');
		link.classList.toggle('active', favorites.includes(productUrl));
	});
	const wishCount = document.querySelector('.wishlistCount');
	if (wishCount) wishCount.textContent = favorites.length;
}

async function renderWishlist() {
	const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
	const wishlistPage = document.querySelector('.page-wishlist');
	wishlistPage.innerHTML = '';

	if (favorites.length > 0) {
		for (const productUrl of favorites) {
			try {
				const response = await fetch(`${productUrl}?view=wish`);
				if (response.ok) {
					const productView = await response.text();
					wishlistPage.insertAdjacentHTML('beforeend', productView);
				} else {
					console.error('Không thể tải nội dung sản phẩm yêu thích.');
				}
			} catch (error) {
				console.error('Lỗi khi tải nội dung sản phẩm yêu thích:', error);
			}
		}
		resizeImages('.image_thumb');
		lazyLoadImages(theme.settings.lazyload);
		$('.add_to_cart').click(function(e){	
			e.preventDefault();		
			var $this = $(this);
			var form = $this.parents('form');	
			$.ajax({
				type: 'POST',
				url: '/cart/add.js',
				async: false,
				data: form.serialize(),
				dataType: 'json',
				beforeSend: function() { },
				success: function(line_item) {
					ajaxCart.load();
					$('.popup-cart-mobile, .backdrop__body-backdrop___1rvky').addClass('active');
					AddCartMobile(line_item);
				},
				cache: false
			});
		});
		document.querySelectorAll('.btn-compare').forEach(button => button.addEventListener('click', toggleComparison));
		updateCompare();
	} else {
		wishlistPage.innerHTML = '<div class="col-12 col-lg-12"><div class="alert alert-warning alert-dismissible margin-top-15 section" role="alert">Chưa có sản phẩm yêu thích nào, Hãy thêm vào nhé !</div></div>';
	}
}

if (window.location.pathname.includes(theme.settings.urlpage_yeuthich)) {
	renderWishlist();
	document.addEventListener('click', event => {
		const target = event.target.closest('a');
		if (target?.classList.contains('favorite-link')) {
			event.preventDefault();
			const productUrl = target.dataset.url;
			const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
			const index = favorites.indexOf(productUrl);
			index === -1 ? favorites.push(productUrl) : favorites.splice(index, 1);
			localStorage.setItem('favorites', JSON.stringify(favorites));
		renderWishlist();
		updateWishlist();
	}
							  });
}

updateWishlist();