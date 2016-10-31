        <div class="scroll-top" id="el-scroll-top">
            <a href="#" id="btn-scroll-top"><i class="fa fa-angle-up fa-3x"></i></a>
        </div>
        <footer class="l-footer">
            <div class="footer">
                <div class="footer-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                </div>
                <div class="footer-copyright">
                    <p>All rights reserved</p>
                </div>
            </div>
        </footer>

        <script type="text/javascript" src="<?=SITEURL;?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?=SITEURL;?>js/bootstrap.min.js"></script>
        <script type="text/javascript">

            (function(){
                var searchMenu = document.getElementById('search');
                var layoutSearch = document.getElementById('l-search');

                var hamburgerMenu = document.getElementById('hamburger-menu');
                var layoutSecondaryMenu = document.getElementById('secondary-menu-hamburger');

                // show / hide input search
                searchMenu.onclick = function() {
                    styleLayoutSearch = layoutSearch.style.display;
                    if(styleLayoutSearch === '' || styleLayoutSearch === 'none') {
                        layoutSearch.style.display = 'block';
                    } else {
                        layoutSearch.style.display = 'none';
                    }
                }
                // end

                hamburgerMenu.onclick = function() {
                    styleLayoutSecondaryMenu = layoutSecondaryMenu.style.display;

                    if(styleLayoutSecondaryMenu === '' || styleLayoutSecondaryMenu === 'none') {
                        layoutSecondaryMenu.style.display = 'block';
                    } else {
                        layoutSecondaryMenu.style.display = 'none';
                    }
                }

                window.onscroll = function () {
                  var d       = document.documentElement;
                  var left    = (window.pageXOffset || d.scrollLeft) - (d.clientLeft || 0);
                  var top     = (window.pageYOffset || d.scrollTop) - (d.clientTop || 0);

                  var navMenuSecondary = document.getElementById('nav-menu-secondary');
                  var elScorllTop = document.getElementById('el-scroll-top');

                  // show / hide el scroll top
                  if(top > 30) {
                    elScorllTop.style.display = 'block';
                  }  

                  if(top < 30) {
                    elScorllTop.style.display = 'none';
                  }
                  //end

                  // change postion become fixed
                  if(top > 200) {
                    navMenuSecondary.classList.add('fixed-top', 'fadeIn');
                  }

                  if(top < 200) {
                    navMenuSecondary.classList.remove('fixed-top', 'fadeIn');
                  }
                  // end
                }
            }());
            
            // jquery
            $(function(){
                $('#btn-scroll-top').click(function(e){
                    e.preventDefault();
                    $('html, body').animate({scrollTop:0}, 'slow');
                });
            })
        </script>
    </body>
</html>
