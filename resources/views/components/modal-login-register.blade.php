@guest
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <i class="fas fa-times"></i>
              </button>

              <div class="modal-body">
                  <div class="login-logo text-center">
                      <img src="{{ asset('front/images/logo.png') }}" alt="">
                      <h3>عضو جديد</h3>
                  </div>

                  <div class="alert alert-info text-center d-none" id="info-alert" role="alert">
                      {{ __('dashboard.please_wait_your_membership_has_been_successfully_registered_and_a_confirmation_message_is_being_sent_to_your_email_and_you_will_be_transferred_after_five_seconds') }}
                  </div>

                  <form id="register-form" action="" class="login-form mt-5">
                      @csrf
                      <div class="login-input mb-4">
                          <input id="name" type="text" name="name" class="form-control" placeholder="الاسم">
                          <img src="{{ asset('front/images/form/signature.svg') }}" alt="">
                      </div>
                      <div class="login-input mb-4">
                          <input id="email" type="email" name="email" class="form-control"
                              placeholder="البريد الإلكترونى">
                          <img src="{{ asset('front/images/form/mail-inbox-app.svg') }}" alt="">
                      </div>
                      <div class="login-input mb-4">
                          <input id="password" type="password" name="password" class="form-control"
                              placeholder="الرقم السرى">
                          <img src="{{ asset('front/images/form/lock.svg') }}" alt="">
                      </div>
                      <div class="login-input mb-4">
                          <input id="password_confirmation" type="password" name="password_confirmation"
                              class="form-control" placeholder="تأكيد الرقم السرى">
                          <img src="{{ asset('front/images/form/lock.svg') }}" alt="">
                      </div>

                      <div class="login-input mb-4">
                          <input id="startup_name" type="text" name="startup_name" class="form-control"
                              placeholder="اسم الستارت اب">
                          <img src="{{ asset('front/images/form/signature.svg') }}" alt="">
                      </div>

                      @foreach ($sectors as $key => $sector)
                          <div class="form-check">
                              <label class="form-check-label" for="{{ $key }}">
                                  {{ $sector['sector_name'] }}
                              </label>
                              <input name="sector_ids[]" class="form-check-input" type="checkbox"
                                  value="{{ $sector['id'] }}" id="{{ $key }}">
                          </div>
                      @endforeach

                      <div class="login-input mb-4">
                          <select name="city_id" class="form-select" aria-label="Default select example">
                              <option selected>Open this select menu</option>
                              @foreach ($cities as $city)
                                  <option value="{{ $city['id'] }}">{{ $city['city_name'] }}</option>
                              @endforeach
                          </select>
                      </div>

                      <div class="login-input mb-4">
                          <input id="startup_logo" type="file" name="startup_logo" class="form-control">
                      </div>


                      <input type="submit" value="{{ __('dashboard.register') }}" id="submit-register">
                      <span class="forget-pass d-block text-center mt-4 mb-5">لديك حساب بالفعل؟ <a href="#"
                              class="go-to-signup-login">تسجيل الدخول</a>
                      </span>
                  </form>
              </div>

              <div class="modal-body login-body">
                  <div class="login-logo text-center">
                      <img src="{{ asset('front/images/logo.png') }}" alt="" srcset="">
                      <h3>تسجيل الدخول</h3>
                  </div>

                  <div class="login-input text-center text-danger" id="login-wrong-message">

                  </div>

                  <div class="alert alert-info text-center d-none" id="success-alert" role="alert">
                      {{ __('dashboard.please_wait_logged_in_successfully_you_will_be_transferred_after_a_few_seconds') }}
                  </div>

                  <form id="login-form" class="login-form mt-5">
                      @csrf
                      <div class="login-input mb-4">
                          <input type="email" name="email" class="form-control" placeholder="البريد الإلكترونى">
                          <img src="{{ asset('front/images/form/mail-inbox-app.svg') }}" alt="" srcset="">
                      </div>
                      <div class="login-input mb-4">
                          <input type="password" name="password" class="form-control" placeholder="الرقم السرى">
                          <img src="{{ asset('front/images/form/lock.svg') }}" alt="" srcset="">
                      </div>
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="remember" id="rememberme">
                          <label class="form-check-label" for="rememberme">
                              تذكرنى
                          </label>
                      </div>
                      <input type="submit" value="{{ __('dashboard.login') }}" id="submit-login">
                  </form>
              </div>
          </div>
      </div>
  </div>
@endguest
