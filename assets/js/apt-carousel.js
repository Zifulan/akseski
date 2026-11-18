/*
 * APT carousel: native scroll + scroll snap, with previous/next buttons,
 * one marker per slide and a polite status message.
 *
 * Looping (3+ slides) parks an end slide next to the current one with CSS
 * `order` driven by the track's --current property, instead of cloning slides.
 * Controls only start scrolling; all state is derived from where scrolling
 * settles.
 */
(function () {
	'use strict';

	function nextFrames() {
		return new Promise(function (resolve) {
			requestAnimationFrame(function () { requestAnimationFrame(resolve); });
		});
	}

	function initCarousel(root) {
		var track = root.querySelector('.apt-carousel-track');
		var slides = Array.prototype.slice.call(track.children);
		var count = slides.length;
		if (!count) {
			return;
		}
		var prevBtn = root.querySelector('[data-direction="previous"]');
		var nextBtn = root.querySelector('[data-direction="next"]');
		var status = root.querySelector('.apt-carousel-status');
		var markersNav = root.querySelector('.apt-carousel-markers');
		var loops = count >= 3;

		var current = 0;          // settled slide (original index)
		var lastAnnounced = null;
		var pending = null;       // slide a click is scrolling to
		var requestedFrom = null; // scrollLeft when that scroll was requested
		var queued = null;        // previous/next held until slides are parked again
		var userScrolled = false;
		var retried = false;      // a marker trip has already been re-aimed once
		var compensatedAt = -1e9; // time of the last instant compensating scroll
		var frame = 0;

		slides.forEach(function (slide, i) { slide.dataset.index = i; });

		if (!(window.CSS && CSS.supports('order: sibling-count()'))) {
			track.style.setProperty('--children-count', count);
		}

		// ---- markers -----------------------------------------------------
		var markers = slides.map(function (slide, i) {
			var b = document.createElement('button');
			b.type = 'button';
			b.className = 'apt-carousel-marker';
			b.setAttribute('aria-label', slide.dataset.markerName || ('Go to slide ' + (i + 1)));
			b.addEventListener('click', function () { goTo(i); });
			markersNav.appendChild(b);
			return b;
		});

		function setActiveMarker(index) {
			markers.forEach(function (m, i) {
				if (i === index) {
					m.setAttribute('aria-current', 'true');
				} else {
					m.removeAttribute('aria-current');
				}
			});
		}

		// ---- geometry (visual order, inline axis only) -------------------
		function trackCenter() {
			var r = track.getBoundingClientRect();
			return r.left + track.clientWidth / 2;
		}
		function slideCenter(slide) {
			var r = slide.getBoundingClientRect();
			return r.left + r.width / 2;
		}
		function nearestIndex() {
			var c = trackCenter();
			var best = 0;
			var bestDist = Infinity;
			slides.forEach(function (s, i) {
				var d = Math.abs(slideCenter(s) - c);
				if (d < bestDist) { bestDist = d; best = i; }
			});
			return best;
		}
		function visualOrder() {
			return slides.slice().sort(function (a, b) {
				return a.getBoundingClientRect().left - b.getBoundingClientRect().left;
			});
		}
		function visualNeighbour(index, step) {
			var order = visualOrder();
			var pos = order.indexOf(slides[index]);
			var target = order[pos + step];
			return target ? Number(target.dataset.index) : null;
		}
		function scrollToSlide(index) {
			requestedFrom = track.scrollLeft;
			track.scrollBy({ left: slideCenter(slides[index]) - trackCenter(), behavior: 'auto' });
		}

		// ---- parking (looping) ------------------------------------------
		// Change --current (or clear it) without the visible content moving:
		// measure the anchor slide, reorder, scroll back by the difference.
		function park(value, anchorIndex, lockOverflow) {
			var anchor = slides[anchorIndex];
			var before = anchor.getBoundingClientRect().left;
			track.style.scrollSnapType = 'none';
			if (lockOverflow) {
				track.style.overflowX = 'hidden';
			}
			if (value === null) {
				track.style.removeProperty('--current');
			} else {
				track.style.setProperty('--current', value);
			}
			var diff = anchor.getBoundingClientRect().left - before;
			if (diff) {
				compensatedAt = performance.now();
				track.scrollBy({ left: diff, behavior: 'instant' });
			}
			track.style.scrollSnapType = '';
			if (lockOverflow) {
				nextFrames().then(function () { track.style.overflowX = ''; });
			}
		}

		// ---- finite fallback (fewer than 3 slides) -----------------------
		function updateButtons() {
			if (loops) {
				return;
			}
			var atStart = current === 0;
			var atEnd = current === count - 1;
			if (atStart && document.activeElement === prevBtn) { nextBtn.focus(); }
			if (atEnd && document.activeElement === nextBtn) { prevBtn.focus(); }
			prevBtn.disabled = atStart;
			nextBtn.disabled = atEnd;
		}

		// ---- controls ----------------------------------------------------
		function step(direction) {
			userScrolled = true;
			var base = pending !== null ? pending : current;
			var target = visualNeighbour(base, direction);
			if (target === null) {
				if (loops) {
					// Mid-trip with slides in DOM order: replay once parked again.
					queued = direction;
				}
				return;
			}
			pending = target;
			setActiveMarker(target);
			scrollToSlide(target);
		}

		function goTo(index) {
			userScrolled = true;
			queued = null;
			if (index === current && pending === null) {
				return;
			}
			if (loops) {
				// Put every slide back in DOM order so the trip runs in sequence.
				park(null, nearestIndex(), false);
			}
			pending = index;
			setActiveMarker(index);
			scrollToSlide(index);
		}

		prevBtn.addEventListener('click', function () { step(-1); });
		nextBtn.addEventListener('click', function () { step(1); });

		// ---- scroll tracking ----------------------------------------------
		track.addEventListener('scroll', function () {
			if (pending !== null || frame) {
				return;
			}
			frame = requestAnimationFrame(function () {
				frame = 0;
				setActiveMarker(nearestIndex());
			});
		}, { passive: true });

		['pointerdown', 'wheel', 'touchstart', 'keydown'].forEach(function (type) {
			track.addEventListener(type, function () { userScrolled = true; }, { passive: true });
		});

		function settle(event) {
			// The scrollend of an instant compensating scroll lands within a frame
			// or two. Acting on it could cancel the scroll that started right
			// after it, and parking already left the state correct.
			if (event && event.type === 'scrollend' && performance.now() - compensatedAt < 100) {
				return;
			}
			var index = nearestIndex();
			// A settle at the spot a new scroll was just requested from belongs to
			// an earlier scroll; the requested one has not moved yet.
			if (pending !== null && index !== pending && requestedFrom !== null && Math.abs(track.scrollLeft - requestedFrom) < 1) {
				return;
			}
			// A marker trip runs with slides in DOM order, where an end slide can't
			// be centred. Park around where we stopped, then finish the trip once.
			var retarget = (loops && pending !== null && index !== pending && !retried) ? pending : null;
			pending = null;
			requestedFrom = null;
			current = index;
			if (retarget !== null) {
				retried = true;
				park(index, index, false);
				pending = retarget;
				setActiveMarker(retarget);
				scrollToSlide(retarget);
				return;
			}
			retried = false;
			setActiveMarker(index);
			if (userScrolled && index !== lastAnnounced) {
				status.textContent = 'Slide ' + (index + 1) + ' of ' + count;
			}
			lastAnnounced = index;
			userScrolled = false;

			if (loops) {
				var replay = queued;
				var wanted = String(index);
				if (track.style.getPropertyValue('--current') !== wanted) {
					park(index, index, replay === null);
				}
				if (replay !== null) {
					queued = null;
					step(replay);
				}
			}
			updateButtons();
		}

		if ('onscrollend' in window) {
			track.addEventListener('scrollend', settle);
		} else {
			var timer = 0;
			track.addEventListener('scroll', function () {
				clearTimeout(timer);
				timer = setTimeout(function () { settle(null); }, 120);
			}, { passive: true });
		}

		// ---- initial state (silent) ---------------------------------------
		current = loops ? 0 : nearestIndex();
		lastAnnounced = current;
		setActiveMarker(current);
		if (loops) {
			// Park the last slide before the first, then centre the first slide.
			park(0, 0, false);
			track.scrollBy({ left: slideCenter(slides[0]) - trackCenter(), behavior: 'instant' });
		}
		updateButtons();
	}

	document.querySelectorAll('.apt-carousel').forEach(initCarousel);
})();
