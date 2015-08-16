$(document).ready(function () {
    $("#namaMasjid").keyup(function () {
        $.ajax({
            type: "POST",
            url: "http://localhost/opendatazis/index.php/InputKas/GetNamaMasjid",
            data: {
                keyword: $("#namaMasjid").val()
            },
            dataType: "json",
            success: function (data) {
                if (data.length > 0) {
                    $('#DropdownMasjid').empty();
                    $('#namaMasjid').attr("data-toggle", "dropdown");
                    $('#DropdownMasjid').dropdown('toggle');
                }
                else if (data.length == 0) {
                    $('#namaMasjid').attr("data-toggle", "");
                }
                $.each(data, function (key,value) {
                    if (data.length >= 0)
                        $('#DropdownMasjid').append('<li role="presentation" ><a role="menuitem dropdownnameli" class="dropdownlivalue">' + value['NAMA_MASJID'] + '</a></li>');
                });
            }
        });
    });
    $('ul.txtmasjid').on('click', 'li a', function () {
        $('#namaMasjid').val($(this).text());
    });
});