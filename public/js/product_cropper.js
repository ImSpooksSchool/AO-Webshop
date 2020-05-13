/**
 * Modified version of:
 * @url https://github.com/fengyuanchen/cropperjs/blob/master/docs/examples/upload-cropped-image-to-server.html
 */

$(document).ready(function () {
    var input = document.getElementById("photo"),
        image = document.getElementById("image"),
        result = document.getElementById("result"),
        resultEncoded = document.getElementById("photo_encoded");

    var $modal = $('#modal');

    var cropper;

    input.addEventListener("change", function(event) {
        var files = event.target.files;

        var done = function (url) {
            input.value = "";
            image.src = url;
            $modal.modal("show");
        }

        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }

        $modal.on("shown.bs.modal", function () {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 0,
            });
        }).on("hidden.bs.modal", function () {
            cropper.destroy();
            cropper = null;

            $modal.unbind("shown.bs.modal");
            $modal.unbind("hidden.bs.modal");
        });

        document.getElementById("crop").onclick = function () {
            if (cropper != null) {
                var canvas = cropper.getCroppedCanvas({width: 512, height: 512});
                result.src = canvas.toDataURL();
                resultEncoded.value = result.src;
            }

            $modal.modal('hide');
        };

        $("form").submit(function() {
            $(this).children('#in-between').attr("disabled", "true");
        });
    });
})
