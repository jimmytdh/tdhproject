App = function() {
    "use strict";
    return App.pageCalendar = function() {
        $("#external-events .fc-event").each(function() {
            $(this).data("event", {
                title: $.trim($(this).text()),
                stick: !0
            }), $(this).draggable({
                zIndex: 999,
                revert: !0,
                revertDuration: 0
            })
        }), $("#calendar").fullCalendar({
            header: {
                left: "title",
                center: "",
                right: "month,agendaWeek,agendaDay, today, prev,next"
            },
            defaultDate: $('#calendar').fullCalendar('today'),
            editable: !0,
            eventLimit: !0,
            droppable: !0,
            drop: function() {
                $("#drop-remove").is(":checked") && $(this).remove()
            },
            events: [{
                title: "All Day Event",
                start: "2018-10-01"
            }, {
                title: "Long Event",
                start: "2018-10-07",
                end: "2018-10-10"
            }, {
                id: 999,
                title: "Repeating Event",
                start: "2017-02-09T16:00:00"
            }, {
                id: 999,
                title: "Repeating Event",
                start: "2017-02-16T16:00:00"
            }, {
                title: "Conference",
                start: "2017-02-11",
                end: "2017-02-13"
            }, {
                title: "Meeting",
                start: "2017-02-12T10:30:00",
                end: "2017-02-12T12:30:00"
            }, {
                title: "Lunch",
                start: "2017-02-12T12:00:00"
            }, {
                title: "Meeting",
                start: "2017-02-12T14:30:00"
            }, {
                title: "Happy Hour",
                start: "2017-02-12T17:30:00"
            }, {
                title: "Dinner",
                start: "2017-02-12T20:00:00"
            }, {
                title: "Birthday Party",
                start: "2017-02-13T07:00:00"
            }, {
                title: "Click for Google",
                url: "http://google.com/",
                start: "2017-02-28"
            }]
        })
    }, App
}();