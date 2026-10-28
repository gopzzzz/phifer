
@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 edit-page">
    <div class="page-header mb-4">
        <h2>Edit Page</h2>
        <p>Manage your website content and contact information.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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

        <div class="settings-card">
            <h5>Banner Image</h5>

            @if($page->banner_image)
                <img src="{{ asset('storage/' . $page->banner_image) }}"
                     alt="Banner image"
                     class="banner-preview">
            @endif

            <input type="file" name="banner_image"
                   class="form-control" accept="image/*">

            @error('banner_image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="settings-card">
            <h5>About, Mission & Vision</h5>

            <div class="form-group">
                <label>About Us</label>
                <textarea name="about_us" rows="4" class="form-control">{{ old('about_us', $page->about_us) }}</textarea>
                @error('about_us') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label>Mission</label>
                <textarea name="mission" rows="3" class="form-control">{{ old('mission', $page->mission) }}</textarea>
                @error('mission') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label>Vision</label>
                <textarea name="vision" rows="3" class="form-control">{{ old('vision', $page->vision) }}</textarea>
                @error('vision') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="settings-card">
            <h5>Contact Information</h5>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control"
                           value="{{ old('phone', $page->phone) }}">
                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email', $page->email) }}">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Address</label>
                <textarea name="address" rows="3" class="form-control">{{ old('address', $page->address) }}</textarea>
                @error('address') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="settings-card">
            <h5>Social Media Links</h5>

            <div class="form-group">
                <label>Facebook</label>
                <input type="url" name="facebook" class="form-control"
                       value="{{ old('facebook', $page->facebook) }}"
                       placeholder="https://www.facebook.com/">
                @error('facebook') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label>Instagram</label>
                <input type="url" name="instagram" class="form-control"
                       value="{{ old('instagram', $page->instagram) }}"
                       placeholder="https://www.instagram.com/">
                @error('instagram') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label>YouTube</label>
                <input type="url" name="youtube" class="form-control"
                       value="{{ old('youtube', $page->youtube) }}"
                       placeholder="https://www.youtube.com/">
                @error('youtube') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="save-area">
            <button type="submit" class="btn btn-primary">
                Save Changes
            </button>
        </div>
    </form>
</div>

<style>
.edit-page {
    max-width: 1100px;
    margin: auto;
    color: #253047;
}

.page-header h2 {
    font-size: 26px;
    font-weight: 700;
}

.page-header p {
    color: #7b8495;
}

.settings-card {
    background: #fff;
    border: 1px solid #e4e9f1;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 22px;
    box-shadow: 0 3px 12px rgba(0,0,0,.04);
}

.settings-card h5 {
    font-weight: 700;
    margin-bottom: 22px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
}

.edit-page .form-control {
    border: 1px solid #dce2eb;
    border-radius: 7px;
    padding: 10px 12px;
}

.edit-page .form-control:focus {
    border-color: #5378d7;
    box-shadow: 0 0 0 3px rgba(83,120,215,.12);
}

.banner-preview {
    display: block;
    width: 100%;
    max-height: 230px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 15px;
}

.save-area {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 30px;
}

.save-area .btn {
    padding: 11px 25px;
    border-radius: 7px;
    font-weight: 600;
}
</style>
@endsection
