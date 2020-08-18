<!DOCTYPE html>
<html>
<head>
  <title>OPMCM Login System </title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    .box{
      width:600px;
      margin:0 auto;
      border:1px solid #ccc;
    }
  </style>
</head>
<body style="background: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.7)), url('public/images/1.jpg'); background-repeat: no-repeat; background-size: cover; height: 100vh; display: flex; align-items: center;">
  <br />

  <div class="container box" style="height: 400px; width: 700px; border: 0px;">

    <div class="row">
      @if($errors->any())
      <div class="alert alert-danger">
        @foreach($errors->all() as $e)
        <li>{{$e}}</li>
        @endforeach
      </div>
      @endif
      @if(Session::has('userError'))
      <p class="alert alert-info"><li>These credentials do not match our records.</li></p>
      @endif
      @if(Session::has('change_success'))
      <p class="alert alert-success">Password Changed Successfully.Login Now</p>
      @endif
      <div class="col-md-6">  <!-- 8 is the width of the left side -->
        <div class="image-form" style="background: #fff;height:400px; border: 1px solid rgba(0,0,0,0.2);padding: 25px; box-shadow: 0 0 15px 0 rgba(0,0,0,0.1);">
          <img src="{{url(Request::root().'/'.$setting['logo_image'])}}" style="height: 100%; width:100%; object-fit:contain;">
        </div>

      </div>

      <div class="col-md-6" style="height:400px;">  <!-- 4 is the width of the right side -->

        <div class="login-form" style="background: #fff;width: 100%; height:100%; padding: 40px;display: flex;align-items:center;justify-content:center;text-align: center; border:1px solid rgba(0,0,0,0.1); box-shadow:0 0 15px 0 rgba(0,0,0,0.1);">



          @if(Session::has('success') && !empty(Session::get('success')))<br>
          <div class=" col-md-12 label label-danger" >{{ Session::get('success')}}</div>
          @endif



          <form method="post" action="{{ route('submit.login') }}" style="width: 100%;">


            <h3 align="center" style="margin-top: 0;"> Login</h3><br />

            {{ csrf_field() }}
            <div class="form-group">
              <label>Enter Username</label>
              <input type="text" name="user_name" class="form-control" />
            </div>
            <div class="form-group">
              <label>Enter Password</label>
              <input type="password" name="password" class="form-control" />
            </div>
            {{-- <div class="form-group">
              <label>Role</label>
              <select class="form-control" id="inputUserType3" placeholder="--select--" name="role">
                <option selected="" disabled="">Select Admin Role</option>
                @foreach($role as $role)
                <option value="{{$role->id}}">{!!$role->name!!}</option>
                @endforeach
              </select>
            </div> --}}

            <div class="form-group">
              <input type="submit" name="login" class="btn btn-primary" value="Login" />
            </div>
          </form>
        </div>

        

      </div>

    </div>

  </div>
</body>
</html>