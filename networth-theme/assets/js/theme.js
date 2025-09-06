(function(){
	document.addEventListener('DOMContentLoaded', function(){
		var yearSpan = document.querySelector('[data-current-year]');
		if (yearSpan) { yearSpan.textContent = new Date().getFullYear(); }
	});
})();