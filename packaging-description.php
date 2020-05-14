<div id="step-4" role="form" class="card bg-light mb-5">
    <div class="card-header mb-2">
        <h5 class="error">All * fields are required</h5>
    </div>
    <div class="row mb-3">
        <div class="col-6 ">
            <h5><strong>Packaging</strong> Details per Box : </h5>
        </div>
        <div class="col-6 row ">
            <div class="col-4">
                <label for="">Peices Per Box :</label>
            </div>
            <div class="col-5">
                <input type="text" class="form-control" id="peicePerBox" name="peicePerBox" placeholder="total pieces">
            </div>
        </div>
    </div>

    <table class="table table-bordered mb-4">
        <thead>
            <tr>
                <th scope="col" width="15%">Size</th>
                <th scope="col">Length<br>(in CM)<span class="error">*</span></th>
                <th scope="col">Width<br>(in CM)<span class="error">*</span></th>
                <th scope="col">Height<br>(in CM)<span class="error">*</span></th>
                <th scope="col">Gross weight<br><span class="error">*</span>(in Kg)</th>
                <th scope="col">Net Weight<br><span class="error">*</span>(in Kg)</th>
                <th scope="col" width="5%">Action</th>
            </tr>
        </thead>
        <tbody class="clonable-block" data-toggle="cloner">
            <tr class="clonable" data-ss="1">
                <th scope="row">
                    <select class="form-control clonable-increment-id clonable-increment-name" id="size" name="size[0]">
                        <option value="s">S</option>
                        <option value="m">M</option>
                        <option value="l">L</option>
                        <option value="xl">XL</option>
                        <option value="xxl">XXL</option>
                        <option value="xxxl">XXXL</option>
                    </select></th>
                <td><input type="text" class="form-control num clonable-increment-id clonable-increment-name" id="Length_0" name="length[0]" placeholder="ex:25"></td>
                <td><input type="text" class="form-control num  clonable-increment-id clonable-increment-name" id="Width_0" name="width[0]" placeholder="ex:25"></td>
                <td><input type="text" class="form-control num clonable-increment-id clonable-increment-name" id="Height_0" name="height[0]" placeholder="ex:25"></td>
                <td><input type="text" class="form-control num clonable-increment-id clonable-increment-name" id="GW_0" name="grossWeight[0]" placeholder="ex:6.70"></td>
                <td><input type="text" class="form-control num clonable-increment-id clonable-increment-name" id="NW_0" name="netWeight[0]" placeholder="ex:5.70"></td>
                <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                        <button class="clonable-button-add btn btn-primary cl" type="button"><i class="fa fa-plus"></i></button>
                        <button type="button" class="btn btn-danger clonable-button-close"><i class="fa fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <h5 class="mb-3 mt-2"><strong>Shipment</strong> date : </h5>
    <div class="col-6">
        <input type="text" id="datepicker" name="shipmentDate" class="form-control">
    </div>
    <h5 class="mb-3 mt-2"><strong>Other Packaging</strong> information : </h5>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Reference <span class="error">*</span></th>
                <th width="40%" scope="col">Description <span class="error">*</span></th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="clonable-block" data-toggle="cloner">
            <tr class="clonable" data-ss="1">
                <td scope="row"> <input type="text" class="form-control  clonable-increment-name " name="packageReference[0]" placeholder="reference"> </td>
                <td>
                    <textarea class="form-control  clonable-increment-name" rows="3" id="comment_0" placeholder="describe other package information" name="packageDescription[0]"></textarea>
                </td>
                <td id="data">
                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                        <button class="clonable-button-add btn btn-primary" type="button"><i class="fa fa-plus"></i></button>
                        <button type="button" class="btn btn-danger  clonable-button-close"><i class="fa fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="alert alert-danger" role="alert" id="formerror" style="display: none;">
        <h4 class="alert-heading">ERROR!</h4>
        <hr>
        <p>You skipped steps! Fill up those form!</p>
        <hr>
        <p>Please Check You have selected all the required element!</p>
    </div>

    <div class="row">
        <div class="col text-center ">
            <button class="site-btn login-btn col-6" id="submit" name="submit">Order</button>
        </div>
    </div>
    <br>
</div>
<script>
    $(function() {
        $("#datepicker").datepicker({

            minDate: 0
        });
    });
</script>
<script type="text/javascript">
    function packingValidation() {
        let result = true;
        $(".invalid-feedback").remove();
        $("input").removeClass("is-invalid");
        let select = $("#size");
        if (select.val() === "") {
            let inputID = select.attr('id');
            $("#" + inputID).after('<span class="invalid-feedback">* ' + message(inputID) +
                ' is required</span>').addClass("is-invalid").focus();
            result = false;
            return false;
        }
        $('#step-4 input[type=text]').each(
            function(index) {
                let inputfile = $(this);
                if (inputfile.val() == "") {
                    let inputID = inputfile.attr('id');
                    $("#" + inputID).after('<span class="invalid-feedback">* ' + message(inputID) +
                        ' is required</span>').addClass("is-invalid").focus();
                    result = false;
                    return false;
                } else if ($(this).hasClass("num")) {
                    let number = $(this);
                    if (isNaN(number.val())) {
                        let inputID = number.attr('id');
                        $("#" + inputID).after('<div class="invalid-feedback">* ' + message(inputID) +
                            ' must be a number</div>').focus();
                        $("#" + inputID).addClass("is-invalid");
                        result = false;
                        return false;
                    }
                }
            })
        return result;
    }
</script>