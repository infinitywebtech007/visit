    @extends('layouts.app')

    @section('content')
    <div class="container-fluid">
        <h1>Add Visitor</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('visitors.store') }}" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                    @csrf
                                    <div class="form-group mb-3 ">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                    <div class="form-group mb-3 ">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                    <div class="form-group mb-3 ">
                                        <label for="mobile" class="form-label">Mobile</label>
                                        <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile') }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                    <div class="form-group mb-3 ">
                                        <label for="address" class="form-label">Address</label>
                                        {{-- <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}"> --}}
                                        <textarea name="address" id="address" class="form-control" >{{ old('address') ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">

                                    <div class="form-group mb-3 ">
                                        <label for="company_name" class="form-label">Company Name</label>
                                        <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name') }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                    <div class="form-group mb-3 ">
                                        <label for="photo_url" class="form-label">Photo</label>
                                        <input type="file" class="form-control" id="photo_url" name="photo_url" accept="image/*" capture="environment" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group mb-3 ">
                                        <label for="id_proof" class="form-label">ID Proof Type</label>
                                        <select name="id_proof" class="form-control" id="id_prood">
                                            <option value="" selected disabled>-</option>
                                            <option value="aadhaar_card">Aadhaar Card</option>
                                            <option value="pan_card">PAN Card</option>
                                            <option value="passport">Passport</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group mb-3 ">
                                        <label for="id_proof_img" class="form-label">ID Proof Image </label>
                                        <input type="file" class="form-control" id="id_proof_img" name="id_proof_img" accept="image/*" capture="environment" />
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <button type="submit" class="btn btn-primary">Add Visitor</button>
                                    <a href="{{ route('visitors.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                            <input type="hidden" name="webcam_photo" id="webcam_photo">

                        </form>                                   
                
                    </div>
                </div>
            </div>
        </div>

    </div>

    <h2>Camera Capture</h2>
    <video id="video" width="640" height="480" autoplay></video><br>
    <button id="capture">Take Photo</button>
    <canvas id="canvas" width="640" height="480"></canvas>
    <img id="photo" alt="Captured photo will appear here">
    
    {{-- <script src="script.js"></script> --}}
    <script>
    // Get DOM elements
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureButton = document.getElementById('capture');
    const photo = document.getElementById('photo');

    // Access the camera
    navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
        video.srcObject = stream;
    })
    .catch(err => {
        console.error("Error accessing camera: ", err);
        alert("Camera access denied or not available.");
    });

    // Capture photo when button is clicked
    captureButton.addEventListener('click', () => {
    const context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    
    // Convert canvas to data URL and display in <img>
    const dataUrl = canvas.toDataURL('image/png');
    photo.src = dataUrl;
    });   

    
    </script>

    <script>
captureButton.addEventListener('click', () => {
    const context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    // Convert canvas to base64
    const dataUrl = canvas.toDataURL('image/jpeg');  // can use 'image/png' too

    // Show preview in <img>
    photo.src = dataUrl;

    // Save it in the hidden input
    document.getElementById('webcam_photo').value = dataUrl;
});

    </script>
    @endsection
