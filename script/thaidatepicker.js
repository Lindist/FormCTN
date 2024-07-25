function thaiDatepicker(el) {
    $.datetimepicker.setLocale('th')
    $(el).attr('readonly', true)
    $(el).addClass('date-readonly')
    $(el).datetimepicker({
        timepicker: false,
        format: 'd/m/Y',
        lang: 'th',
        minDate: new Date(),
        yearOffset : 543,
        validateOnBlur: false,
    })
}
