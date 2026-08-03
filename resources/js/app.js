import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
	const body = document.body;
	const mobileToggle = document.querySelector('[data-mobile-menu-toggle]');
	const mobilePanel = document.querySelector('[data-mobile-menu-panel]');

	if (mobileToggle && mobilePanel) {
		mobileToggle.addEventListener('click', () => {
			mobilePanel.classList.toggle('hidden');
			mobileToggle.setAttribute('aria-expanded', String(!mobilePanel.classList.contains('hidden')));
		});
	}

	document.querySelectorAll('[data-password-toggle]').forEach((button) => {
		button.addEventListener('click', () => {
			const targetId = button.getAttribute('data-password-toggle');
			const target = targetId ? document.getElementById(targetId) : null;

			if (!target) {
				return;
			}

			const isHidden = target.getAttribute('type') === 'password';
			target.setAttribute('type', isHidden ? 'text' : 'password');
			button.setAttribute('aria-pressed', String(isHidden));

			const label = button.querySelector('[data-password-toggle-label]');
			if (label) {
				label.textContent = isHidden ? 'Hide' : 'Show';
			}
		});
	});

	document.querySelectorAll('[data-toast]').forEach((toast) => {
		const closeButton = toast.querySelector('[data-toast-close]');
		const hideToast = () => {
			toast.classList.add('opacity-0', 'translate-y-2');
			window.setTimeout(() => toast.remove(), 250);
		};

		closeButton?.addEventListener('click', hideToast);
		window.setTimeout(hideToast, 5000);
	});

	const backToTop = document.querySelector('[data-back-to-top]');
	if (backToTop) {
		const toggleBackToTop = () => {
			const hidden = window.scrollY < 500;
			backToTop.classList.toggle('opacity-0', hidden);
			backToTop.classList.toggle('pointer-events-none', hidden);
			backToTop.classList.toggle('translate-y-2', hidden);
		};

		toggleBackToTop();
		window.addEventListener('scroll', toggleBackToTop, { passive: true });
		backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
	}

	body.classList.add('text-slate-900');
});
