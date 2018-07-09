@extends('emails.templates.layout1')



@section('content')


  <div class="login-box">
    <div class="login-box-body">    
    	<div class="row">    
    		<p> Click here to reset your password: 

          {{-- url('password/reset/'.$token) --}}

          <!--button-->
          <table class="m--row" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
            <tr>
              <th class="m--col" align="center" valign="middle" width="100%" style="border-collapse:collapse;padding:0;font-size:1px;line-height:1px;font-weight:normal;width:100%;">
                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                  <tr>
                    <td align="center" valign="middle" style="border-collapse:collapse;font-size:1px;line-height:1px;padding:10px;">
                      <table border="0" cellspacing="0" cellpadding="0" class="m--button" style="border-collapse:separate;">
                        <tr>
                          <td align="center" style="-moz-border-radius:20px;-webkit-border-radius:20px;border-radius:20px;font-size:14px;padding:12px 15px;" bgcolor="#8fcb49">
                            <a href="{{ url('password/reset/'.$token) }}" target="_blank" style="font-size:12px;line-height:12px;padding:6px 9px;font-weight:bold;font-family:Arial;color:#ffffff;text-decoration: none;-moz-border-radius:20px;-webkit-border-radius:20px;border-radius:20px;display:block;">
                              <span style="color: #ffffff;"><!--[if mso]>&nbsp;<![endif]-->

                                Reset Password!

                              <!--[if mso]>&nbsp;<![endif]-->
                              </span>
                            </a>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </th>
            </tr>
          </table>
        </p>
    	</div>
      <!--div class="login-logo">
        <a href="{{-- URL::to('/auth/login') --}}"><b>Login</b></a>
      </div-->
    </div>
  </div>



  <!--script src="{{-- asset('/admin/plugins/jQuery/jQuery-2.2.0.min.js') --}}"></script>
  <script src=" {{-- asset('/admin/bootstrap/js/bootstrap.min.js') --}}"></script>
  <script src="{{-- asset('/admin/plugins/iCheck/icheck.min.js') --}}"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script-->


@endsection
