Quill.register("modules/imageUploader", ImageUploader);
var editor = new Quill('#editor-container', {
	modules: {
		toolbar: '#editor-toolbar',
		imageResize: {
			modules: ['Resize', 'DisplaySize', 'Toolbar']
		},
		imageUploader: {
			upload: file => {
				return new Promise((resolve, reject) => {
					const formData = new FormData();
					formData.append("image", file);

					fetch(
						"/upload_image.php",
						{
							method: "POST",
							body: formData
						}
					)
						.then(response => {
							if (response.status == 200) {
								response.text().then(
									txt => resolve(txt)
								)
							} else if (response.status != 0) {
								reject("Upload failed");
							}
						})
						.catch(error => {
							reject("Upload failed");
							console.error("Error:", error);
						});
				});
			}
		}
	},
	theme: 'snow'
});