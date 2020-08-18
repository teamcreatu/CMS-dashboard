<!DOCTYPE html>
<html>
<head>
  <title>Test</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link href="{{url('public/cd-admin/assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

</head>
<body>
  <form method="POST" action="{{route('add-custom-widgets')}}">
    @csrf
   <div id="dynamicInput">

  </div>
  <input type="button" value="Add another text input" onClick="addInput('dynamicInput');">
  <button class="btn btn-success">Save</button>
</form>
@for($i= 0;$i<=10;$i++)
<div id="modal-image{{$i}}" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">                    
      </div>
      <div class="modal-body">
        <div class="row">
          <div align="center">
            <h2>Member Widgets</h2>
          </div>
          @foreach($members as $m)
          <div class="col-md-3" style="border-style: dotted;" onclick="select{{$m['id']}}({{$i}})">
            <div class="col-md-3">
              <div class="footer-person-title">
                <h4 class="h4-fsc">Member Widget</h4>
              </div>
              <div class="footer-person-image">
                <img src="{{$m['image_url']}}" alt="" class="img img-fluid rounded" style="height: 70px; width: 70px;">
              </div>
              <div class="footer-person-detail">
                <h6 class="h6-fsc">{{$m['name']}}</h6>
                <p class="p-fsc">
                  @foreach($category as $c)
                  @if($c['id'] == $m['category_id'])
                  {{$c['name']}}
                  @endif
                  @endforeach
                </p>
              </div>
              <input type="hidden" name="link" id="widget_link{{$m['id']}}" value="{{url('http://localhost/git/opmcm/spokesperson/'.$m['id'])}}">
            </div>
            {{-- <img src="{{$p['image_url']}}" height="150px" width="200px" style="border: dotted; margin:auto;" onclick="writelink{{$p['id']}}()">
            <input type="hidden" name="link" id="image_link_modal{{$p['id']}}" value="{{$p['image_url']}}"> --}}
          </div>
          @endforeach
          <br>
          <div style="clear: both;">
            <div align="center">
              <h2>Contact Us Widget</h2>
            </div>
            <div class="col-md-3" style="border-style: dotted;" onclick="select({{$i}})">
              <div class="row">
                <div class="col-md-6 home-contact-left">
                  <h4 class="h4-fsc">Contact details</h4>
                  <p class="p-fsc">Contact us anytime</p>
                </div>

                <div class="col-md-6 home-contact-right">
                  <p class="p-fsc">In case of difficulty contact in</p>
                  <h4 class="h4-fsc">{{$contact['emergency_contact']}}</h4>
                </div>
              </div>

              <div class="home-contact-card">
                {!!$contact['description']!!}
              </div>
              <input type="hidden" name="link" id="contact_link" value="{{url('http://localhost/git/opmcm/contactus')}}">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endfor
</body>
<script src="{{url('public/cd-admin/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{url('public/cd-admin/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
  var counter = 0;
  var limit = 10;
  function addInput(divName){
   if (counter == limit)  {
    alert("You have reached the limit of adding " + counter + " inputs");
  }
  else {
    var newdiv = document.createElement('div');
    newdiv.setAttribute("id",'all'+counter);
    newdiv.innerHTML = '<div class="panel panel-default" id="inner'+counter+'">';
    newdiv.innerHTML+='';
    newdiv.innerHTML+='<br><div class="col-md-6"><div class="form-group">';
    newdiv.innerHTML+='<label class="col-md-3 control-label">Widget Title</label><div class="col-md-6">';
    newdiv.innerHTML+='<input type="text" class="form-control" name="widget_title['+counter+']" placeholder="Enter Widget Title">';
    newdiv.innerHTML+='</div>';
    newdiv.innerHTML+='</div><br><div class="form-group"><label class="col-md-3 control-label"> Widgetको शीर्षक <small>(देवानगिरिमा)</small></label><div class="col-md-6">';
    newdiv.innerHTML+='<input type="text" class="form-control" name="widget_title_ne[]" placeholder="Widget प्रविष्ट गर्नुहोस्">';
    newdiv.innerHTML+= '</div>';
    newdiv.innerHTML+='</div><br></div><div class="col-md-6"><div class="form-group"><label class="col-md-3 control-label">Widgets</label><div class="col-md-6">';
    newdiv.innerHTML+=  '<input type="url" name="widgets['+counter+']" value="" id="choose_widget'+counter+'" class="form-control">';
    newdiv.innerHTML+='<div class="col-md-1"><a href="#modal-image'+ counter +'" data-toggle="modal"><span class="btn btn-primary">Choose</span></a></div></div>';
    newdiv.innerHTML+='</div></div><div align="center">';
    newdiv.innerHTML+='<span class="btn btn-danger" id="remove_button" onclick="remove('+counter+')">Delete</span></div>';
    document.getElementById(divName).appendChild(newdiv);
    counter++;
  }
}
  function remove(i) {
    var input= document.getElementById('all'+i);
    input.parentNode.removeChild(input);
  }

</script>

@foreach($members as $m)
    <script type="text/javascript">
      function select{{$m['id']}}(i)
      { 
        var link = document.getElementById('widget_link{{$m['id']}}');
        document.getElementById('choose_widget'+i).value = link.value;
      }
    </script>
    <script type="text/javascript">
      function select(i)
      { 
        var link = document.getElementById('contact_link');
        alert('choose_widget'); 
        document.getElementById('choose_widget'+i).value = link.value;
      }
    </script>
    @endforeach
    </script>
</html>