<!-- start contact -->
<section id="contact">
  <div class="container">
    <div class="row contact-into">
      <div class="col-md-12">
        <h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">CONTATO <span>PEÇA JÁ O SEU</span></h2>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.2s">
        <form action="#" method="post">
          <label>NOME</label>
          <input name="fullname" type="text" class="form-control" id="fullname">
          <label>E-MAIL</label>
          <input name="email" type="email" class="form-control" id="email">
          <label>MENSAGEM</label>
          <textarea name="message" rows="4" class="form-control" id="message"></textarea>
          <input type="submit" class="form-control">
        </form>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInRight" data-wow-offset="50" data-wow-delay="0.2s">
        <address>
          <p class="address-title">NOSSO ENDEREÇO</p>
          <span>Lorem ipsum dolor sit amet, consectetur adipiscing elitquisque tempus ac eget diam et laoreet phasellus ut nisi id leo molestie.</span>
          <p><i class="fa fa-phone"></i> (11) 3380-1329</p>
          <p><i class="fa fa-envelope-o"></i> contato@3dselfie.com</p>
          <p><i class="fa fa-map-marker"></i> Lorem ipsum dolor sit amet, consectetur adipiscing</p>
        </address>
        <ul class="social-icon">
          <li><h4>Siga-nos</h4></li>
          <li><a href="#" class="fa fa-facebook"></a></li>
          <li><a href="#" class="fa fa-twitter"></a></li>
          <li><a href="#" class="fa fa-instagram"></a></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- end contact -->

  <!-- start copyright -->
  <footer id="copyright">
      <div class="container">
          <div class="row">
              <div class="col-md-12 text-center">
                  <p class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.1s">
                  Copyright &copy; <?php echo date('Y') ?> by <a href="http://www.nepali.com.br" target="_blank">nepali</a></p>
              </div>
          </div>
      </div>
  </footer>
  <!-- end copyright -->

  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        ... teste modal
      </div>
    </div>
  </div>

<script type="text/javascript">
    $(document).ready(function(){

        /*$('#addCart').on('click',function(){
            $.post(URL + 'index/addCart/'+$('#idProduct').val(), function(data){
                alert('Produto adicionado!');
                $('#amount-cart').html( '(' + data + ')');
            });
        });*/

        $('.model-size').on('click', function(){
            $('#label-price').html('R$ ' + $(this).attr('title') + ',00');
            $('#price').val($(this).attr('title'));
        });

    });
</script>

</body>
</html>
