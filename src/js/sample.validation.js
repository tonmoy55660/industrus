
$(function () {
    $('#myForm').on('submit', function () {
        let result = true;
        $('#myForm input,#myForm textarea').each(
            function () {
                let input = $(this).not(".nreq");
                $(".invalid-feedback").remove();
                $("input,textarea").removeClass("is-invalid");
                if (input.val() == "") {
                    let inputID = input.attr('id');
                    $("#" + inputID).after('<div class="invalid-feedback">* ' + message(inputID) +
                        ' is required</div>').focus();
                    $("#" + inputID).addClass("is-invalid");
                    result = false;
                    return false;
                }
                //   alert(result + 're')
                if ($(this).hasClass("num")) {
                    let inputNumber = $(this);
                    if (isNaN(inputNumber.val())) {
                        let inputID = inputNumber.attr('id');
                        $("#" + inputID).after('<div class="invalid-feedback">* ' + message(inputID) +
                            ' must be number</div>').focus();
                        $("#" + inputID).addClass("is-invalid");
                        result = false;
                        return false;
                    }
                }
            }
        )
        return result;
    });
});
