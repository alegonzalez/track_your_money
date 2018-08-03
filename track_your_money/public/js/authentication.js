//this function show automatically the image
function readURL(input){
  if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image_profile')
                    .attr('src', e.target.result)
                    .width(180)
                    .height(180);
            };
            reader.readAsDataURL(input.files[0]);
        }
}
