/**
 * File that manage the modals and tables.
 */
$(document).ready(function () {
    // Backdropd element.
    let modaldrop = document.createElement('div');
    $(modaldrop).addClass('ron-modal-backdrop');
    // Element that show the modal.
    let event_show = $('[data-toggle="ron-modal"]');
    event_show.each(function (item, element) {
        let modal_id = $(element).attr('data-target');
        $(element).click(function (e) {
            e.preventDefault();
            $(modal_id).addClass('show');
            $(modal_id).parent().append(modaldrop);
            $(modal_id + ' [data-toggle="close"]').each(function (idex, elt) {
                $(elt).click(function (e) {
                    e.preventDefault();
                    $(modal_id).removeClass('show');
                    $(modaldrop).remove();
                });
            });
        });
    });
});
