<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>회원가입</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/~sale24/prj/my/lib/skydash/vendors/feather/feather.css">
  <link rel="stylesheet" href="/~sale24/prj/my/lib/skydash/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="/~sale24/prj/my/lib/skydash/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/~sale24/prj/my/lib/skydash/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/~sale24/prj/my/lib/skydash/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="/~sale24/prj/my/lib/skydash/images/logo.svg" alt="logo">
              </div>
              <h3>회원가입</h3>
              <!-- <h6 class="font-weight-light">환영합니다!</h6> -->
              <form class="pt-3" action="/~sale24/prj/user/signup" method="post" name="signupForm">
                <div class="form-group">
                  <input type="text" value="<?=set_value('name')?>" name="name" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="이름 *">
                </div>
                <div class="form-group">
                  <input type="email" value="<?=set_value('email')?>" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="email *">
                </div>
                <!-- <div class="form-group">
                  <select class="form-control form-control-lg" id="exampleFormControlSelect2">
                    <option>Country</option>
                    <option>United States of America</option>
                    <option>United Kingdom</option>
                    <option>India</option>
                    <option>Germany</option>
                    <option>Argentina</option>
                  </select>
                </div> -->
                <div class="form-group">
                  <input type="password" value="<?=set_value('password')?>" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="비밀번호 *">
                </div>
                <div class="form-group">
                  <input type="password" value="<?=set_value('password_check')?>" name="password_check" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="비밀번호 확인 *">
                </div>
                <div class="form-group">
                  <input type="text" value="<?=set_value('mini_content')?>" name="mini_content" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="짧은 소개">
                </div>
                <div class="mb-4">
                  <div class="form-check">
                  <input type="checkbox" class="form-check-input" style="margin-left : 5px" name="agreement">
                    <label class="form-check-label text-muted" >
                      회원 정보 제공에 동의합니다.
                    </label>
                    <br>
                    <div style="color : red"><?php echo validation_errors(); ?></div>
                  </div>
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="/~sale24/prj/user/signup">SIGN UP</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  이미 회원가입 하셨나요? <a href="/~sale24/prj/blog?loginerror" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="./~sale24/prj/my/lib/skydash/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="/~sale24/prj/my/lib/skydash/js/off-canvas.js"></script>
  <script src="/~sale24/prj/my/lib/skydash/js/hoverable-collapse.js"></script>
  <script src="/~sale24/prj/my/lib/skydash/js/template.js"></script>
  <script src="/~sale24/prj/my/lib/skydash/js/settings.js"></script>
  <script src="/~sale24/prj/my/lib/skydash/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
