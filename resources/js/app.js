import './bootstrap';

const TOASTS_WRAPPER = document.getElementById("toastsWrapper");
const TOAST_QUEUE = document.getElementById("toastQueue");
const TOAST_QUEUE_NUMBER = document.getElementById('toastQueueNumber');
const TOASTS_EXPAND_BTN = document.getElementById('toastExpandToggle');
let toastQueueMessage = [];
const popoverSupported = HTMLElement.prototype.hasOwnProperty("popover");


window.postRequest = async function(url, datas = {}, json = true) {
	const response = await fetch(url, {
		method: "POST",
		cache: "no-cache",
		headers: {
			"Content-Type": "application/json",
			'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute("content") : ""),
		},
		body: JSON.stringify(datas),
	});
	if (json && response.headers.get("content-type") == "application/json") 
		return response.json();
	else
		return response.text();
}

window.getRequest = async function(url) {
	const response = await fetch(url, {
		method: "GET",
		cache: "no-cache",
	});
	return response.json();
}

function showNextToast() {
	let oldToast = TOAST_QUEUE.firstElementChild;
	oldToast.classList.add("fadeOut");
	setTimeout(() => {
		TOAST_QUEUE.removeChild(oldToast);
		toastQueueMessage.shift();

		if (TOAST_QUEUE.children.length == 0) {
			TOASTS_WRAPPER.classList.remove("show");
			return;
		}
	}, 500);

	if (TOAST_QUEUE.children.length > 1) {
		if (TOAST_QUEUE.children.length - 1 > 1)
			TOAST_QUEUE_NUMBER.innerHTML = "+"+(TOAST_QUEUE.children.length - 2);
		else
			TOAST_QUEUE_NUMBER.innerHTML = "";

		let nextToast = TOAST_QUEUE.children[1];
		nextToast.classList.add("fadeIn");
	}
}

window.displayToast = function(message, iiiconName, accentColor = "transparent", duration = -1) {
	if (!message || toastQueueMessage.includes(message))
		return;

	toastQueueMessage.push(message);
	TOASTS_WRAPPER.classList.add("show");
	if (TOAST_QUEUE.children.length + 1 > 1)
		TOAST_QUEUE_NUMBER.innerHTML = "+"+TOAST_QUEUE.children.length;

	let newToast = document.createElement("div");
	newToast.classList.add("toast");
	if (TOAST_QUEUE.children.length == 0)
		newToast.classList.add("fadeIn");

	newToast.style.setProperty("--toast-accent-color", accentColor);
	let newCloseBtn = document.createElement('button');
	newCloseBtn.innerHTML = "<i class='iiicon' data-name='close' title='Close'>Close</i>";
	newCloseBtn.classList.add("closeToastBtn", "discret");
	newCloseBtn.addEventListener('click', function() {
		if (newToast === TOAST_QUEUE.firstElementChild)
			showNextToast();
		else {
			newToast.remove();
			TOAST_QUEUE_NUMBER.innerHTML = "+"+(TOAST_QUEUE.children.length - 1);
		}
	});
	let newMsg = document.createElement("div");
	newMsg.classList.add("toastMsg");
	let newIIIcon = document.createElement("i");
	newIIIcon.setAttribute("data-name", iiiconName);
	newIIIcon.classList.add("iiicon");
	let newText = document.createElement("output");
	newText.setAttribute("role", "status");
	newText.innerHTML = message;
	newMsg.appendChild(newIIIcon);
	newMsg.appendChild(newText);
	newToast.appendChild(newCloseBtn);
	newToast.appendChild(newMsg);
	TOAST_QUEUE.appendChild(newToast);
}

TOASTS_EXPAND_BTN.addEventListener('click', () => {
	TOASTS_WRAPPER.dataset.expanded = TOASTS_WRAPPER.dataset.expanded == "true" ? "false" : "true";
});

window.toggleDialog = function(target, state = "toggle", type = "auto") {
	if (type === "auto")
		type = target.nodeName === "DIALOG" ? "modal" : "popover";
	
	switch (state) {
		case "show":
			switch (type) {
				case "nonModal":
					target.show();
					break;
					
				case "modal":
				default:
					target.showModal();
					break;

				case "popover":
					if (popoverSupported)
						target.showPopover();
					else
						target.classList.add("popoverOpen");
					break;
			}
			break;

		case "hide":
			switch (type) {
				case "nonModal":
				case "modal":
				default:
					target.close();
					break;

				case "popover":
					if (popoverSupported)
						target.hidePopover();
					else
						target.classList.remove("popoverOpen");
					break;
			}
			break;

		case "toggle":
		default:
			switch (type) {
				case "nonModal":
					if (!target.open)
						target.show();
					else
						target.close();
					break;
					
				case "modal":
				default:
					if (!target.open)
						target.showModal();
					else
						target.close();
					break;

				case "popover":
					if (popoverSupported)
						target.togglePopover();
					else
						target.classList.toggle("popoverOpen");
					break;
			}
			break;
	}
}

document.querySelectorAll('.tooltipTarget').forEach(target => {
	if (target.dataset.tooltipPos === "left" || target.dataset.tooltipPos === "right")
		return
    const tooltip = target.querySelector('.tooltip');
	if (!tooltip)
		return

    // Run on load and resize
    const adjustTooltip = function() {
        tooltip.dataset.offsetLeft = 0;
        tooltip.dataset.offsetRight = 0;
        tooltip.style.translate = '-50%';

        let rect = tooltip.getBoundingClientRect();
        while (rect.right > document.body.clientWidth) {
            tooltip.dataset.offsetLeft = parseInt(tooltip.dataset.offsetLeft) +1;
            tooltip.style.translate = `-${tooltip.dataset.offsetLeft}px`;

            rect = tooltip.getBoundingClientRect();
        }
        while (rect.left < 0) {
            tooltip.dataset.offsetRight = parseInt(tooltip.dataset.offsetRight) +1;
            tooltip.style.translate = `${tooltip.dataset.offsetRight}px`;

            rect = tooltip.getBoundingClientRect();
        }
    };

    adjustTooltip();

    // Observe interaction or window change
    target.addEventListener('mouseenter', () =>{ adjustTooltip() });

    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => adjustTooltip(), 100);
    });
});

document.getElementById("openGameSelector").addEventListener('click', () => {
    toggleDialog(document.getElementById("gameSelector"), "show", "nonModal");
});

document.getElementById('iaDisclaimerBtn').addEventListener('click', () => {
	toggleDialog(document.getElementById('aiDisclaimer'));
})