
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Projects</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
            color: #1e293b;
            font-family: Arial, sans-serif;
        }

        .page-container {
            max-width: 1250px;
            margin: 40px auto;
            padding: 0 18px;
        }

        .page-title {
            font-size: 27px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 14px;
            color: #64748b;
        }

        .project-card {
            background: #fff;
            border: 1px solid #e5eaf1;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .04);
            overflow: hidden;
        }

        .card-heading {
            padding: 20px 24px;
            border-bottom: 1px solid #edf0f5;
        }

        .form-section {
            padding: 24px;
            margin-bottom: 25px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
        }

        .form-control {
            border-color: #dbe2ea;
            border-radius: 7px;
            padding: 10px 12px;
        }

        .form-control:focus {
            border-color: #64748b;
            box-shadow: 0 0 0 3px rgba(100, 116, 139, .12);
        }

        .btn {
            border-radius: 7px;
            padding: 9px 15px;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-edit {
            background: #fff;
            border: 1px solid #cbd5e1;
            color: #334155;
        }

        .btn-edit:hover {
            background: #f1f5f9;
            color: #1e293b;
        }

        .btn-update {
            background: #1e293b;
            border: 1px solid #1e293b;
            color: #fff;
        }

        .btn-update:hover {
            background: #334155;
            color: #fff;
        }

        .btn-delete {
            background: #fff;
            border: 1px solid #fecaca;
            color: #dc2626;
        }

        .btn-delete:hover {
            background: #fef2f2;
            color: #b91c1c;
        }

        .project-table {
            margin-bottom: 0;
        }

        .project-table thead th {
            background: #f8fafc;
            color: #64748b;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
            padding: 16px 20px;
            white-space: nowrap;
            border-bottom: 1px solid #e5eaf1;
        }

        .project-table tbody td {
            padding: 16px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #edf0f5;
            font-size: 13px;
        }

        .project-table tbody tr:last-child td {
            border-bottom: none;
        }

        .project-table tbody tr:hover {
            background: #fafbfe;
        }

        .project-name {
            font-weight: 600;
            color: #1e293b;
        }

        .project-description {
            max-width: 300px;
            color: #64748b;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .project-image {
            width: 78px;
            height: 58px;
            object-fit: cover;
            border-radius: 7px;
            border: 1px solid #e2e8f0;
        }

        .no-image {
            width: 78px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            background: #f1f5f9;
            color: #94a3b8;
            font-size: 11px;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .action-buttons form {
            margin: 0;
        }

        .table-footer {
            padding: 15px 20px;
            color: #64748b;
            font-size: 12px;
            border-top: 1px solid #edf0f5;
        }

        @media (max-width: 768px) {
            .page-container {
                margin: 22px auto;
                padding: 0 12px;
            }

            .page-title {
                font-size: 23px;
            }

            .card-heading,
            .form-section {
                padding: 17px;
            }

            .project-table thead th,
            .project-table tbody td {
                padding: 13px;
            }
        }
    </style>
</head>

<body>

<div class="page-container">

    {{-- Page Header --}}
    <div class="mb-4">
        <h1 class="page-title">Our Projects</h1>
        <p class="subtitle mb-0">
            View and manage your project details.
        </p>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Validation Errors --}}
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

    {{-- Edit Project Form Only --}}
    <div class="project-card form-section"
         id="projectFormCard"
         style="{{ $errors->any() || isset($editProject) ? '' : 'display:none;' }}">

        <div class="mb-4">
            <h5 class="fw-bold mb-1">Edit Project</h5>
            <p class="subtitle mb-0">
                Update the project information below.
            </p>
        </div>

        <form id="projectForm"
              action="{{ isset($editProject) ? route('our-projects.update', $editProject->id) : '#' }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label for="project_name" class="form-label">
                        Project Name <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="project_name"
                           id="project_name"
                           class="form-control @error('project_name') is-invalid @enderror"
                           value="{{ old('project_name', isset($editProject) ? $editProject->project_name : '') }}"
                           maxlength="255"
                           required>

                    @error('project_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="project_image" class="form-label">
                        Project Image
                    </label>

                    <input type="file"
                           name="image"
                           id="project_image"
                           class="form-control @error('image') is-invalid @enderror"
                           accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">

                    <small class="text-muted">
                        JPG, PNG or WEBP. Maximum 2 MB.
                    </small>

                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div id="imagePreview" class="mt-2">
                        @if(isset($editProject) && $editProject->image)
                            <img src="{{ asset('storage/' . $editProject->image) }}"
                                 class="project-image"
                                 alt="Current project image">
                        @endif
                    </div>
                </div>

                <div class="col-12 mb-4">
                    <label for="description" class="form-label">
                        Description
                    </label>

                    <textarea name="description"
                              id="description"
                              rows="4"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', isset($editProject) ? $editProject->description : '') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <button type="submit" class="btn btn-update">
                Update Project
            </button>

            <button type="button"
                    class="btn btn-edit ms-2"
                    onclick="hideForm()">
                Cancel
            </button>
        </form>
    </div>

    {{-- Project List --}}
    <div class="project-card">

        <div class="card-heading d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-1">Project List</h5>
                <p class="subtitle mb-0">All registered projects</p>
            </div>

            <span class="badge bg-light text-dark border">
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
                                <div class="project-description">
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

                                    {{-- Edit --}}
                                    <a href="{{ route('our-projects.edit', $project->id) }}"
                                       class="btn btn-edit">
                                        Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('our-projects.destroy', $project->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this project?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-delete">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <h6 class="fw-bold text-secondary">
                                    No projects found
                                </h6>
                                <p class="text-muted mb-0">
                                    There are currently no project records to display.
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const formCard = document.getElementById('projectFormCard');

    function hideForm() {
        formCard.style.display = 'none';
    }

    // Preview the selected replacement image.
    document.getElementById('project_image').addEventListener('change', function () {
        const file = this.files[0];

        if (!file) {
            return;
        }

        if (!file.type.startsWith('image/')) {
            alert('Please select a valid image file.');
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

</body>
</html>
