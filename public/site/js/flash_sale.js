function FlashSale() {
	if (!window.falshSale) return;

	// Extend Date prototype
	Date.prototype.addDays = function(days) {
		const date = new Date(this.valueOf());
		date.setDate(date.getDate() + days);
		return date;
	};

	Date.prototype.addHours = function(hours) {
		this.setTime(this.getTime() + (hours * 60 * 60 * 1000));
		return this;
	};

	// Utility functions
	const getDays = (times) => Math.floor(times / (1000 * 60 * 60 * 24));
	const getHours = (times) => Math.floor((times % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	const getMinutes = (times) => Math.floor((times % (1000 * 60 * 60)) / (1000 * 60));
	const getSeconds = (times) => Math.floor((times % (1000 * 60)) / 1000);

	function randomQty() {
		const minQty = Math.ceil(+window.falshSale.percentMin);
		const maxQty = Math.floor(+window.falshSale.percentMax);
		let qty = Math.floor(Math.random() * (maxQty - minQty + 1)) + minQty;
		return Math.min(Math.max(qty, minQty), maxQty);
	}


	function renderProgress(item) {
		const id = item.dataset.pdid;
		const inventory = parseInt(item.dataset.inventoryQuantity);
		const available = item.dataset.available === 'true';
		const management = item.dataset.management === 'true';
		const soldQuantity = parseInt(item.dataset.soldQuantity);
		const progress = item.querySelector('.flashsale___percent');
		const soldNumber = item.querySelector('.flashsale__sold-qty');
		const label = item.querySelector('.flashsale__label');
		const maxInStock = parseInt(window.falshSale.maxInStock);

		// console.log(soldNumber);
		flashSaleStorage[id] = flashSaleStorage[id] || {};

		if (flashSaleStorage[id] && management && flashSaleStorage[id].inventory !== inventory) {
			if (flashSaleStorage[id].inventory > inventory) {
				flashSaleStorage[id].soldQty += flashSaleStorage[id].inventory - inventory;
			} else {
				flashSaleStorage[id] = {};
			}
		}

		let percent, stock, soldQty;

		if (useSoldQuantity) {
			soldQty = soldQuantity;
			stock = inventory + soldQty;
			percent = Math.round(soldQty * 100 / stock);
		} else {
			stock = flashSaleStorage[id].stock || maxInStock;
			percent = flashSaleStorage[id].soldQty ? Math.round(flashSaleStorage[id].soldQty * 100 / stock) : randomQty();
			soldQty = flashSaleStorage[id].soldQty || Math.round(percent * stock / 100);
			if (Math.round(inventory * 100 / maxInStock) <= 2) {
				percent = 98;
			}
		}

		if (!available && inventory === 0) {
			percent = 100;
		}

		if (available && inventory <= 0) {
			percent = 98;
		}

		flashSaleStorage[id].soldQty = soldQty;
		flashSaleStorage[id].timestamp = flashSaleStorage[id].timestamp || new Date().getTime();
		flashSaleStorage[id].stock = stock;
		flashSaleStorage[id].inventory = inventory;
		flashSaleStorage[id].management = management;

		if (quantityType !== 'inventory') {
			percent = (percent === 100 && available) ? 90 : percent;
			// progress.style.width = `${(percent < 90 || (percent > 90 && percent < 100)) ? percent : 90}%`;
			if (percent >= 98) {
				// label.innerHTML = ' ⚡  Sắp hết hàng';
			}

			if (percent === 100 || !available) {
				label.innerHTML = 'Hết hàng';
				progress.style.width = `100%`;
			}
		} else {
			percent = 100 - percent;
			percent = (percent === 0 && available) ? 10 : percent;
			progress.style.width = `${(percent > 10 || (percent > 0 && percent < 10)) ? percent : 10}%`;
			if (percent <= 10) {
				// label.innerHTML = ' ⚡  Sắp hết hàng';
			}

			if (percent === 0 || !available) {
				label.innerHTML = 'Hết hàng';
				progress.style.width = `100%`;
			}
		}

		if (soldNumber) {
			soldNumber.textContent = (quantityType === 'inventory') ? stock - soldQty : soldQty;
		}
	}

	function updateQty() {
		if (flashSaleStorage && Object.keys(flashSaleStorage).length) {
			Object.keys(flashSaleStorage).forEach(key => {
				const item = flashSaleStorage[key];
				const current = new Date().getTime();
				const distance = (current - item.timestamp) / 1000 / 60;
				const qty = distance > loopTime ? Math.round(distance / loopTime) : 0;

				if (!item.management) {
					item.soldQty += qty;
					item.soldQty = Math.min(item.soldQty, item.stock);
					item.timestamp = distance > loopTime ? current : item.timestamp;
				}
			});
			localStorage.setItem('flashSaleStorageItem', JSON.stringify(flashSaleStorage));
			return flashSaleStorage;
		}
		return;
	}

	function renderCountDown(distance) {
		const days = getDays(distance);
		const hours = String(getHours(distance)).padStart(2, '0');
		const minutes = String(getMinutes(distance)).padStart(2, '0');
		const seconds = String(getSeconds(distance)).padStart(2, '0');
		const html = [hours, minutes, seconds];
		if (days > 0) html.unshift(String(days).padStart(2, '0'));
		return html.join(':');
	}

	function calcCountDown(startTime, endTime) {
		const now = new Date().getTime();
		return (now >= startTime && now <= endTime) ? (endTime - now) : 0;
	}

	const now = new Date();
	const loopTime = 6;
	const {
		type,
		dateStart,
		dateFinish,
		hourStart,
		hourFinish,
		activeDay,
		finishAction,
		useSoldQuantity,
		quantityType
	} = window.falshSale;

	let flashSaleStorage = JSON.parse(localStorage.getItem('flashSaleStorageItem')) || {};
	const flashSaleSetting = JSON.parse(localStorage.getItem('flashSale')) || {};

	if (JSON.stringify(flashSaleSetting) !== JSON.stringify(window.falshSale)) {
		const setting1 = { ...flashSaleSetting };
		const setting2 = { ...window.falshSale };
		const storageDate = flashSaleSetting.timestamp;

		if ((+activeDay === 7 && !storageDate) || (new Date(storageDate).getDay() !== new Date().getDay())) {
			flashSaleStorage = {};
		}

		delete setting1.timestamp;
		delete setting2.timestamp;

		if (JSON.stringify(setting1) !== JSON.stringify(setting2)) {
			flashSaleStorage = {};
		}
	}

	localStorage.setItem('flashSale', JSON.stringify(window.falshSale));

	let distance = 0, startTime, endTime;

	if (type === 'hours' && (new Date().getDay() === +activeDay || +activeDay === 7)) {
		const [startHour, startMinute] = hourStart.split(':');
		startTime = new Date().setHours(startHour !== '24' ? startHour : '00', startMinute || '00', '00');
		endTime = new Date(startTime).addHours(+hourFinish).getTime();
		distance = calcCountDown(startTime, endTime);

		if (distance > 0) {
			setInterval(function() {
				distance = calcCountDown(startTime, endTime);
				document.querySelectorAll('.timein').forEach(el => el.innerHTML = renderCountDown(distance));
			}, 1000);
			document.querySelectorAll('.timein').forEach(el => el.innerHTML = renderCountDown(distance));
		}
	}

	if (type === 'days') {
		document.querySelectorAll('.timein').forEach(el => {
			const dataTime = el.dataset.time;
			const countDownDate = new Date(dataTime).getTime();
			setInterval(function() {
				const now = new Date().getTime();
				const distance = countDownDate - now;
				const days = Math.floor(distance / (1000 * 60 * 60 * 24));
				const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
				const seconds = Math.floor((distance % (1000 * 60)) / 1000);
				el.innerHTML = `<span>${String(days).padStart(2, '0')}</span>:<span>${String(hours).padStart(2, '0')}</span>:<span>${String(minutes).padStart(2, '0')}</span>:<span>${String(seconds).padStart(2, '0')}</span>`;
			}, 1000);
		});
	}

	if (distance > 0) {
		const isRendered = !useSoldQuantity && updateQty();
		document.querySelectorAll('.flashsale__item').forEach(item => renderProgress(item));

		if (!useSoldQuantity) {
			let start = 0;
			setInterval(function() {
				if (start) {
					updateQty();
					document.querySelectorAll('.flashsale__item').forEach(item => renderProgress(item));
				}
				start += 1;
			}, loopTime * 1000);
		}

		document.querySelectorAll('.flashsale__bottom').forEach(el => el.style.display = 'block');
		if (!isRendered) localStorage.setItem('flashSaleStorageItem', JSON.stringify(flashSaleStorage));
	}
}

FlashSale();