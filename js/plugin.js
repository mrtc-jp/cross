jQuery(function($) {
	//DropDown Widget
	$('select[name="archive-dropdown"]').wrap('<div class="select-wrap">');
});

// Dark Mode
const checkToggle = document.getElementById('dark-mode');
const isLight = window.matchMedia('(prefers-color-scheme: dark)').matches;
const keyLocalStorage = 'theme-mode';
const localTheme = localStorage.getItem(keyLocalStorage);
if (localTheme === 'dark') {
	changeMode('dark');
} else if (localTheme === 'light') {
	changeMode('light');
} else if (isLight) {
	changeMode('dark');
}
checkToggle.addEventListener('change', function(e) {
	if (e.target.checked) {
		changeMode('dark');
		localStorage.setItem(keyLocalStorage, 'dark');
	} else {
		changeMode('light');
		localStorage.setItem(keyLocalStorage, 'light');
	}
});

function changeMode(mode) {
	if (mode === 'dark') {
		document.body.classList.add('dark-theme');
		checkToggle.checked = true;
	} else if (mode === 'light') {
		document.body.classList.remove('dark-theme');
		checkToggle.checked = false;
	}
}