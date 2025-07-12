window.base = window.base || {};
var windowWidth = window.innerWidth;
var isRendered = 0;

function lazyLoadImages(selector) {
	const images = document.querySelectorAll(selector);
	const observer = new IntersectionObserver((entries, observer) => {
		entries.forEach((entry) => {
			if (entry.isIntersecting) {
				const img = entry.target;
				if (img.tagName.toLowerCase() === 'img') {
					img.src = img.getAttribute('data-src');
					img.classList.add('loaded');
				} else {
					img.style.backgroundImage = `url(${img.getAttribute('data-src')})`;
				}
				observer.unobserve(img);
			}
		});
	});

	images.forEach(function(image) {
		observer.observe(image);
	});
}

function autoResizeImages(className) {
	const onResize = () => {
		resizeImages(className);
	};
	window.addEventListener("resize", onResize);
	onResize();
}

function resizeImages(className) {
	const thumbnails = document.querySelectorAll(className);
	if (thumbnails) {
		thumbnails.forEach(function(thumb) {
			thumb.style.height = thumb.offsetWidth + "px";
		});
	}
}

function toggleMenuItem(event) {
	event.preventDefault();
	const parentItem = this.parentElement;
	parentItem.classList.toggle('current');
}

var itemBig = document.querySelector('.item_big_pc');
var navigationHead = document.querySelector('.navigation-head');
var controlMenu = document.querySelector('.control-menu');

if (itemBig && navigationHead) {
	var itemBigWidth = itemBig.offsetWidth;
	var navigationHeadWidth = navigationHead.offsetWidth;
	if (itemBigWidth > navigationHeadWidth) {
		controlMenu.classList.add('show');
	} else {
		controlMenu.classList.remove('show');
	}
}

function scrollMenu(idPrev, idNext, element) {
	const prevButton = document.getElementById(idPrev);
	const nextButton = document.getElementById(idNext);
	const content = document.querySelector(element);
	let marginLeft = 0;

	const animateMargin = (amount) => {
		marginLeft = Math.min(0, Math.max(getMaxMargin(), marginLeft + amount));
		content.style.marginLeft = `${marginLeft}px`;
	};

	const getMaxMargin = () => content.parentElement.offsetWidth - content.scrollWidth;

	if (prevButton !== null && nextButton !== null) {
		prevButton.addEventListener('click', function(e) {
			e.preventDefault();
			animateMargin(190);
		});

		nextButton.addEventListener('click', function(e) {
			e.preventDefault();
			animateMargin(-190);
		});
	}
}

function renderLayout(){
	if (isRendered) return;
	isRendered = 1;

	window.addEventListener('scroll', function() {
		if (window.scrollY > 200) {
			document.querySelector('.backtop').classList.add('show');
		} else {
			document.querySelector('.backtop').classList.remove('show');
		}
	});

	document.querySelector('.backtop').addEventListener('click', function(event) {
		event.preventDefault();
		scrollToTop(800);
	});

	function scrollToTop(duration) {
		const scrollStep = -window.scrollY / (duration / 15);
		const scrollInterval = setInterval(function() {
			if (window.scrollY !== 0) {
				window.scrollBy(0, scrollStep);
			} else {
				clearInterval(scrollInterval);
			}
		}, 15);
	}

	lazyLoadImages(theme.settings.lazyload);

	document.querySelectorAll('.icon-down').forEach(function(iconElement) {
		iconElement.addEventListener('click', toggleMenuItem);
	});

	scrollMenu('prevNav', 'nextNav', 'ul.item_big');


	if (windowWidth < 991) {
		var filterButtons = document.querySelectorAll('.open-filters');
		var categoryNavs = document.querySelectorAll('.menu-bar');
		var backdrop = document.querySelector('.backdrop__body-backdrop___1rvky');
		var colSidebar = document.querySelector('.col-sidebar');
		var navigationHead = document.querySelector('.navigation-head');

		filterButtons.forEach(function(el) {
			el.addEventListener('click', function() {
				this.classList.toggle('show');
				colSidebar.classList.toggle('show');
				backdrop.classList.toggle('active');
			});
		});

		categoryNavs.forEach(function(el) {
			el.addEventListener('click', function() {
				navigationHead.classList.add('show');
				backdrop.classList.add('active');
			});
		});

		document.addEventListener('click', function(event) {
			if (event.target === backdrop) {
				navigationHead.classList.remove('show');
				colSidebar.classList.remove('show');
				document.querySelector('.open-filters').classList.remove('show');
				backdrop.classList.remove('active');
			}
		});


	}

	if (windowWidth < 767) {
		function toggleCurrentClass(event) {
			var target = event.target;
			if (target.classList.contains('title-footer')) {
				target.classList.toggle('current');
				var ulElement = target.nextElementSibling;
				if (ulElement && ulElement.classList.contains('list-menu')) {
					ulElement.classList.toggle('current');
				}
			}
		}
		var footerTitles = document.querySelectorAll('.title-footer');

		footerTitles.forEach(function(element) {
			element.addEventListener('click', toggleCurrentClass);
		});
	}
}
var images = document.querySelectorAll('img[loading="lazy"]');
images.forEach(function(image) {
	image.removeAttribute('loading');
});
document.addEventListener("DOMContentLoaded", function() {
	window.addEventListener("mousemove", renderLayout, { once: true });
	window.addEventListener("touchstart", renderLayout, { once: true });
	window.addEventListener("load", renderLayout, { once: true });
	onScroll();
});

var menuItems = document.querySelectorAll('.nav-cate .menu-item-count.dropdown > a');
menuItems.forEach(function(item) {
	item.addEventListener('click', function() {
		var allMenuItems = document.querySelectorAll('.menu-item-count');
		allMenuItems.forEach(function(menuItem) {
			menuItem.classList.remove('active');
		});
		this.closest('.menu-item-count').classList.add('active');
	});
});



document.addEventListener("scroll", (function() {
	onScroll();
}))

Element.prototype.isInViewport = function() {
	var rect = this.getBoundingClientRect();
	var viewportHeight = window.innerHeight || document.documentElement.clientHeight;
	var viewportWidth = window.innerWidth || document.documentElement.clientWidth;
	var elementHeight = rect.height;
	var elementWidth = rect.width;

	var heightVisible = Math.min(rect.bottom, viewportHeight) - Math.max(rect.top, 0);
	var widthVisible = Math.min(rect.right, viewportWidth) - Math.max(rect.left, 0);

	var areaVisible = heightVisible * widthVisible;
	var areaTotal = elementHeight * elementWidth;

	var visibilityRatio = areaVisible / areaTotal;

	return visibilityRatio >= 0.4;
};

function onScroll() {
	var items = document.querySelectorAll(".item-effect");
	items.forEach(function(item) {
		if (item.isInViewport()) {
			item.classList.add("on-show");
		}
	});
}

window.addEventListener('scroll', onScroll);

window.addEventListener('load', onScroll);

window.addEventListener('keydown', function(event) {
	if (event.key === 'Escape') {
		event.preventDefault();
		var closePopupElements = document.querySelectorAll(".close-popup");
		closePopupElements.forEach(function(element) {
			element.click();
		});
	}
});

const videoPlayElements = document.querySelectorAll('.video_play');
const popupVideoElement = document.querySelector('.popup-video');
const popupVideoBodyElement = document.querySelector('.popup-video .body-popup');
const closePopupVideoElement = document.querySelector('.close-popup-video');

videoPlayElements.forEach(videoPlayElement => {
	videoPlayElement.addEventListener('click', (event) => {
		const idVideo = videoPlayElement.dataset.video;  // Using dataset property
		popupVideoElement.classList.add('active');
		popupVideoBodyElement.innerHTML = `
<iframe width="560" height="315" src="https://www.youtube.com/embed/${idVideo}" 
title="YouTube video player" frameborder="0" 
allow="accelerometer; autoplay; clipboard-write;   
encrypted-media; gyroscope; picture-in-picture; web-share" 
allowfullscreen></iframe>`;   

	});
});

closePopupVideoElement.addEventListener('click', (event) => {
	popupVideoElement.classList.remove('active');
	popupVideoBodyElement.innerHTML = '';  
});

function setupSwatchHover() {
	const productActions = document.querySelectorAll('.product-action');

	productActions.forEach(productAction => {
		const swatches = productAction.querySelectorAll('.product-swatchs .item-swatch');
		const imageThumbnails = productAction.querySelectorAll('.thumb img'); // Lấy tất cả img thumbnail

		swatches.forEach(swatch => {
			swatch.addEventListener('mouseenter', function() {
				const dataImage = this.getAttribute('data-image');
				if (dataImage) {
					imageThumbnails.forEach(img => img.src = dataImage); // Đổi src cho tất cả img thumbnail
				}
				swatches.forEach(s => s.classList.remove('active')); // Xóa lớp active khỏi tất cả swatch
				this.classList.add('active');
			});
		});
	});
}

// Gọi hàm khi cần thiết
setupSwatchHover();