jQuery(document).ready(function () {
    $('#check-in-date').daterangepicker({
        //autoUpdateInput: false,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: {
            format: 'YYYY-MM-DD'

        },
        // THIS
        parentEl: '.widget__form',
        autoApply: true, // Automatically apply the selected date range
        opens: 'right'

    });

    $("#check-in-date").on("apply.daterangepicker", function (ev, picker) {
        // Close the date range picker
        picker.hide();
        toggleClassOnOtherInput(); // Call function to toggle class on other input

    });

    function toggleClassOnOtherInput() {
        $(".select-options").css("display", "block");
    }

});

$(document).ready(function () {
    $("#increment-adults").click(function () {
        $("#adults").val(parseInt($("#adults").val()) + 1);
        $("#number_of_persons").val(parseInt($("#number_of_persons").val()) + 1);
        $('#adults-children').text(parseInt($("#number_of_persons").val()));
    });

    $("#decrement-adults").click(function () {
        if ($("#adults").val() > 0) {
            $("#adults").val(parseInt($("#adults").val()) - 1);
            $("#number_of_persons").val(parseInt($("#number_of_persons").val()) - 1);
            $('#adults-children').text(parseInt($("#number_of_persons").val()));

        }
    });

    $("#increment-children").click(function () {
        $("#children").val(parseInt($("#children").val()) + 1);
        $("#number_of_persons").val(parseInt($("#number_of_persons").val()) + 1);
        $('#adults-children').text(parseInt($("#number_of_persons").val()));

    });

    $("#decrement-children").click(function () {
        if ($("#children").val() > 0) {
            $("#children").val(parseInt($("#children").val()) - 1);
            $("#number_of_persons").val(parseInt($("#number_of_persons").val()) - 1);
            $('#adults-children').text(parseInt($("#number_of_persons").val()));

        }
    });
});


$(document).ready(function () {
    $(document).on('click', '.people-custom-select', function () {
        $('.select-options').show();
    });
    $(document).on('click', function (event) {
        var container = $('.people-custom-select');
        if (!container.is(event.target) && container.has(event.target).length === 0) {
            $('.select-options').hide();
        }
    });
    $(document).on('click', "#decrement-adults, #decrement-children, #increment-adults, #increment-children", function (event) {
        event.stopPropagation();
    });

    // $(".pac-item span").on('click', function() {
    //     console.log('click')
    // });
});

function createHeader() {
    var element = document.querySelector('.pac-header')
    if (element == null) {
        var spn = document.createElement('span');
        spn.innerHTML = 'Where should it go?';
        spn.className = 'pac-header';
        document.querySelector('.pac-container').prepend(spn);
    }
}

function initMap() {
    var input = document.getElementById('location-input');
    var options = {
        types: ['(cities)']
    };
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        $('input[name="check_in_date"]').focus();
    });

    input.addEventListener('click', function () {
        createHeader()
    });
}