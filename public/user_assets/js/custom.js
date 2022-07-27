$(document).ready(function () {
    $('#example').DataTable();
});

$(document).on("click", ".delete", function () {
    $(this).parent().parent().remove();

});
