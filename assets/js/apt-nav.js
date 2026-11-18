/*
 * APT menu drawer.
 *
 * A modal <dialog> (page becomes inert, Escape and focus return are native)
 * holding a horizontal scroll-snap scroller with two stops: the empty spacer
 * on the left = closed, the sheet on the right = open. Swiping the sheet away
 * is plain native scrolling; an IntersectionObserver on the sheet is the single
 * source of truth for "fully open" / "fully closed".
 */
(function () {
	'use strict';

	var drawer = document.getElementById('apt-menu');
	var openBtn = document.querySelector('.apt-menu-toggle');
	if (!drawer || !openBtn || typeof drawer.showModal !== 'function') {
		return;
	}
	var scroller = drawer.querySelector('.apt-menu-scroller');
	var sheet = drawer.querySelector('.apt-menu-sheet');
	var panel = drawer.querySelector('.apt-menu-panel');
	var closeBtn = drawer.querySelector('.apt-menu-close');

	function nextFrames() {
		return new Promise(function (resolve) {
			requestAnimationFrame(function () { requestAnimationFrame(resolve); });
		});
	}

	function openDrawer() {
		drawer.showModal();
		// The closed stop is scrollLeft 0, which is also where a fresh scroller
		// starts, but force it where scroll-initial-target is unsupported in
		// case a previous close was interrupted.
		var ready = Promise.resolve();
		if (!(window.CSS && CSS.supports('scroll-initial-target', 'nearest')) && scroller.scrollLeft !== 0) {
			scroller.scrollTo({ left: 0, behavior: 'instant' });
			ready = nextFrames();
		}
		ready.then(function () {
			// 'auto' defers to CSS scroll-behavior: smooth unless reduced motion.
			scroller.scrollTo({ left: scroller.scrollWidth, behavior: 'auto' });
		});
	}

	function closeDrawer() {
		// Don't close() here: the observer closes the dialog once the sheet has
		// actually slid out, so the exit animation stays visible.
		scroller.scrollTo({ left: 0, behavior: 'auto' });
	}

	function onDrawerOpened() {
		openBtn.setAttribute('aria-expanded', 'true');
	}

	function onDrawerClosed() {
		if (drawer.open) {
			drawer.close(); // returns focus to the menu button
		}
		openBtn.setAttribute('aria-expanded', 'false');
	}

	var visibleThreshold = 1 / window.innerWidth;
	new IntersectionObserver(function (entries) {
		var entry = entries[entries.length - 1];
		if (!drawer.open) {
			return;
		}
		if (entry.intersectionRatio < visibleThreshold) {
			onDrawerClosed();
		} else if (entry.intersectionRatio >= 0.99) {
			onDrawerOpened();
		}
	}, { root: drawer, threshold: [visibleThreshold, 0.99, 1] }).observe(sheet);

	// Backdrop fade fallback where scroll-driven animations are unsupported.
	if (!(window.CSS && CSS.supports('animation-timeline: scroll()'))) {
		scroller.addEventListener('scroll', function () {
			var ratio = Math.min(1, Math.max(0, scroller.scrollLeft / sheet.offsetWidth));
			drawer.style.setProperty('--menu-backdrop', ratio);
		}, { passive: true });
	}

	openBtn.addEventListener('click', openDrawer);
	closeBtn.addEventListener('click', closeDrawer);

	// Tap on the dimmed area (inside the full-viewport dialog, outside the
	// white panel) closes with the slide-out.
	drawer.addEventListener('click', function (event) {
		if (!panel.contains(event.target)) {
			closeDrawer();
		}
	});

	// Escape: slide out instead of the instant native close.
	drawer.addEventListener('cancel', function (event) {
		if (event.cancelable) {
			event.preventDefault();
			closeDrawer();
		}
	});

	// Links to a section of the current page: close at once so the page can scroll.
	panel.addEventListener('click', function (event) {
		var link = event.target.closest('a[href*="#"]');
		if (link && link.pathname === window.location.pathname && link.hash) {
			drawer.close();
			scroller.scrollTo({ left: 0, behavior: 'instant' });
			openBtn.setAttribute('aria-expanded', 'false');
		}
	});
})();
