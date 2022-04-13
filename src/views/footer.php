<?php

require __DIR__ . '/db.php';

$statement = $pdo->prepare("SELECT value FROM contact WHERE name=?");
$statement->execute(array('facebook'));
$fb = $statement->fetchColumn();

$statement = $pdo->prepare("SELECT value FROM contact WHERE name=?");
$statement->execute(array('twitter'));
$tw = $statement->fetchColumn();

$statement = $pdo->prepare("SELECT value FROM contact WHERE name=?");
$statement->execute(array('instagram'));
$ig = $statement->fetchColumn();

?>
    <footer class="footer section text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="social-media">
                        <li>
                            <a href="https://www.facebook.com/<?= $fb ?>">
                                <i class="tf-ion-social-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/<?= $ig ?>">
                                <i class="tf-ion-social-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com/<?= $tw ?>">
                                <i class="tf-ion-social-twitter"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="footer-menu text-uppercase">
                        <li>
                            <a href="contact.html">CONTACT</a>
                        </li>
                        <li>
                            <a href="/products">SHOP</a>
                        </li>
                        <li>
                            <a href="/privacy-policy">PRIVACY POLICY</a>
                        </li>
                        <li>
                            <a href="/faq">FAQ</a>
                        </li>
                    </ul>
                    <p class="copyright-text">Copyright &copy;<script>document.write(new Date().getFullYear());</script></p>
                </div>
            </div>
        </div>
    </footer>

   
   <!-- 
    Essential Scripts
    =====================================-->
    
    <!-- Main jQuery -->
    <script src="views/plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.1 -->
    <script src="views/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Bootstrap Touchpin -->
    <script src="views/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <!-- Video Lightbox Plugin -->
    <script src="views/plugins/ekko-lightbox/dist/ekko-lightbox.min.js"></script>
    <!-- Count Down Js -->
    <script src="views/plugins/syo-timer/build/jquery.syotimer.min.js"></script>

    <!-- slick Carousel -->
    <script src="views/plugins/slick/slick.min.js"></script>
    <script src="views/plugins/slick/slick-animation.min.js'"></script>

    <!-- Main Js File -->
    <script src="views/js/script.js"></script>
    
    <?php if(isset($_SESSION['name'])): ?>
        <script>
            window.intercomSettings = {
                api_base: "https://api-iam.intercom.io",
                app_id: "",
                name: "<?= $_SESSION['name'] ?>", // Full name
                email: "<?= $_SESSION['email'] ?>", // Email address
                created_at: "<?= $_SESSION['created-time'] ?>" // Signup date as a Unix timestamp
            };
        </script>

        <script>
            
            (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/qq33os1d';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(document.readyState==='complete'){l();}else if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
        </script>
    <?php else: ?>
        <script>
            window.intercomSettings = {
                api_base: "https://api-iam.intercom.io",
                app_id: ""
            };
        </script>

        <script>
            
            (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/qq33os1d';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(document.readyState==='complete'){l();}else if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
        </script>
    <?php endif ?>

  </body>
  </html>
