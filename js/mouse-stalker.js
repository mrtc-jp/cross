jQuery(function($) {
	//Mouse Stalker
	if (!navigator.userAgent.match(/(iPhone|iPad|iPod|Android)/)) {
		var body = document.body;
		var stalker = document.createElement("div");
		stalker.id = "stalker";
		body.appendChild(stalker);
		body.addEventListener("mousemove", function(e) {
			stalker.style.left = e.clientX + "px";
			stalker.style.top = e.clientY + "px";
		}, false);
		$("a, button").on("mouseenter", function() {
			$('#stalker').addClass("active");
		});
		$("a").on("mouseleave", function() {
			$('#stalker').removeClass("active");
		});
	}
});