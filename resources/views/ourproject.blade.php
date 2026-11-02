
@extends('layouts.mainlayout')

@section('content')

<style>
.page-container {
    background: #f5f7fb;
    min-height: 100vh;
    padding: 30px;
}

.page-title {
    font-size: 26px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 5px;
}

.subtitle {
    color: #64748b;
    font-size: 13px;
}

.project-card {
    background: #fff;
    border: 1px solid #e8edf4;
    border-radius: 14px;
    padding: 24px;
    margin-bottom: 24px;
    box-shadow: 0 3px 15px rgba(15,23,42,.035);
}

.card-heading {
    padding-bottom: 18px;
    margin-bottom: 20px;
    border-bottom: 1px solid #edf0f5;
}

.card-heading h5,
.form-heading h5 {
    color: #1e293b;
    font-size: 17px;
    font-weight: 700;
}

.form-heading {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 22px;
}

.heading-icon {
    width: 42px;
    height: 42px;
    background: #eef2ff;
    color: #4f46e5;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
}

.form-label {
    color: #334155;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 8px;
}

.form-control {
    border: 1px solid #dce3ed;
    border-radius: 8px;
    padding: 11px 13px;
    font-size: 13px;
    box-shadow: none;
}

.form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,.10);
}

.form-group {
    margin-bottom: 20px;
}

.project-image {
    width: 75px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}

#imagePreview .project-image {
    width: 180px;
    height: 110px;
    margin-top: 10px;
}

.image-upload-box {
    padding: 18px;
    border: 2px dashed #cbd5e1;
    border-radius: 10px;
    background: #f8fafc;
}

.project-table {
    margin-bottom: 0;
    vertical-align: middle;
}

.project-table thead th {
    background: #f8fafc;
    color: #64748b;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    padding: 15px 12px;
    border-bottom: 1px solid #e8edf4;
    white-space: nowrap;
}

.project-table tbody td {
    padding: 16px 12px;
    color: #475569;
    font-size: 13px;
    border-bottom: 1px solid #f1f5f9;
}

.project-table tbody tr:hover {
    background: #fafbff;
}

.project-name {
    color: #1e293b;
    font-weight: 600;
}

.project-description {
    max-width: 300px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.no-image {
    width: 75px;
    height: 60px;
    background: #f1f5f9;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    font-size: 11px;
}

.action-buttons {
    display: flex;
    align-items: center;
    gap: 7px;
}

.action-buttons form {
    margin: 0;
}

.btn-edit,
.btn-delete,
.btn-update {
    border: none;
    padding: 8px 15px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 7px;
}

.btn-edit {
    background: #eef2ff;
    color: #4f46e5;
}

.btn-edit:hover {
    background: #e0e7ff;
    color: #4338ca;
}

.btn-delete {
    background: #fff1f2;
    color: #e11d48;
}

.btn-delete:hover {
    background: #ffe4e6;
    color: #be123c;
}

.btn-update {
    background: #4f46e5;
    color: white;
    padding: 11px 25px;
}

.btn-update:hover {
    background: #4338ca;
    color: white;
}

.project-count {
    background: #eef2ff;
    color: #4f46e5;
    border-radius: 20px;
    padding: 7px 13px;
    font-size: 12px;
    font-weight: 700;
}

.table-footer {
    padding-top: 15px;
    color: #94a3b8;
    font-size: 12px;
}

.form-actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

@media(max-width: 767px) {
    .page-container {
        padding: 15px;
    }

    .project-card {
        padding: 16px;
    }

    .project-table {
        min-width: 750px;
    }

    .page-title {
        font-size: 22px;
    }
}
</style>

<div class="container-fluid page-container">

    <!-- Header -->
    <div class="mb-4">
        <h1 class="page-title">Our Projects</h1>
        <p class="subtitle mb-0">
            Manage and showcase your website projects.
        </p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please correct the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Project Form -->
    <div class="project-card form-section"
         id="projectFormCard"
         style="{{ $errors->any() || isset($editProject) ? '' : 'display:none;' }}">

        <div class="form-heading">
            <div class="heading-icon">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div>
                <h5 class="mb-1">Edit Project</h5>
                <p class="subtitle mb-0">
                    Update your project information.
                </p>
            </div>
        </div>

        <form id="projectForm"
              action="{{ isset($editProject) ? route('our-projects.update', $editProject->id) : '#' }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Project Name <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="project_name"
                           class="form-control @error('project_name') is-invalid @enderror"
                           value="{{ old('project_name', isset($editProject) ? $editProject->project_name : '') }}"
                           maxlength="255"
                           placeholder="Enter project name"
                           required>

                    @error('project_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Project Image</label>

                    <div class="image-upload-box">
                        <input type="file"
                               name="image"
                               id="project_image"
                               class="form-control @error('image') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">

                        <small class="text-muted d-block mt-2">
                            JPG, PNG or WEBP. Maximum 2 MB.
                        </small>

                        @error('image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror

                        <div id="imagePreview">
                            @if(isset($editProject) && $editProject->image)
                                <img src="{{ asset('storage/' . $editProject->image) }}"
                                     class="project-image"
                                     alt="Current project image">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Project Description</label>

                    <textarea name="description"
                              rows="4"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Enter project description...">{{ old('description', isset($editProject) ? $editProject->description : '') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-update">
                    <i class="bi bi-check-circle me-1"></i>
                    Update Project
                </button>

                <button type="button"
                        class="btn btn-edit"
                        onclick="hideForm()">
                    Cancel
                </button>
            </div>

        </form>
    </div>

    <!-- Project List -->
    <div class="project-card">

        <div class="card-heading d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1">Project List</h5>
                <p class="subtitle mb-0">
                    View and manage all registered projects.
                </p>
            </div>

            <span class="project-count">
                <i class="bi bi-folder2-open me-1"></i>
                Total: {{ $projects->count() }}
            </span>
        </div>

        <div class="table-responsive">
            <table class="table project-table table-hover">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Project Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>

                            <td>
                                <span class="project-name">
                                    {{ $project->project_name }}
                                </span>
                            </td>

                            <td>
                                <div class="project-description"
                                     title="{{ $project->description }}">
                                    {{ $project->description ?: 'No description available' }}
                                </div>
                            </td>

                            <td>
                                @if($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}"
                                         class="project-image"
                                         alt="{{ $project->project_name }}">
                                @else
                                    <div class="no-image">No image</div>
                                @endif
                            </td>

                            <td>
                                <div class="action-buttons">

                                    <a href="{{ route('our-projects.edit', $project->id) }}"
                                       class="btn btn-edit">
                                        <i class="bi bi-pencil me-1"></i>
                                        Edit
                                    </a>

                                    <form action="{{ route('our-projects.destroy', $project->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this project?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-delete">
                                            <i class="bi bi-trash me-1"></i>
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bi bi-folder-x fs-1 text-secondary"></i>
                                <h6 class="fw-bold text-secondary mt-3">
                                    No projects found
                                </h6>
                                <p class="text-muted mb-0">
                                    There are currently no project records.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="table-footer">
            Showing {{ $projects->count() }} project(s)
        </div>

    </div>

</div>

<script>
    const formCard = document.getElementById('projectFormCard');

    function hideForm() {
        formCard.style.display = 'none';
    }

    // Image preview
    document.getElementById('project_image').addEventListener('change', function () {

        const file = this.files[0];

        if (!file) return;

        const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

        if (!allowedTypes.includes(file.type)) {
            alert('Please select a JPG, PNG or WEBP image.');
            this.value = '';
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Image size must not exceed 2 MB.');
            this.value = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            const preview = document.getElementById('imagePreview');
            const img = document.createElement('img');

            img.src = event.target.result;
            img.alt = 'Selected project image preview';
            img.className = 'project-image';

            preview.replaceChildren(img);
        };

        reader.readAsDataURL(file);
    });
</script>

@endsection
