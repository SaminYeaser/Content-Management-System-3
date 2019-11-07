$(document).ready(function () {


    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );


});
$(document).ready(function () {
    $('#selectAllBoxes').click(function (event) {
        if (this.checked){
            $('.checkbox').each(function () {
                this.checked = true;
            });
        }else{
            $('.checkbox').each(function () {
                this.checked = false;
            });
        }
    });


    //$(body).prepend("hello");


        var div_box = "<div id='load-screen'><div id='loading'></div></div>";
        $("body").prepend(div_box);
        $('#load-screen').delay(700).fadeOut(600, function () {
            $(this).remove();

        });
});



