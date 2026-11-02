
@extends('layouts.mainlayout')

@section('content')

<style>
.edit-page {
    background: #f5f7fb;
    min-height: 100vh;
    padding: 30px;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.page-header h2 {
    font-size: 25px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 5px;
}

.page-header p {
    color: #64748b;
    margin: 0;
    font-size: 14px;
}

.settings-card {
    background: #fff;
    border: 1px solid #e8edf4;
    border-radius: 14px;
    padding: 25px;
    margin-bottom: 22px;
    box-shadow: 0 3px 15px rgba(15, 23, 42, 0.035);
}

.section-heading {
    display: flex;
    align-items: center;
    gap: 12px;
    padding-bottom: 18px;
    margin-bottom: 22px;
    border-bottom: 1px solid #edf0f5;
}

.section-icon {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: #eef2ff;
    color: #4f46e5;
    font-size: 19px;
}

.section-heading h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
}

.section-heading p {
    margin: 4px 0 0;
    font-size: 12px;
    color: #94a3b8;
}

.form-label {
    font-size: 13px;
    font-weight: 600;
    color: #334155;
    margin-bottom: 8px;
}

.form-control {
    border: 1px solid #dce3ed;
    border-radius: 8px;
    padding: 11px 13px;
    font-size: 14px;
    color: #334155;
    background: #fff;
    transition: all .2s ease;
}

.form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,.10);
}

textarea.form-control {
    resize: vertical;
}

.form-group {
    margin-bottom: 20px;
}

.banner-upload {
    border: 2px dashed #cbd5e1;
    border-radius: 12px;
    padding: 22px;
    background: #f8fafc;
}

.banner-preview {
    display: block;
    width: 100%;
    max-height: 220px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 15px;
}

.upload-note {
    font-size: 12px;
    color: #94a3b8;
    margin-top: 8px;
}

.social-input {
    position: relative;
}

.social-input .form-control {
    padding-left: 42px;
}

.social-input .social-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    font-size: 16px;
}

.save-area {
    position: sticky;
    bottom: 0;
    background: rgba(255,255,255,.96);
    padding: 16px 20px;
    border: 1px solid #e8edf4;
    border-radius: 12px;
    display: flex;
    justify-content: flex-end;
    box-shadow: 0 -4px 15px rgba(15,23,42,.04);
    z-index: 10;
}

.btn-save {
    background: #4f46e5;
    border: none;
    color: #fff;
    padding: 11px 28px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    transition: .2s;
}

.btn-save:hover {
    background: #4338ca;
    color: #fff;
    transform: translateY(-1px);
}

@media(max-width: 767px) {
    .edit-page {
        padding: 15px;
    }

    .settings-card {
        padding: 18px;
    }

    .page-header h2 {
        font-size: 21px;
    }
}
</style>

<div class="container-fluid edit-page">

    <div class="page-header">
        <div>
            <h2>Edit Website Content</h2>
            <p>Manage your website information, contact details and social media links.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            Please correct the errors below.
        </div>
    @endif

    <form action="{{ route('admin.edit-page.save') }}"
          method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Banner Image -->
        <div class="settings-card">

            <div class="section-heading">
                <div class="section-icon">
                    <i class="bi bi-image"></i>
                </div>
                <div>
                    <h5>Banner Image</h5>
                    <p>Upload your website's main banner image.</p>
                </div>
            </div>

            <div class="banner-upload">

                @if($page->banner_image)
                    <img src="{{ asset('storage/' . $page->banner_image) }}"
                         alt="Banner image"
                         class="banner-preview">
                @endif

                <label class="form-label">Choose Banner Image</label>

                <input type="file" name="banner_image"
                       class="form-control" accept="image/*">

                <div class="upload-note">
                    Recommended: High-quality JPG, PNG or WebP image.
                </div>

                @error('banner_image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <!-- About, Mission & Vision -->
        <div class="settings-card">

            <div class="section-heading">
                <div class="section-icon">
                    <i class="bi bi-building"></i>
                </div>
                <div>
                    <h5>About, Mission & Vision</h5>
                    <p>Manage your company's introduction and objectives.</p>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">About Us</label>
                <textarea name="about_us" rows="4" class="form-control"
                    placeholder="Enter about us information...">{{ old('about_us', $page->about_us) }}</textarea>
                @error('about_us') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Mission</label>
                        <textarea name="mission" rows="4" class="form-control"
                            placeholder="Enter company mission...">{{ old('mission', $page->mission) }}</textarea>
                        @error('mission') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Vision</label>
                        <textarea name="vision" rows="4" class="form-control"
                            placeholder="Enter company vision...">{{ old('vision', $page->vision) }}</textarea>
                        @error('vision') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="settings-card">

            <div class="section-heading">
                <div class="section-icon">
                    <i class="bi bi-telephone"></i>
                </div>
                <div>
                    <h5>Contact Information</h5>
                    <p>Update your business contact details.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control"
                            value="{{ old('phone', $page->phone) }}"
                            placeholder="Enter phone number">
                        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $page->email) }}"
                            placeholder="Enter email address">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Business Address</label>
                <textarea name="address" rows="3" class="form-control"
                    placeholder="Enter complete business address">{{ old('address', $page->address) }}</textarea>
                @error('address') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <!-- Social Media -->
        <div class="settings-card">

            <div class="section-heading">
                <div class="section-icon">
                    <i class="bi bi-share"></i>
                </div>
                <div>
                    <h5>Social Media Links</h5>
                    <p>Connect your website with social media platforms.</p>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Facebook URL</label>
                <div class="social-input">
                    <i class="bi bi-facebook social-icon"></i>
                    <input type="url" name="facebook" class="form-control"
                        value="{{ old('facebook', $page->facebook) }}"
                        placeholder="https://www.facebook.com/">
                </div>
                @error('facebook') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Instagram URL</label>
                <div class="social-input">
                    <i class="bi bi-instagram social-icon"></i>
                    <input type="url" name="instagram" class="form-control"
                        value="{{ old('instagram', $page->instagram) }}"
                        placeholder="https://www.instagram.com/">
                </div>
                @error('instagram') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group mb-0">
                <label class="form-label">YouTube URL</label>
                <div class="social-input">
                    <i class="bi bi-youtube social-icon"></i>
                    <input type="url" name="youtube" class="form-control"
                        value="{{ old('youtube', $page->youtube) }}"
                        placeholder="https://www.youtube.com/">
                </div>
                @error('youtube') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

        </div>

        <!-- Save Button -->
        <div class="save-area">
            <button type="submit" class="btn btn-save">
                <i class="bi bi-check-circle me-2"></i>
                Save Changes
            </button>
        </div>

    </form>

</div>

@endsection
