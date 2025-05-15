@extends("admin/layout")
@section("content")
    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Category Attribute</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Category Attribute</li>
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

            <h6 class="mb-0 text-uppercase">Category Attribute</h6>
            <hr />
            <div class="col">
                <button type="button" onclick="saveData('','','','')" class="btn btn-info px-5 radius-30"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">Add Category Attribute</button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category</th>
                                    <th>Attribute</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $list)
                                    <tr>
                                        <td>{{ $list->id }}</td>
                                        <td>{{ $list->category->name }}</td>
                                        <td>{{ $list->attribute->name }}</td>

                                        <td>
                                            <button type="button"
                                                onclick="saveData('{{ $list->id }}','{{ $list->category_id }}','{{ $list->attribute_id }}')"
                                                class="btn btn-info px-5 radius-30" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">Update</button>
                                                <button type="button"
                                                onclick="deleteData('{{ $list->id }}','category_attribute')"
                                                class="btn btn-info px-5 radius-30">Delete</button>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Category</th>
                                    <th>Attribute</th>
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
        <form id="formSubmit" action="{{ url('admin/category_attribute') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog model-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Category Attribute</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body p-5">
                                <div class="card-title d-flex align-items-center">
                                    <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary">Category Attribute</h5>
                                </div>
                                <hr>

                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">Category</label>
                                    <select class="form-select" name="category_id" id="category_id">
                                        @foreach ($category as $list)
                                            <option value="{{ $list->id }}">{{ $list->name }}</option>
                                        @endforeach
                                     </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputLastName" class="form-label">Attribute</label>
                                    <select class="form-select" name="attribute_id" id="attribute_id">
                                        @foreach ($attribute as $list)
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
        function saveData(id, category, attribute) {
            if (id != "") {
                $("#category_id").val(category);
                $("#attribute_id").val(attribute);
                // $("#image").val(image);
                $("#id").val(id);
                $("#showImage").attr("src", image);
            } else {
                $("#category_id").val("");
                $("#attribute_id").val("");

                $("#id").val("");
            }
        }
    </script>
@endsection
