 <div id="step-2" role="form" class="card bg-light mb-5">
     <div class="card-header mb-2">
         <h5 class="error">All * fields are required</h5>
     </div>
     <div class="card-body">
         <div class=" row">
             <div class="col-sm-6">
                 <div class="form-group">
                     <label for="frontMeasurementSketch" class="control-label"><b>Upload Front Measurement Sketch
                             <span class="error">*</span> :</b></label>
                     <div class="custom-file">
                         <input type="file" class="custom-file-input" id="frontMeasurementSketch" name="frontMeasurementSketch" aria-describedby="inputGroupFileAddon04" required="">
                         <label class="custom-file-label" for="postedFile">Choose front Measurement Sketch</label>
                         <div class="invalid-feedback">That didn't work.</div>
                     </div>
                 </div>
                 <div class="form-group">
                     <label for="backMeasurementSketch" class="control-label"><b>Upload Back Measurement Sketch
                             <span class="error">*</span> :</b></label>
                     <div class="custom-file">
                         <input type="file" class="custom-file-input" id="backMeasurementSketch" name="backMeasurementSketch" aria-describedby="inputGroupFileAddon04">
                         <label class="custom-file-label" for="postedFile">Choose back Measurement Sketch</label>
                     </div>
                 </div>
                 <div class="form-group">
                     <label for="collarMeasurementSketch" class="control-label"><b>Upload Collar Measurement Sketch <span class="error">*</span> :</b></label>
                     <div class="custom-file">
                         <input type="file" class="custom-file-input" id="collarMeasurementSketch" name="collarMeasurementSketch" aria-describedby="inputGroupFileAddon04" required>
                         <label class="custom-file-label" for="postedFile">Choose collar Measurement Sketch</label>
                     </div>
                 </div>
             </div>
             <div class="col-sm-2">
                 <label for="examples" class="control-label"><b>Example Sketch:</b></label>
             </div>
             <div class="col-sm-4">
                 <img src="img/ee51b7e91811269cea23d3979f006bab.jpg" data-action="zoom" alt="example-sketch" style="width:100%;max-width:300px">
             </div>
         </div>
     </div>
     <h5 class="mb-3"><strong>Pattern/Chart of</strong> Measurement : </h5>
     <table class="table table-striped">
         <thead>
             <tr>
                 <th scope="col">Ref <span class="error">*</span></th>
                 <th width="25%" scope="col">Description <span class="error">*</span></th>
                 <th scope="col">Tol(-+) <span class="error">*</span></th>
                 <th scope="col" class="s">S</th>
                 <th scope="col" class="m">M</th>
                 <th scope="col" class="l">L</th>
                 <th scope="col" class="xl">XL</th>
                 <th scope="col" class="xxl">XXL</th>
                 <th scope="col" class="xxxl">XXXL</th>
                 <th width="5%" scope="col">Action</th>
             </tr>
         </thead>
         <tbody class="clonable-block" data-toggle="cloner">
             <tr class="clonable" data-ss="1">
                 <th scope="row">
                     <input type="text" id="imgRef_0" class="form-control clonable-increment-id clonable-increment-name " name="measurementReference[0]" placeholder="reference">
                 </th>
                 <td>
                     <input type="text" id="measurementDescription_0" class="form-control clonable-increment-id clonable-increment-name" name="measurementDescription[0]" placeholder="Measurement description">
                 </td>

                 <td>
                     <input type="text" id="tolerance_0" class="form-control num clonable-increment-id clonable-increment-name" name="tolerance[0]" placeholder="tolerance">
                 </td>
                 <td class="s">
                     <input type="text" id="sSizeInInch_0" class="form-control num clonable-increment-id clonable-increment-name" name="s_size[0]" placeholder="Inch">
                 </td>
                 <td class="m">
                     <input type="text" id="mSizeInInch_0" class="form-control num clonable-increment-id clonable-increment-name" name="m_size[0]" placeholder="Inch">
                 </td>
                 <td class="l">
                     <input type="text" id="lSizeInInch_0" class="form-control num clonable-increment-id clonable-increment-name" name="l_size[0]" placeholder="Inch">
                 </td>
                 <td class="xl">
                     <input type="text" id="xlSizeInInch_0" class="form-control num clonable-increment-id clonable-increment-name" name="xl_size[0]" placeholder="Inch">
                 </td>
                 <td class="xxl">
                     <input type="text" id="xxlSizeInInch_0" class="form-control num clonable-increment-id clonable-increment-name" name="xxl_size[0]" placeholder="Inch">
                 </td>
                 <td class="xxxl">
                     <input type="text" id="xxxlSizeInInch_0" class="form-control num clonable-increment-id clonable-increment-name" placeholder="Inch" name="xxxl_size[0]">
                 </td>
                 <td>
                     <div class="btn-group btn-group-sm" role="group" aria-label="...">
                         <button class="clonable-button-add btn btn-primary" type="button"><i class="fa fa-plus"></i></button>
                         <button type="button" class="btn btn-danger clonable-button-close"><i class="fa fa-trash"></i></button>
                     </div>
                 </td>
             </tr>
         </tbody>
     </table>
 </div>


 <script type="text/javascript">
     function measurementValidation() {
         let result = true;
         $(".invalid-feedback").remove();
         $("input").removeClass("is-invalid");
         $('#step-2 input[type=file]').each(
             function(index) {
                 let inputfile = $(this);
                 if (inputfile.val() == "") {
                     let inputID = inputfile.attr('id');
                     $("#" + inputID).after('<span class="invalid-feedback">* ' + message(inputID) +
                         ' is required</span>').addClass("is-invalid").focus();
                     result = false;
                     return false;
                 }
             })
         if (result == true) {
             $('#step-2 input[type!=file]').each(
                 function(index) {
                     let inputText = $(this).not("num");
                     if ($(this).hasClass("num")) {
                         let inputtext = $(this);
                         if (isNaN(inputtext.val())) {
                             let inputID = inputtext.attr('id');
                             $("#" + inputID).after('<span class="invalid-feedback ">* ' + message(inputID) +
                                 ' must be a text</span>').addClass("is-invalid").focus();
                             result = false;
                             return false;
                         }

                     } else if ((inputText.val() == "")) {
                         let inputID = inputText.attr('id');
                         $("#" + inputID).after('<span class="invalid-feedback">* ' + message(inputID) +
                             ' is required</span>').addClass("is-invalid").focus();
                         result = false;
                         return false;
                     } else if ($(this).hasClass("num")) {
                         let inputtext = $(this);
                         if (isNaN(inputtext.val())) {
                             let inputID = inputtext.attr('id');
                             $("#" + inputID).after('<div class="invalid-feedback">* ' + message(inputID) +
                                 ' must be a number</div>').focus();
                             $("#" + inputID).addClass("is-invalid");
                             result = false;
                             return false;
                         }
                     }
                 }
             )
         }
         return result;
     }
 </script>