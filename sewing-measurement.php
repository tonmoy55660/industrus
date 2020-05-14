<div id="step-3" role="form" class="card bg-light mb-5">
    <div class="card-header mb-2">
        <h5 class="error">All * fields are required</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <div class="form-group">
                    <label for="frontSewing" class="control-label"><b>Upload Front sewing Sketch <span class="error">*</span> :</b></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="frontSewing" name="frontSewingSkecth" aria-describedby="inputGroupFileAddon04" required>
                        <label class="custom-file-label" for="postedFile">Choose Front sewing image</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="frontPlacket" class="control-label"><b>Upload Front Placket Sketch <span class="error">*</span> :</b></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="frontPlacket" name="frontPlacketSkecth" aria-describedby="inputGroupFileAddon04" required>
                        <label class="custom-file-label" for="postedFile">Choose front Placket image</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="slideSlit" class="control-label"><b>Upload Slide slit sewing Sketch <span class="error">*</span> :</b></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="slideSlit" name="slideSlitSkecth" aria-describedby="inputGroupFileAddon04" required>
                        <label class="custom-file-label" for="postedFile">Choose slide Slit image</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3"> <label for="examples1" class="cnotrol-label"><b>Example sewing Sketch:</b></label> </div>
            <div class="col-sm-4"> <img src="img/2972d9d9badcf56faeb77721ed52ff79.jpg" data-action="zoom" alt="example-sketch1" style="width:100%;max-width:300px"> </div>
        </div>
    </div>
    <h5 class="mb-3"><strong>Trims By</strong> Yarn Color : </h5>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Ref <span class="error">*</span></th>
                <th width="40%" scope="col">Description <span class="error">*</span></th>
                <?php foreach ($colors as $value) { ?>
                    <th scope="col"><?= $value['color'] ?> fabric <span class="error">*</span></th>
                <?php } ?>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="clonable-block" data-toggle="cloner">
            <tr class="clonable" data-ss="1">
                <td scope="row"> <input type="text" id="reference_0" class="form-control clonable-increment-id clonable-increment-name " name="sewingReference[0]" placeholder="reference"> </td>
                <td>
                    <input type="text" id="sewingDescription_0" class="form-control clonable-increment-id clonable-increment-name" name="sewingDescription[0]" placeholder="sewing description">
                </td>
                <?php foreach ($colors as $value) {
                    $color = preg_replace('/\s+/', '', $value['color']);
                ?>
                    <td>
                        <input type="text" id="<?= $color ?>YarnColor_0" class="form-control clonable-increment-id clonable-increment-name" name="<?= $color ?>_yarn[0]" placeholder="Yarn Color">
                    </td>
                <?php } ?>
                <td id="data">
                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                        <button class="clonable-button-add btn btn-primary cl" type="button"><i class="fa fa-plus"></i></button>
                        <button type="button" class="btn btn-danger clonable-button-close"><i class="fa fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    function sewingValidation() {
        let result = true;
        $(".invalid-feedback").remove();
        $("input").removeClass("is-invalid");
        $('#step-3 input').each(
            function(index) {
                let inputText = $(this);
                if ((inputText.val() == "")) {
                    let inputID = inputText.attr('id');
                    $("#" + inputID).after('<span class="invalid-feedback">* ' + message(inputID) +
                        ' is required</span>').addClass("is-invalid").focus();
                    result = false;
                    return false;
                }
            }
        )
        $(".error").remove();
        return result;
    }
</script>