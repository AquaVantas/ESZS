Quill.register("modules/imageUploader", ImageUploader);
var arrayOfToolbars = document.getElementsByClassName("editor-toolbar");
var arrayOfContainers = document.getElementsByClassName("editor-container");
for (let index = 0; index < arrayOfToolbars.length; index++) {
	window['editor' + arrayOfContainers[index].getAttribute("container-id")] = new Quill('[container-id="' + arrayOfContainers[index].getAttribute("container-id") + '"]', {
		modules: {
			toolbar: '[toolbar-id="' + arrayOfToolbars[index].getAttribute("toolbar-id") + '"]',
			imageResize: {
				modules: ['Resize', 'DisplaySize', 'Toolbar']
			},
			imageUploader: {
				upload: file => {
					return new Promise((resolve, reject) => {
						const formData = new FormData();
						formData.append("image", file);

						fetch(
							"Controllers/Website/News/news_upload_image.php",
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
}
