$(".btn-delete").click((e) => {
    if (!confirm("Ви точно хочете це видалити")) {
        e.preventDefault();
    }
});
