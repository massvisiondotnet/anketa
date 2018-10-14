

$(document).ready(function() {
    $('div.question.rated input').change(function() {
       refreshRatedLabels();
    });

    refreshRatedLabels();

    var $survey = $('.survey');

    var $checkbox = $survey.find('.question.multi input');
    $checkbox.each(function() {
        $(this).wrap(
            $('<div>').addClass('checkboxWrapper').click(function() {
                var chckbox = $(this).find('input');
                if (chckbox.length)
                    $(chckbox[0]).prop('checked', $(chckbox[0]).prop('checked') ? false : true);
                refreshFakeCheckboxes();
            })
        );
        $(this).change(function() { alert('changed'); alert($(this).prop('checked')); refreshFakeCheckboxes(); });
    });
    $survey.find('.question.multi label').click(function(e) {
        e.preventDefault();
        var $cb = $('#' + $(this).attr('for'));
        $cb.prop('checked', $cb.prop('checked') ? false : true);
        refreshFakeCheckboxes();
    });

    $checkbox = $survey.find('.question.multi_imaged input');
    $checkbox.each(function() {
        $(this).wrap(
            $('<div>').addClass('checkboxWrapper')
        );
    });

    refreshFakeCheckboxes();
    refreshFakeImagedCheckboxes();

    var $imaged = $survey.find('div.field_wrapper.imaged');
    $imaged.click(function() {
        var chckbox = $(this).find('input');
        if (chckbox.length)
            $(chckbox[0]).prop('checked', $(chckbox[0]).prop('checked') ? false : true);
        refreshFakeImagedCheckboxes();
    });
    $imaged.each(function() {
        var label = $(this).find('label');
        if (label.length)
            $(this).attr('title', $(label[0]).text().trim());
    });


    $('div.page_submit input[type=submit]').wrap(
        $('<div>').attr('class', 'submitWrappwer')
    );

    var $dc = $('div#main');
    var mh = $dc.height();
    var wh = window.innerHeight;
    var dh = document.body.clientHeight;
    if (wh > dh) {
        $dc.css('min-height', (mh + wh - dh) + 'px');
    }

    // survey 1 specs:
    $('div#survey_1 div#question_8').hide();
    $('div#survey_1 div#question_7 select').change(function() {
        let targetSelect = $('div#survey_1 div#question_8 select');
        let targetDiv = $('div#survey_1 div#question_8');
        targetSelect.val(null);
        if ($(this).val() === '3') targetDiv.show(); else targetDiv.hide();
    });


});

function refreshRatedLabels() {
    $('div.question.rated label').each(function() {
        var fid = $(this).attr('for');
        if ($('#'+fid).prop('checked'))
            $(this).addClass('active');
        else
            $(this).removeClass('active');
    });
}

function refreshFakeCheckboxes() {
    $('.survey').find('.question.multi input').each(function() {
        if ($(this).prop('checked'))
            $(this).closest('.checkboxWrapper').addClass('active');
        else
            $(this).closest('.checkboxWrapper').removeClass('active');
    })
}
function refreshFakeImagedCheckboxes() {
    $('.survey').find('.question.multi_imaged input').each(function() {
        if ($(this).prop('checked'))
            $(this).closest('.checkboxWrapper').addClass('active');
        else
            $(this).closest('.checkboxWrapper').removeClass('active');
    })
}



