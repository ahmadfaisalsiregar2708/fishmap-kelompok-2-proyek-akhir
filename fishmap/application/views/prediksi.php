        <!-- ============================ Page Title Start================================== -->
        <section class="page-title bg-cover" data-overlay="8">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12 col-md-12">

                      <div class="breadcrumbs-wrap">
                          <h1 class="breadcrumb-title text-light">Prediksi</h1>
                          <nav class="transparent">
                              <ol class="breadcrumb p-0">
                                  <li class="breadcrumb-item"><a href="{$BASEURL}" class="text-light">Beranda</a></li>
                                  <li class="breadcrumb-item active theme-cl" aria-current="page">Prediksi</li>
                              </ol>
                          </nav>
                      </div>

                  </div>
              </div>
          </div>
      </section>
      <!-- ============================ Page Title End ================================== -->

      <!-- ============================ Start ================================== -->
      <iframe src="https://share.streamlit.io/ahmadfaisalsiregar2708/python_app/ahmad/app.py" width="100%" height="2300" style="border:none;"></iframe>
      <!--<section class="min">-->
        <!--<div class="container">-->
            <!--<iframe src="https://aplikasiprediksi.herokuapp.com/" width="100%" height="1080" style="border:none;"></iframe>-->
            <!--<div class="row">-->
            <!--    <div class="col-lg-3 col-md-3 col-sm-3">                                             -->
            <!--        <form method="post" action="https://aplikasiprediksi.herokuapp.com/" enctype='multipart/form-data'>                        -->
            <!--            <input type="hidden" name="{$csrf.name|default:''}" value="{$csrf.hash|default:''}" />                    -->
                        <!-- <input class="btn theme-bg rounded full-width" type="submit" value="Lihat Prediksi >>" name="GO" />                         -->
            <!--            <input class="btn theme-bg rounded full-width" type="button" onclick="window.open ('https://aplikasiprediksi.herokuapp.com')" value="Lihat Prediksi >>" />                         -->
            <!--        </form>                                                              -->
                    
            <!--    </div>-->
            <!--</div>          -->
        <!--</div>-->
      <!--</section>-->
      <div class="clearfix"></div>
      <!-- ============================ End ================================== -->
      
      <?php 
        if(isset($_POST['GO']))        		
        {
            shell_exec("python -m streamlit run python_app/app.py");	      
        }  
      ?>

      