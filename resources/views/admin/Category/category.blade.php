@extends('admin/layout')
@section('content')
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Category</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Category</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                        <button type="button"
                            class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                                href="javascript:;">Action</a>
                            <a class="dropdown-item" href="javascript:;">Another action</a>
                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                            <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated
                                link</a>
                        </div>
                    </div>
                </div>
            </div>

            <h6 class="mb-0 text-uppercase">Category</h6>
            <hr />
            <div class="col">
                <button type="button" onclick="saveData('','','','')" class="btn btn-info px-5 radius-30"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">Add Category</button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $list)
                                    <tr>
                                        <td>{{ $list->id }}</td>
                                        <td>{{ $list->name }}</td>
                                        <td>{{ $list->slug }}</td>

                                        <td>
                                            <button type="button"
                                                onclick="saveData('{{ $list->id }}','{{ $list->name }}','{{ $list->slug }}','{{ $list->parent_id }}')"
                                                class="btn btn-info px-5 radius-30" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">Update</button>
                                            <button type="button" onclick="deleteData('{{ $list->id }}','categories')"
                                                class="btn btn-info px-5 radius-30">Delete</button>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>name</th>
                                    <th>slug</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form id="formSubmit" action="{{ url('admin/category') }}" method="POST">
            @csrf
            <div class="modal-dialog model-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body p-5">
                                <div class="card-title d-flex align-items-center">
                                    <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary">Category</h5>
                                </div>
                                <hr>

                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">Name</label>
                                    <input required type="text" name="name" id="name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputLastName" class="form-label">Slug</label>
                                    <input required type="text" name="slug" id="slug" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputLastName" class="form-label">Parent Category</label>
                                    {{-- <input required type="text" name="link" id="link" class="form-control">
                                     --}}
                                     <select class="form-select" name="parent_id" id="parent_id">
                                        @foreach ($data as $list)
                                            <option value="{{ $list->id }}">{{ $list->name }}</option>
                                        @endforeach
                                     </select>
                                </div>
                                <input type="hidden" name="id" id="id">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <span id="submitBTNdiv">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--end page wrapper -->
    <!--plugins-->
    <script>
        function saveData(id, name, slug, parent_id) {
            $('#parent_id option').show();
            if (id != "") {
                // Show all options first
                // Hide the option that matches current category ID
                $('#parent_id option[value="' + id + '"]').hide();
                $("#name").val(name);
                $("#slug").val(slug);
                $("#parent_id").val(parent_id);
                $("#id").val(id);
            } else {
                // Show all options when adding new category

                $("#name").val("");
                $("#parent_id").val("");
                $("#slug").val("");
                $("#id").val("");
            }
        }
    </script>
@endsection
