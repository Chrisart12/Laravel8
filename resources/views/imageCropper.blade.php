@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" enctype="multipart/form-data" action="{{ route('upload_image') }}" id="image_form">
                @csrf
                <div class="form-group row">
                    <label for="image"  class="col-md-4 col-form-label text-md-right"> {{ __('Télécharger une image') }}</label>

                    <div class="col-md-6">
                        <input type="file" name="image" class="form-control-file @error('email') is-invalid @enderror"
                        id="image" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div>
                    <button type="submit" id="submit_image" class="btn btn-block btn-dark">Valider</button>
                </div>
            </form>

            <div class="card">
                <div class="card-header">{{ __('Pays') }}</div>

                {{-- <div class="card-body"> --}}
                    {{-- @if ($user->picture) --}}
                        {{-- <img src="/images/{{ $user->id }}/{{ $user->picture }}" alt="Photo" /> --}}
                        {{-- <img class="studentPicture_picture" src="{{ url('/images/' . $user->id . '/' . $user->picture )}}"> --}}
                        {{-- <img class="image" src="{{asset("resources/user_" . $user->id . '/' . $user->picture) }}"> --}}
                        {{-- <img src="{{ URL::to('/') }}images/{{ $user->id }}/{{ $user->picture }}" /> --}}
                    {{-- @endif --}}



                {{-- </div> --}}
            {{-- </div>
        </div>  --}}

        <div class="container" align="center">
			<br />
			<h3 align="center">RECADRER VOTRE IMAGE APRES TELECHARGEMENT</h3>
			<br />
			<div class="row">
				<div class="col-md-4">&nbsp;</div>
				<div class="col-md-4">
					<div class="image_area">
						<form method="post">
							<label for="upload_image">
                                @if ($user->picture)
                                    <img class="image" id="uploaded_image" src="{{asset("resources/user_" . $user->id . '/' . $user->picture) }}">
                                @else
                                    <img src="{{ asset('images/icons/user.png') }}" id="uploaded_image" class="img-responsive img-circle" />
                                @endif

								<div class="overlay">
									<div class="text">Click to Change Profile Image</div>
								</div>
								<input type="file" name="image" class="image" id="upload_image" style="display:none" />
							</label>
						</form>
					</div>
			    </div>
    		<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h5 class="modal-title">Crop Image Before Upload</h5>
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          			<span aria-hidden="true">×</span>
			        		</button>
			      		</div>
			      		<div class="modal-body">
			        		<div class="img-container">
			            		<div class="row">
			                		<div class="col-md-8">
			                    		<img src="" id="sample_image" />
			                		</div>
			                		<div class="col-md-4">
			                    		<div class="preview"></div>
			                		</div>
			            		</div>
			        		</div>
			      		</div>
			      		<div class="modal-footer">
			      			<button type="button" id="crop" class="btn btn-primary">Envoyer</button>
			        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
			      		</div>
			    	</div>
			  	</div>
			</div>
		</div>
    </div>
</div>
@endsection

<script defer src="{{ asset('js/pays.js') }}" ></script>
<script defer src="{{ asset('js/image.js') }}" ></script>
{{-- <script defer src="{{ asset('js/image.js') }}" ></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>

    $(document).ready(function(){


        urlUpload = Myjavascript.projet_url + 'upload_image_crop';

        var $modal = $('#modal');

        var image = document.querySelector('#sample_image');
        const upload_image = document.querySelector('#upload_image');


        var cropper;

        $('#upload_image').change(function(event){
            var files = event.target.files;

            var done = function(url){
                image.src = url;
                $modal.modal('show');
            };

            if(files && files.length > 0)
            {
                const reader = new FileReader();
                reader.onload = function(event)
                {
                    done(reader.result);
                };

                reader.readAsDataURL(files[0]);
            }
        });

        upload_image.addEventListener('change', function (event) {

            let files = event.target.files;

            var done = function(url){
                image.src = url;
                $modal.modal('show');
            };


                if(files && files.length > 0)
                {
                    const reader = new FileReader();

                    reader.onload = function(event) {
                    const imgElment  =  document.createElement('img')
                    imgElment.src = event.target.result;

                            imgElment.onload = function(e) {
                            const canvas = document.createElement("canvas");

                            const MAX_WIDTH = 600;

                            const scaleSize = MAX_WIDTH / e.target.width;
                            canvas.width = MAX_WIDTH;
                            canvas.height = e.target.height * scaleSize;

                            const ctx = canvas.getContext("2d");
                            ctx.drawImage(e.target, 0, 0, canvas.width, canvas.height);
                            // console.log("original", e.target)

                            const srcEncoded = ctx.canvas.toDataURL(e.target, "image/jpeg");
                            // console.log("minimisée",srcEncoded)
                            done(srcEncoded);
                        }
                    }
                    reader.readAsDataURL(files[0]);
                }
        })


        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview:'.preview'
            });
        }).on('hidden.bs.modal', function(){
            cropper.destroy();
                cropper = null;
        });

        $('#crop').click(function(){
            canvas = cropper.getCroppedCanvas({
                width:400,
                height:400
            });

            canvas.toBlob(function(blob){
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function(){
                    var base64data = reader.result;

                    // $.ajax({
                    //     url: urlUpload,
                    //     method:'POST',
                    //     data:{image:base64data},
                    //     success:function(data)
                    //     {

                    //         $modal.modal('hide');
                    //         $('#uploaded_image').attr('src', data);
                    //     }
                    // });


                let token = document.querySelector('meta[name="csrf-token"]').content;

                // let url =  Myjavascript.projet_url + "upload_image";

                fetch(urlUpload, {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },

                    method: 'post',
                    body: JSON.stringify({
                        image: base64data,
                    })

                }).then(response => {

                    response.json().then(data => {
                    console.log("llllllllllllllllll", data)
                        $modal.modal('hide');
                        window.location.href = Myjavascript.projet_url + "imageCropper";
                        // console.log(data)
                    })


                }).catch(error => {
                    console.log(error)
                })




                };
            });
        });

    });
    </script>

