@extends('layouts.app') 
@push('css')
<link rel="stylesheet" href="{{ asset('dropzone\dist\min\dropzone.min.css')}}">
@endpush
@section('content') 
<section class=" hej"> 
    <form method="POST"  action="{{ route('upload.video')}}" class="dropzone hek " id="dropzoneForm" enctype="multipart/form-data">
    @csrf
    </form>
    <form  method="POST"  action="{{ route('upload.video')}}">
      @csrf
    <div class="detail-video">
    <h2>Add New IGTV Video</h2>
    <b>Cover</b><br><br>
    <p class="os fs-11">Must be a JPG or PNG file. The minimum recommended size is 492 x 762 pixels.</p>
    <br><br><br>
    <label for="dropzoneForm" class="text-blue cs">Edit</label><br>
    <div class="hex">
        <b>Details</b>
        <input type="text" placeholder="Title">
        <input type="text" placeholder="Description">
        <div class="clr hec">
            <input type="checkbox">
            <p>Post a Preview <br>Previews appear on your profile and feed</p> 
        </div>
    </div>
    <b>Where Your Video Will Appear</b>
    <div class="clr hec">
        <input type="radio" name="v_viewed" checked value="0">
        <p class="os">IGTV <br>ng.hung00</p> 
    </div>
    <div class="clr hec">
        <input type="radio" name="v_viewed" value="1">
        <span class="os fs-14" style="line-height:30px">IGTV and Facebook Page</span><br><a class="text-blue">Connect Page</a> 
    </div>
    <p class="os fs-11">Reach more people by making your videos visible on IGTV and your Facebook Page.</p><br><br>
    <b>Accessibility</b>
    <div class="hec">
    <input type="checkbox" value="1" name="v_status">Auto-Generated Captions
    <p class="fs-11">Auto-generated captions added to your video help people with hearing impairments. They are only available on the iOS and Android apps and may take a few minutes to appear.</p>
    </div> 
    <button type="submit" class="heb"  id="submit-all">Post</button>
    <a href="" class="text-blue">Save Draft</a>
    </div>
</form>
</section>
<footer>
    <ul class="fs-14">
        <li class="os"><a>About</a></li>
        <li class="os"><a>Blog</a></li>
        <li class="os"><a>Jobs</a></li>
        <li class="os"><a>Help</a></li>
        <li class="os"><a>Api</a></li>
        <li class="os"><a>Privacy</a></li>
        <li class="os"><a>Terms</a></li>
        <li class="os"><a>Top Accounts</a></li>
        <li class="os"><a>Hashtags</a></li>
        <li class="os"><a>Locations</a></li>
    </ul>
    <ul class="fs-14">
        <li class="os"><a>English</a></li>
        <li class="os">&copy; 2021 Instagram from Facebook</li> 
    </ul>
</footer>   
@endsection
@push('js')
<script>
   $('#video_upload').on('change',function(ev){ 
        var reader=new FileReader(); 
        reader.onload=function(ev){
          $('#video_image').attr('src',ev.target.result); 
        }
        reader.readAsDataURL(this.files[0]);   
            $('#myModal').hide();    
         
      });
</script>

<script src="{{ asset('dropzone\dist\min\dropzone.min.js')}}"></script> 

<script type="text/javascript">

Dropzone.options.dropzoneForm = {
    autoProcessQueue : false,
    maxFiles: 1,
    acceptedFiles : ".mp4,.mp3,.flv,.avi,.wmv,.mov,.jpg,'png','jpeg",

    init:function(){
      var submitButton = document.querySelector("#submit-all");
      myDropzone = this;

      submitButton.addEventListener('click', function(){
        myDropzone.processQueue();
      });

      this.on("complete", function(){
        if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
        {
          var _this = this;
          _this.removeAllFiles();
        } 
      });

    }

  };
  </script>
  @endpush