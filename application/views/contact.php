
    <section class="site-section">
      <div class="container">
        <div class="row mb-4" >
          <div class="col" style="text-align:center;">
            <h1>Contact Us</h1>

            <h6 style="font-family : 'Nanum Gothic';">문의 사항</h6>
            <h6 style="font-family : 'Nanum Gothic';">(답변은 입력된 email로 보내집니다)</h6>
          </div>
        </div>
        <br><br><br>
        <div class="row blog-entries">
          <div class="col-md-2"></div>
          
          <div class="col-md-8 main-content">
            
                <form action="/~sale24/prj/blog/contact" method="post">
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="name">Name</label> <span style="color : red;">*</span>
                      <input type="text" name="name" id="name" class="form-control" value="<?php echo set_value('name');?>">
                    </div>
                    <div class="col-md-12 form-group">
                      <label for="phone">Phone</label> <span style="color : red;">*</span>
                      <input type="text" name="phone" id="phone" class="form-control" value="<?php echo set_value('phone');?>">
                    </div>
                    <div class="col-md-12 form-group">
                      <label for="email">Email</label> <span style="color : red;">*</span>
                      <input type="email" name="email" id="email" class="form-control " value="<?php echo set_value('email');?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="message">Write Message</label> <span style="color : red;">*</span>
                      <textarea name="message" id="message" class="form-control " cols="30" rows="8"><?php echo set_value('message');?></textarea>
                    </div>
                  </div>

                  <?php echo validation_errors(); ?>

                  <div class="row">
                    <div class="col-md-12 form-group" style="text-align:center;">
                      <input type="submit" value="Send Message" class="btn btn-primary" >
                    </div>
                  </div>
                </form>
            

          </div>
          <div class="col-md-2"></div>

          <!-- END main-content -->

        </div>
      </div>
    </section>