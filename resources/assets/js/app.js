require('./bootstrap');
window.Vue = require('vue');
require('select2');
require('sweetalert');
var moment = require('moment');
var flatpickr = require("flatpickr");



new Vue({
    el: '#root',
    data(){
        return {
            isActive: false,
        }
    },
    methods: {
        onPage(page){
            return page == location.pathname;
        }
    }
});

$(document).ready(function () {
    $(".race").select2();
    $("#payment-method").select2();
    $("#referral-source").select2();
    $("#status").select2();
    $("#status-at-discharge").select2();
    $("#program-level").select2();
    $("#payment-method").select2();
    $("#referral-source").select2();
    $("#drug").select2();

    $("#reason").select2();
    $("#transaction_resident").select2();
    $("#transaction_date").select2();
    $("#transaction_type").select2({ width: 'resolve' });

    $("#sort_by").select2();

    $("#dob").flatpickr({
        allowInput: true,
        onChange: function (selectedDates, dateStr, instance) {
            $("#age").val(getAge(dateStr));
        }
    });
    $("#note-date").flatpickr();
    $("#date_of_admission").flatpickr({
        onChange: function (selectedDates, dateStr, instance) {
            var date = new moment(dateStr);
            date.add(6, "M");

            $("#projected_date_of_discharge").val(date.format("Y-M-D"));
        }
    });

    $("#projected_date_of_discharge").flatpickr({});
    $("#actual_date_of_discharge").flatpickr({});
    $("#employment_date").flatpickr({});
    $("#transaction_date_calendar").flatpickr({});
    $("#residentCreate").on("submit", function (e) {

        e.preventDefault();

        $.ajaxPrefilter(function (options, originalOptions, xhr) { // this will run before each request
            var token = $('meta[name="csrf-token"]').attr('content'); // or _token, whichever you are using

            if (token) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
            }
        });
        var myurl = "/resident";
        $.ajax({
            type: "POST",
            url: myurl,
            data: $(this).serialize(),
            success: function (data) {
                swal({
                    title: "Success!",
                    text: "Resident Added!",
                    type: "success",
                    timer: 1400,
                    showConfirmButton: false
                });
                $("#residentCreate").trigger("reset");
                $("#form-error-box").css("display", "none");
                $("select").trigger("change");
            },
            error: function (thrownError) {
                $("#form-error-list").empty();
                $("#form-error-box").css("display", "block");
                $.each(JSON.parse(thrownError.responseText), function (index, value) {
                    $("#form-error-list").append("<li> - " + value + "</li>");
                });
                swal({
                    title: "Whoops!",
                    html: true,
                    type: "error",
                    text: "Unable to add resident. Check your input and try again."
                });
            }
        })
    });
});

$("#transactionCreate").on("submit", function (e) {
    e.preventDefault();
    $.ajaxPrefilter(function (options, originalOptions, xhr) { // this will run before each request
        var token = $('meta[name="csrf-token"]').attr('content'); // or _token, whichever you are using

        if (token) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
        }
    });

    var myurl = "/transaction";
    $.ajax({
        type: "POST",
        url: myurl,
        data: $(this).serialize(),
        success: function (data) {
            swal({
                title: "Success!",
                text: "Transaction Added!",
                type: "success",
                timer: 1400,
                showConfirmButton: false
            });
            console.log(data);
            $("#transactionCreate").trigger("reset");
            $("#form-error-box").css("display", "none");
            var table = $("#transaction-table").DataTable();

            table.row.add([
                "<strong>" + data.id + "</strong>",
                data.date,
                data.reason,
                "<span class='debit'> - " + data.debit + "</span>",
                "<span class='credit'>" + data.credit + "</span>",
                "<a href=\"/transaction/" + data.id + "/edit\"><i class=\"fa fa-pencil\"></i></a>"

            ]).draw();
            $("#current_balance").html(data.current_balance);
            $("#current_balance").removeClass();
            $("#current_balance").addClass(data.class);
            $("select").trigger("change");

        },
        error: function (thrownError) {
            $("#form-error-list").empty();
            $("#form-error-box").css("display", "block");
            $.each(JSON.parse(thrownError.responseText), function (index, value) {
                $("#form-error-list").append("<li> - " + value + "</li>");
            });

            swal({
                title: "Whoops!",
                html: true,
                type: "error",
                text: "Unable to add transaction. Check your input and try again."
            });
        }
    })
});

function getAge(dateStr) {
    var today = new Date();
    var birthDate = new Date(dateStr);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}
