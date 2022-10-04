// add if to delete
$(".btn-delete").click((e) => {
    if (!confirm("Ви точно хочете це видалити")) {
        e.preventDefault();
    }
});

// add class to sidebar
$(function ($) {
    let url = window.location.href;
    $(".menu-item a").each(function () {
        if (this.href === url) {
            $(this).closest("li").addClass("active");
        }
    });
});