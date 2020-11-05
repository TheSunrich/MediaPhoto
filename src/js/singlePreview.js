function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$("#photo").attr("src", e.target.result);
			$("#photo").css("border", "none");
			$(".importerPhoto p").css("display", "none");
			$(".importerPhoto img").css("width", "unset");
		};

		reader.readAsDataURL(input.files[0]);
	}
}
