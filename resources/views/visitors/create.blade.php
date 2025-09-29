@extends('layouts.app')

@section('content')
<style>
    .visitor-form-container {
        background: #f4f6f9;
        min-height: 100vh;
        padding: 20px 0;
    }

    .content-wrapper {
        background: #f4f6f9;
    }

    .content-header {
        background: white;
        padding: 15px 20px;
        margin-bottom: 20px;
        border-bottom: 1px solid #dee2e6;
    }

    .content-header h1 {
        margin: 0;
        font-size: 24px;
        font-weight: 300;
        color: #333;
    }

    .visitor-form-card {
        background: white;
        border: none;
        box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        margin-bottom: 20px;
    }

    .visitor-form-header {
        background: #3c8dbc;
        color: white;
        padding: 15px 20px;
        border-bottom: 1px solid #367fa9;
    }

    .visitor-form-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 500;
    }

    .visitor-form-body {
        padding: 20px;
    }

    .form-section {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 3px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .section-title {
        background: #e9ecef;
        color: #495057;
        padding: 8px 12px;
        margin: -15px -15px 15px -15px;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #dee2e6;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
        color: #333;
        font-size: 14px;
    }

    .form-control {
        display: block;
        width: 100%;
        padding: 8px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    }

    .form-control:focus {
        border-color: #3c8dbc;
        outline: 0;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 0 3px rgba(60,141,188,.1);
    }

    .form-control-sm {
        padding: 5px 10px;
        font-size: 12px;
        border-radius: 3px;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }

    .camera-section {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 3px;
        padding: 15px;
        margin: 20px 0;
        text-align: center;
    }

    .camera-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .camera-video {
        width: 100%;
        max-width: 500px;
        height: auto;
        border: 2px solid #dee2e6;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    .camera-controls {
        margin: 15px 0;
    }

    .btn {
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        border: 1px solid transparent;
        border-radius: 4px;
        text-decoration: none;
        transition: all .15s ease-in-out;
    }

    .btn-primary {
        color: #fff;
        background-color: #3c8dbc;
        border-color: #3c8dbc;
    }

    .btn-primary:hover {
        background-color: #367fa9;
        border-color: #367fa9;
    }

    .btn-success {
        color: #fff;
        background-color: #00a65a;
        border-color: #00a65a;
    }

    .btn-success:hover {
        background-color: #008d4c;
        border-color: #008d4c;
    }

    .btn-default {
        color: #333;
        background-color: #fff;
        border-color: #ccc;
    }

    .btn-default:hover {
        background-color: #e6e6e6;
        border-color: #adadad;
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 12px;
        line-height: 1.5;
        border-radius: 3px;
    }

    .photo-preview {
        max-width: 300px;
        border: 2px solid #dee2e6;
        border-radius: 4px;
        margin-top: 15px;
        box-shadow: 0 2px 4px rgba(0,0,0,.1);
    }

    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }

    .file-input-wrapper input[type=file] {
        position: absolute;
        left: -9999px;
    }

    .file-input-label {
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 4px;
        padding: 15px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #666;
        font-weight: 500;
        display: block;
        margin-top: 10px;
    }

    .file-input-label:hover {
        border-color: #3c8dbc;
        background: #f0f8ff;
        color: #3c8dbc;
    }

    .file-input-icon {
        font-size: 24px;
        margin-bottom: 8px;
        display: block;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }

    .alert-danger ul {
        margin: 0;
        padding-left: 20px;
    }

    .id-proof-section {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 3px;
        padding: 15px;
        margin: 20px 0;
        border-left: 4px solid #3c8dbc;
    }

    .form-actions {
        padding-top: 20px;
        border-top: 1px solid #dee2e6;
        text-align: center;
    }

    .form-actions .btn {
        margin: 0 5px;
    }

    .camera-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin: 20px 0;
    }

    .camera-item {
        text-align: center;
    }

    .camera-item h5 {
        color: #3c8dbc;
        font-weight: 600;
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .visitor-form-body {
            padding: 15px;
        }

        .camera-video {
            max-width: 100%;
        }

        .photo-preview {
            max-width: 100%;
        }

        .camera-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }

    @media (min-width: 1200px) {
        .form-row {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>

<div class="visitor-form-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="visitor-form-card">
                    <div class="visitor-form-header">
                        <h3><i class="fas fa-user-plus"></i> Add New Visitor</h3>
                    </div>
                    <div class="visitor-form-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong><i class="fas fa-exclamation-triangle"></i> Please fix the following errors:</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('visitors.store') }}" method="POST" enctype="multipart/form-data" id="visitorForm">
                            @csrf

                            <!-- Personal Information Section -->
                            <div class="form-section">
                                <div class="section-title">
                                    <i class="fas fa-id-card"></i> Personal Information
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="name">
                                            <i class="fas fa-user"></i> Full Name <span class="text-danger">*</span>
                                        </label>
                                        <input required type="text" name="name" id="name" class="form-control"
                                               value="{{ old('name') }}" required placeholder="Enter visitor's full name">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">
                                            <i class="fas fa-envelope"></i>Email Address<span class="text-danger">*</span></label>
                                        <input required type="email" name="email" id="email" class="form-control"
                                               value="{{ old('email') }}"  placeholder="visitor@example.com">
                                    </div>

                                    <div class="form-group">
                                        <label for="mobile">
                                            <i class="fas fa-phone"></i> Mobile Number<span class="text-danger">*</span></label>
                                        <input required type="text" name="mobile" id="mobile" class="form-control"
                                               value="{{ old('mobile') }}" placeholder="+1 (555) 123-4567">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="address">
                                        <i class="fas fa-map-marker-alt"></i> Address<span class="text-danger">*</span></label>
                                    <textarea required name="address" id="address" class="form-control"
                                              placeholder="Enter visitor's complete address">{{ old('address') ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="company_name">
                                        <i class="fas fa-building"></i>Company Name<span class="text-danger">*</span></label>
                                    <input type="text" name="company_name" id="company_name" class="form-control"
                                           value="{{ old('company_name') }}" placeholder="Company name (optional)">
                                </div>
                            </div>

                            <!-- Camera Capture Section -->
                            <div class="camera-section">
                                <div class="section-title">
                                    <i class="fas fa-camera"></i> Photo & ID Capture<span class="text-danger">*</span>
                                </div>

                                <div class="camera-grid">
                                    <!-- Visitor Photo Camera -->
                                    <div class="camera-item">
                                        <h5><i class="fas fa-user"></i> Visitor Photo<span class="text-danger">*</span></h5>
                                        <video id="video" class="camera-video" width="640" height="480" autoplay muted></video>

                                        <div class="camera-controls">
                                            <button type="button" id="capture" class="btn btn-success">
                                                <i class="fas fa-camera"></i> Capture Photo
                                            </button>
                                            <button type="button" id="retake" class="btn btn-default" style="display: none;">
                                                <i class="fas fa-redo"></i> Retake Photo
                                            </button>
                                        </div>

                                        <canvas id="canvas" width="640" height="480" style="display: none;"></canvas>
                                        <img id="photo" alt="Captured photo will appear here" class="photo-preview" style="display: none;">

                                        <div class="form-group">
                                            <label for="photo_url">
                                                <i class="fas fa-upload"></i> Or Upload Photo
                                            </label>
                                            <div class="file-input-wrapper">
                                                <input type="file" class="form-control" id="photo_url" name="photo_url"
                                                       accept="image/*" capture="environment">
                                                <label for="photo_url" class="file-input-label">
                                                    <i class="fas fa-cloud-upload-alt file-input-icon"></i>
                                                    <span>Click to upload or drag and drop</span>
                                                    <small class="d-block mt-1">PNG, JPG up to 5MB</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ID Proof Camera -->
                                    <div class="camera-item">
                                        <h5><i class="fas fa-id-card"></i> ID Proof Photo<span class="text-danger">*</span></h5>
                                        <video id="idVideo" class="camera-video" width="640" height="480" autoplay muted></video>

                                        <div class="camera-controls">
                                            <button type="button" id="captureId" class="btn btn-success">
                                                <i class="fas fa-camera"></i> Capture ID
                                            </button>
                                            <button type="button" id="retakeId" class="btn btn-default" style="display: none;">
                                                <i class="fas fa-redo"></i> Retake ID
                                            </button>
                                        </div>

                                        <canvas id="idCanvas" width="640" height="480" style="display: none;"></canvas>
                                        <img id="idPhoto" alt="Captured ID will appear here" class="photo-preview" style="display: none;">

                                        <div class="form-group">
                                            <label for="id_proof_img">
                                                <i class="fas fa-upload"></i> Or Upload ID Image
                                            </label>
                                            <div class="file-input-wrapper">
                                                <input type="file" class="form-control" id="id_proof_img" name="id_proof_img"
                                                       accept="image/*" capture="environment">
                                                <label for="id_proof_img" class="file-input-label">
                                                    <i class="fas fa-cloud-upload-alt file-input-icon"></i>
                                                    <span>Upload ID proof image</span>
                                                    <small class="d-block mt-1">Clear image of ID document</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ID Proof Section -->
                            <div class="id-proof-section">
                                <div class="section-title">
                                    <i class="fas fa-id-badge"></i> Identity Verification
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="id_proof">
                                            <i class="fas fa-file-alt"></i> ID Proof Type<span class="text-danger">*</span>
                                        </label>
                                        <select required name="id_proof" class="form-control" id="id_proof">
                                            <option value="" selected disabled>-- Select ID Type --</option>
                                            <option value="aadhaar_card" {{ old('id_proof') == 'aadhaar_card' ? 'selected' : '' }}>
                                                Aadhaar Card
                                            </option>
                                            <option value="pan_card" {{ old('id_proof') == 'pan_card' ? 'selected' : '' }}>
                                                PAN Card
                                            </option>
                                            <option value="passport" {{ old('id_proof') == 'passport' ? 'selected' : '' }}>
                                                Passport
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="id_proof_number">
                                            <i class="fas fa-hashtag"></i> ID Proof Number<span class="text-danger">*</span>
                                        </label>
                                        <input required type="text" name="id_proof_number" id="id_proof_number" class="form-control"
                                               value="{{ old('id_proof_number') }}" placeholder="Enter ID number">
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Add Visitor
                                </button>
                                <a href="{{ route('visitors.index') }}" class="btn btn-default">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>

                            <input required type="" class="d-none" name="webcam_photo" id="webcam_photo">
                            <input required type="" class="d-none" name="webcam_id_photo" id="webcam_id_photo">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get DOM elements for visitor photo
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureButton = document.getElementById('capture');
    const retakeButton = document.getElementById('retake');
    const photo = document.getElementById('photo');
    const photoInput = document.getElementById('photo_url');

    // Get DOM elements for ID proof photo
    const idVideo = document.getElementById('idVideo');
    const idCanvas = document.getElementById('idCanvas');
    const captureIdButton = document.getElementById('captureId');
    const retakeIdButton = document.getElementById('retakeId');
    const idPhoto = document.getElementById('idPhoto');
    const idPhotoInput = document.getElementById('id_proof_img');

    let stream = null;
    let idStream = null;

    // Initialize camera with back camera preference
    async function initCamera(videoElement, facingMode = 'environment') {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    width: { ideal: 1280 },
                    height: { ideal: 720 },
                    facingMode: facingMode
                }
            });
            videoElement.srcObject = stream;
            return stream;
        } catch (err) {
            console.error("Error accessing camera: ", err);
            // Fallback to default camera if back camera fails
            try {
                const fallbackStream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    }
                });
                videoElement.srcObject = fallbackStream;
                return fallbackStream;
            } catch (fallbackErr) {
                console.error("Error accessing fallback camera: ", fallbackErr);
                alert("Camera access denied or not available. You can still upload photos manually.");
                return null;
            }
        }
    }

    // Initialize both cameras
    async function initCameras() {
        // Initialize visitor photo camera (default back camera)
        stream = await initCamera(video, 'environment');

        // Initialize ID proof camera (default back camera)
        idStream = await initCamera(idVideo, 'environment');
    }

    // Capture visitor photo
    captureButton.addEventListener('click', function() {
        if (!stream) return;

        const context = canvas.getContext('2d');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        const dataUrl = canvas.toDataURL('image/jpeg', 0.9);
        photo.src = dataUrl;
        photo.style.display = 'block';

        document.getElementById('webcam_photo').value = dataUrl;

        captureButton.style.display = 'none';
        retakeButton.style.display = 'inline-block';

        stream.getTracks().forEach(track => track.stop());
        video.style.display = 'none';
    });

    // Retake visitor photo
    retakeButton.addEventListener('click', function() {
        photo.src = '';
        photo.style.display = 'none';
        document.getElementById('webcam_photo').value = '';

        retakeButton.style.display = 'none';
        captureButton.style.display = 'inline-block';

        video.style.display = 'block';
        initCamera(video, 'environment').then(newStream => {
            stream = newStream;
        });
    });

    // Capture ID proof photo
    captureIdButton.addEventListener('click', function() {
        if (!idStream) return;

        const context = idCanvas.getContext('2d');
        idCanvas.width = idVideo.videoWidth;
        idCanvas.height = idVideo.videoHeight;
        context.drawImage(idVideo, 0, 0, idCanvas.width, idCanvas.height);

        const dataUrl = idCanvas.toDataURL('image/jpeg', 0.9);
        idPhoto.src = dataUrl;
        idPhoto.style.display = 'block';

        document.getElementById('webcam_id_photo').value = dataUrl;

        captureIdButton.style.display = 'none';
        retakeIdButton.style.display = 'inline-block';

        idStream.getTracks().forEach(track => track.stop());
        idVideo.style.display = 'none';
    });

    // Retake ID proof photo
    retakeIdButton.addEventListener('click', function() {
        idPhoto.src = '';
        idPhoto.style.display = 'none';
        document.getElementById('webcam_id_photo').value = '';

        retakeIdButton.style.display = 'none';
        captureIdButton.style.display = 'inline-block';

        idVideo.style.display = 'block';
        initCamera(idVideo, 'environment').then(newStream => {
            idStream = newStream;
        });
    });

    // Handle visitor photo file input
    photoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                photo.src = e.target.result;
                photo.style.display = 'block';
                document.getElementById('webcam_photo').value = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Handle ID proof file input
    idPhotoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                idPhoto.src = e.target.result;
                idPhoto.style.display = 'block';
                document.getElementById('webcam_id_photo').value = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Initialize cameras on page load
    initCameras();

    // Form validation enhancement
    const form = document.getElementById('visitorForm');
    form.addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();

        if (!name) {
            e.preventDefault();
            alert('Please fill in all required fields.');
            return false;
        }

        if(email){
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert('Please enter a valid email address.');
                return false;
            }
        }
        // Email validation
    });
});
</script>
@endsection
