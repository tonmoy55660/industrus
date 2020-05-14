<!-- Footer Section Begin -->
<footer class="footer-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="footer-left">
          
          <ul>
            <li>Address: 60-49 Road 11378 New York</li>
            <li>Phone: +65 11.188.888</li>
            <li>Email: hello.colorlib@gmail.com</li>
          </ul>
        </div>
      </div>
      <div class="col-lg-2 offset-lg-1">
        <div class="footer-widget">
          <h5>Information</h5>
          <ul>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Checkout</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Serivius</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-2">
        <div class="footer-widget">
          <h5>My Account</h5>
          <ul>
            <li><a href="#">My Account</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Shopping Cart</a></li>
            <li><a href="#">Shop</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="copyright-reserved">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="copyright-text">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy; All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" rel="noopener" target="_blank">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </div>
          <div class="payment-pic">
            <img src="img/payment-method.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="src/js/bootstrap.min.js"></script>
<script src="src/js/jquery-ui.min.js"></script>
<script src="src/js/jquery.countdown.min.js"></script>
<script src="src/js/jquery.nice-select.min.js"></script>
<script src="src/js/jquery.zoom.min.js"></script>
<script src="src/js/jquery.dd.min.js"></script>
<script src="src/js/jquery.slicknav.js"></script>
<script src="src/js/owl.carousel.min.js"></script>
<script src="src/js/main.js"></script>
<script type="text/javascript" src="plugin/smart-wizard/js/jquery.smartWizard.min.js"></script>
<script type="text/javascript" src="plugin/smart-wizard/js/jquery.cloner.js"></script>
<script type="text/javascript" src="plugin/zoom/js/zoom.js"></script>

<script type="text/javascript">
  $(function() {

    $('#smartwizard').smartWizard({
      selected: 0,
      theme: 'arrows',
      transitionEffect: 'fade',
    });

    $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
      if (stepNumber == 4) { // 4 is the last step in this case
        $("#smartwizard .btn-toolbar .sw-btn-next").hide()
      } else {
        $("#smartwizard .btn-toolbar .sw-btn-next").show()
      }
    });
    $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
      var elmForm = $("#step-" + stepNumber);
      if (stepDirection === 'forward' && elmForm) {
        var result = "";
        if (stepNumber == 1) {
          result = measurementValidation();
        }
        if (stepNumber == 2) {
          result = sewingValidation();
        }
        return result;
      }
    });
  });
  $("#form input[type=file]").on('change', function(event) {
    $(".invalid-feedback").remove();
    $("input").removeClass("is-invalid");
    var input = $(this);
    var inputFile = event.currentTarget;
    $(inputFile).parent()
      .find('.custom-file-label')
      .html(inputFile.files[0].name);
    var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
      let id = $("#" + input.attr('id'));
      $(inputFile).parent()
        .find('.custom-file-label')
        .html('');
      id.after('<span class="invalid-feedback">* Only formats are allowed : ' + fileExtension.join(', ') + '</span>').focus();
      id.addClass("is-invalid");
    }
  });
  $(document).ready(function() {
    $("#submit").on('click', function() {
      if (packingValidation() == false) {
        return false;
      }
      if (sewingValidation() == false || measurementValidation() == false) {
        $("#formerror").show();
        setTimeout(function() {
          $('#formerror').fadeOut()
        }, 5000);
        return false;
      }
    });
  });
</script>
</body>

</html>
