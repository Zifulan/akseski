/* APT off-canvas mega menu */
(function () {
	'use strict';

	var menu = document.getElementById('apt-menu');
	var toggle = document.querySelector('.apt-menu-toggle');
	if (!menu || !toggle) {
		return;
	}
	var body = document.body;
	var lastFocus = null;

	function focusables() {
		return menu.querySelectorAll('a[href], button:not([disabled]), input, select, textarea, [tabindex]:not([tabindex="-1"])');
	}

	function open() {
		lastFocus = document.activeElement;
		body.classList.add('apt-menu-open');
		toggle.setAttribute('aria-expanded', 'true');
		menu.setAttribute('aria-modal', 'true');
		menu.setAttribute('role', 'dialog');
		var closeBtn = menu.querySelector('.apt-menu-close');
		window.setTimeout(function () { (closeBtn || menu).focus(); }, 50);
	}

	function close() {
		body.classList.remove('apt-menu-open');
		toggle.setAttribute('aria-expanded', 'false');
		menu.removeAttribute('aria-modal');
		menu.removeAttribute('role');
		if (lastFocus && lastFocus.focus) {
			lastFocus.focus();
		}
	}

	toggle.addEventListener('click', function () {
		if (body.classList.contains('apt-menu-open')) {
			close();
		} else {
			open();
		}
	});

	document.querySelectorAll('[data-apt-menu-close]').forEach(function (el) {
		el.addEventListener('click', close);
	});

	// Same-page anchors (e.g. /#front-news) should close the panel.
	menu.addEventListener('click', function (e) {
		var a = e.target.closest('a[href*="#"]');
		if (a && a.pathname === window.location.pathname) {
			close();
		}
	});

	document.addEventListener('keydown', function (e) {
		if (!body.classList.contains('apt-menu-open')) {
			return;
		}
		if (e.key === 'Escape') {
			close();
			return;
		}
		if (e.key === 'Tab') {
			var items = focusables();
			if (!items.length) {
				return;
			}
			var first = items[0];
			var last = items[items.length - 1];
			if (e.shiftKey && document.activeElement === first) {
				e.preventDefault();
				last.focus();
			} else if (!e.shiftKey && document.activeElement === last) {
				e.preventDefault();
				first.focus();
			}
		}
	});
})();
