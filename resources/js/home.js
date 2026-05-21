const BILLBOARDS_LIST = document.getElementById("billboardsList");
const BILLBOARD_CONTAINERS = document.getElementsByClassName("billboardCont");
const SEARCH_BAR = document.getElementById("searchBillboards");
let searchTimeout;

function filterResults() {
    const searchTerm = SEARCH_BAR.value.trim().toLowerCase();
    document.getElementById('billboardsOriginTemp').className = searchTerm != "" ? "hidden" : "";
    let nbResults = 0;
    
    for (const billboardCont of BILLBOARD_CONTAINERS) {
        const name = billboardCont.dataset.name.toLowerCase();
        const description = billboardCont.dataset.description.toLowerCase();
        const remark = billboardCont.dataset.remark.toLowerCase();
        const contributor = billboardCont.dataset.contributor.toLowerCase();
        
        if (name.includes(searchTerm) || description.includes(searchTerm) || remark.includes(searchTerm) || contributor.includes(searchTerm)) {
            billboardCont.classList.remove("hidden");
            nbResults++;
        }
        else
            billboardCont.classList.add("hidden");
    }

    document.getElementById('noResults').className = nbResults == 0 ? "" : "hidden";

    BILLBOARDS_LIST.classList.remove("searchLoading");
}

SEARCH_BAR.addEventListener('input', () => {
    BILLBOARDS_LIST.classList.add("searchLoading");
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        filterResults();
    }, 500);
});

document.getElementById('clearFiltersBtn').addEventListener('click', () => {
    SEARCH_BAR.value = "";
    filterResults();
});

filterResults();



// COUNTDOWN
const releaseDate = new Date(2026, 10, 19);
let oldDays = 0;
let oldHours = 0;
let oldMinutes = 0;

function updateCountdown() {
    const now = new Date();
    let countdown = "";
    let remainingSeconds = (releaseDate-now) / 1000;
    const remainingDays = Math.floor(remainingSeconds / (60 * 60 * 24));
    const remainingDaysString = remainingDays < 10 ? "0"+remainingDaysString : remainingDays.toString();
    if (remainingDays > 0) {
        countdown += "<div"+(remainingDays != oldDays ? " class='changed'":"")+`><span>${remainingDaysString.split("").join('</span><span>')}</span>d</div> `;
        oldDays = remainingDays;
    }
    remainingSeconds = remainingSeconds % (60 * 60 * 24);
    const remainingHours = Math.floor(remainingSeconds / (60 * 60));
    const remainingHoursString = remainingHours < 10 ? "0"+remainingHours : remainingHours.toString();        
    if (remainingDays > 0 || remainingHours > 0) {
        countdown += "<div"+(remainingHours != oldHours ? " class='changed'":"")+`><span>${remainingHoursString.split("").join('</span><span>')}</span>h</div> `;
        oldHours = remainingHours;
    }
    remainingSeconds = remainingSeconds % (60 * 60);
    const remainingMinutes = Math.floor(remainingSeconds / 60);
    const remainingMinutesString = remainingMinutes < 10 ? "0"+remainingMinutes : remainingMinutes.toString();            
    if (remainingDays > 0 || remainingHours > 0 || remainingMinutes > 0) {
        countdown += "<div"+(remainingMinutes != oldMinutes ? " class='changed'":"")+`><span>${remainingMinutesString.split("").join('</span><span>')}</span>m</div> `;
        oldMinutes = remainingMinutes
    }
    remainingSeconds = Math.floor(remainingSeconds % 60);
    const remainingSecondesString = remainingSeconds < 10 ? "0"+remainingSeconds : remainingSeconds.toString();            
    if (remainingDays > 0 || remainingHours > 0 || remainingMinutes > 0 || remainingSeconds > 0)
        countdown += `<div class='changed'><span>${remainingSecondesString.split("").join('</span><span>')}</span>s</div>`;
    
    document.getElementById('countdown').innerHTML = countdown;
}

updateCountdown();
setInterval(() => {
    updateCountdown();
}, 1000);