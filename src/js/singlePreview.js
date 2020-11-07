function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$("#photo").attr("src", e.target.result);
			$("#photo").css("border", "none");
			$(".importPhoto p").css("display", "none");
			$(".importPhoto img").css("width", "unset");
		};

		reader.readAsDataURL(input.files[0]);
	}
}
