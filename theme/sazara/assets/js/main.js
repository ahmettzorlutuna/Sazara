/**
 * Sazara — main JS bundle.
 * - Sticky nav scroll-state
 * - Mobile hamburger drawer
 * - Scroll-reveal (.reveal → .in)
 * - Vanilla, no dependencies, defer-loaded.
 */

(() => {
	const reduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

	// ─── Sticky nav scroll-state ───
	const nav = document.getElementById("site-nav");
	if (nav) {
		const onScroll = () => {
			nav.classList.toggle("is-scrolled", window.scrollY > 20);
		};
		onScroll();
		window.addEventListener("scroll", onScroll, { passive: true });
	}

	// ─── Mobile drawer ───
	const toggle = document.querySelector(".nav__toggle");
	const menu = document.querySelector(".nav__menu");
	if (toggle && menu) {
		const links = menu.querySelectorAll("a");

		const setOpen = (open) => {
			toggle.setAttribute("aria-expanded", open ? "true" : "false");
			toggle.setAttribute("aria-label", open ? "Menüyü kapat" : "Menüyü aç");
			menu.classList.toggle("is-open", open);
			document.documentElement.style.overflow = open ? "hidden" : "";
		};

		toggle.addEventListener("click", () => {
			const isOpen = toggle.getAttribute("aria-expanded") === "true";
			setOpen(!isOpen);
		});

		document.addEventListener("keydown", (e) => {
			if (e.key === "Escape" && menu.classList.contains("is-open")) {
				setOpen(false);
				toggle.focus();
			}
		});

		links.forEach((link) => {
			link.addEventListener("click", () => setOpen(false));
		});

		const mq = window.matchMedia("(min-width: 60rem)");
		mq.addEventListener("change", (e) => {
			if (e.matches) setOpen(false);
		});
	}

	// ─── Reveal-on-scroll ───
	const targets = document.querySelectorAll(".reveal");
	if (targets.length) {
		if (reduced || !("IntersectionObserver" in window)) {
			targets.forEach((el) => el.classList.add("in"));
		} else {
			const io = new IntersectionObserver(
				(entries) => {
					entries.forEach((entry) => {
						if (entry.isIntersecting) {
							entry.target.classList.add("in");
							io.unobserve(entry.target);
						}
					});
				},
				{ rootMargin: "-50px 0px", threshold: 0.1 }
			);
			targets.forEach((el) => io.observe(el));
		}
	}

	// ─── Lightbox (case gallery) ───
	const galleryItems = document.querySelectorAll(".case-gallery__item");
	if (galleryItems.length) {
		let lightbox = null;
		let lightboxImg = null;

		const ensureLightbox = () => {
			if (lightbox) return;
			lightbox = document.createElement("div");
			lightbox.className = "lightbox";
			lightbox.setAttribute("role", "dialog");
			lightbox.setAttribute("aria-modal", "true");
			lightbox.setAttribute("aria-label", "Görsel önizleme");
			lightbox.innerHTML =
				'<button type="button" class="lightbox__close" aria-label="Kapat">' +
				'<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M6 6l12 12M6 18L18 6"/></svg>' +
				'</button>' +
				'<img class="lightbox__img" alt="">';
			document.body.appendChild(lightbox);
			lightboxImg = lightbox.querySelector(".lightbox__img");

			lightbox.addEventListener("click", (e) => {
				if (e.target === lightbox || e.target.closest(".lightbox__close")) {
					closeLightbox();
				}
			});
		};

		const openLightbox = (src, alt) => {
			ensureLightbox();
			lightboxImg.src = src;
			lightboxImg.alt = alt || "";
			requestAnimationFrame(() => lightbox.classList.add("is-open"));
			document.documentElement.style.overflow = "hidden";
		};

		const closeLightbox = () => {
			if (!lightbox) return;
			lightbox.classList.remove("is-open");
			document.documentElement.style.overflow = "";
		};

		galleryItems.forEach((item) => {
			item.addEventListener("click", () => {
				openLightbox(item.dataset.src, item.dataset.alt);
			});
		});

		document.addEventListener("keydown", (e) => {
			if (e.key === "Escape" && lightbox && lightbox.classList.contains("is-open")) {
				closeLightbox();
			}
		});
	}
})();
