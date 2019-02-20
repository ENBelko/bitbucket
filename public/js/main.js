$(document).on('click', 'img', (event) => {
    event.preventDefault();
    let src = event.currentTarget.src;
    let modal = $('#exampleModal');
    modal.css('padding-right', 0);
    modal.find('.modal-dialog').css({'min-width': '100%', 'min-height': '100vh', 'margin': '0'});

    modal.find('#img-display').show();
    modal.find('#event').hide();

    modal.find('img').attr('src', src);
});

const eventFormPrepare = (event) => {
    event.preventDefault();

    let numb;
    //alert($(event.currentTarget).attr('id'))
    if ($(event.currentTarget).attr('id') == 'link-event1') {
        numb = 1;
    } else {
        numb = 2;
    }

    let modal = $('#exampleModal');

    modal.find('.modal-dialog').css({'min-width': '', 'min-height': '', 'margin': 'auto'});

    modal.find('#img-display').hide();
    modal.find('#event').show();

    modal.find('h5').text('Мероприятие№ ' + numb);
    modal.find('input[name="event"]').val(numb);
}

const showMsg = (text, type) => {

    //alert(type);
    let salert;
    if (type == 'success' || !type) {
        salert = 'alert-success';
    } else if (type == 'error') {
        salert = 'alert-danger';
    }
    $('#flashMsg').text(text);
    $('#flashMsg').removeClass().addClass(salert);
    $('#flashMsg').show();
    $("#flashMsg").fadeIn(10000, function () {
        $("#flashMsg").fadeOut(4500);
    });
}

