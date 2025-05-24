@extends('admin/layout')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('jmultiple/example-styles.css') }}">

    <div class="row">
        <div class="col-xl-9 mx-auto">
            <h6 class="mb-0 text-uppercase">Horizontal Form</h6>
            <hr>
            <form id="formSubmit" action="{{ url('admin/updateproduct') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="card border-top border-0 border-4 border-info">
                <div class="card-body">
                    <form id="productForm">
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                                </div>
                                <h5 class="mb-0 text-info">Product</h5>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <label for="name" class="col-sm-3 col-form-label">Product Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ $data->name }}" placeholder="Enter Your Name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="slug" class="col-sm-3 col-form-label">Slug</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="slug" id="slug" value="{{ $data->slug }}"
                                        placeholder="Slug">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="image" class="col-sm-3 col-form-label">Product Image</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="image" id="image" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="keywords" class="col-sm-3 col-form-label">Keywords</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="keywords" id="keywords"
                                        value="{{ $data->keywords }}" placeholder="Enter Your keywords">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEnterYourName" class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select name="category" onchange="getAttributes()" class="form-control">
                                        @foreach ($category as $list)
                                            @if ($data->category_id == $list->id)
                                                <option selected value="{{ $list->id }}">{{ $list->name }}</option>
                                            @else
                                                <option value="{{ $list->id }}">{{ $list->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="attribute" class="col-sm-3 col-form-label">Attribute</label>
                                <div class="col-sm-9">
                                    <select name="attribute[]" id="attribute" multiple class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputEnterYourName" class="col-sm-3 col-form-label">Brand</label>
                                <div class="col-sm-9">
                                    <select name="brand" class="form-control">
                                        @foreach ($brand as $list)
                                            @if ($data->brand_id == $list->id)
                                                <option selected value="{{ $list->id }}">{{ $list->text }}</option>
                                            @else
                                                <option value="{{ $list->id }}">{{ $list->text }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEnterYourName" class="col-sm-3 col-form-label">Tax</label>
                                <div class="col-sm-9">
                                    <select name="tax" id="tax" class="form-control">
                                        @foreach ($tax as $list)
                                            @if ($data->tax_id == $list->id)
                                                <option selected value="{{ $list->id }}">{{ $list->text }} %
                                                </option>
                                            @else
                                                <option value="{{ $list->id }}">{{ $list->text }} %</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="item_code" class="col-sm-3 col-form-label">Item Code</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $data->item_code }}"
                                        name="item_code" id="item_code" placeholder="Item Code">
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="description" class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description">{{ $data->description }}</textarea>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="inputAddress4" class="col-sm-3 col-form-label">Product Attribute</label>

                                <div class=" row col-sm-9" id="addAttr">
                                    <div class="col-sm-3">
                                        <button type="button" id="addAttributeButton" class="btn btn-info">Add
                                            Attribute</button>
                                    </div>
                                    @php
                                        $count = 1;
                                    @endphp
                                    <div class="row" id='attrRec_{{ $count }}'>
                                        <div class="col-sm-3">
                                            <select name="color[]" id="color" class="form-control">
                                                @foreach ($color as $list)
                                                    <option value="{{ $list->id }}">{{ $list->text }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <select name="size[]" id="size" class="form-control">
                                                @foreach ($size as $list)
                                                    <option value="{{ $list->id }}">{{ $list->text }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="sku" name="sku[]"
                                                rows="3" placeholder="Enter SKU">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="mrp" name="mrp[]"
                                                rows="3" placeholder="Enter MRP">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="price" name="price[]"
                                                rows="3" placeholder="Enter Price">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="length" name="length[]"
                                                rows="3" placeholder="Enter length">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="breadth" name="breadth[]"
                                                rows="3" placeholder="Enter Breadth">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="height" name="height[]"
                                                rows="3" placeholder="Enter Height">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="weight" name="weight[]"
                                                rows="3" placeholder="Enter Weight">
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputAddress4" class="col-sm-3 col-form-label">Product
                                                Images</label>
                                            <div class=" row col-sm-9">
                                                <input type="hidden" name="image_values[]" value="{{ $count }}"/>
                                                <div class="col-sm-3">
                                                    <button type="button" onclick="addAttrImage({{ $count }})"
                                                        id='addAttrImages' class="btn btn-info">Add images</button>
                                                </div>
                                                <div class="row" id='attrImages_{{ $count }}'>
                                                    <div class="col-sm-3">
                                                        <input type="file" class="form-control"
                                                            id="attr_image"name="attr_image_{{ $count }}[]" rows="3">
                                                        <button type="button" onclick="removeAttrImage(event)"
                                                            id='addAttrImages' class="btn btn-danger">Remove </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        @if ($count !== 1)
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <button type="button" onclick="removeAttr({{ $count }})"
                                                        id='addAttrImages' class="btn btn-danger">Remove </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                </div>

                            </div>



                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-info px-5">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </form>
        </div>
    </div>
    <script>
        var attrCounter = {{ $count + 1 }};

        function removeAttrImage(event) {
            event.target.closest('.col-sm-3').remove();
        }

        function addAttrImage(count) {
            $('#attrImages_' + count).append(
                '<div class="col-sm-3">' +
                '        <input type="file" class="form-control" id="attr_image"' +
                '            name="attr_image_'+count+'[]" rows="3">' +
                '<button type="button" onclick="removeAttrImage(event)" id="addAttrImages" class="btn btn-danger">Remove </button>' +
                '    </div>');
        }
        $(document).ready(function() {
            $('#addAttributeButton').click(function() {
                $('#addAttr').append('  <div class="row" id="attrRec_' + attrCounter +
                    '"><div class="col-sm-3">' +
                    '<select name="color[]" id="color" class="form-control">' +
                    '    @foreach ($color as $list)' +
                    '        <option value="{{ $list->id }}">{{ $list->text }} </option>' +
                    '    @endforeach' +
                    '</select>' +
                    '</div>' +
                    '<div class="col-sm-3">' +
                    '   <select name="size[]" id="size" class="form-control">' +
                    '      @foreach ($size as $list)' +
                    '         <option value="{{ $list->id }}">{{ $list->text }} </option>' +
                    '    @endforeach' +
                    '    </select>' +
                    '</div>' +
                    '<div class="col-sm-3">' +
                    '        <input type="text" class="form-control" id="sku" name="sku[]"' +
                    '            rows="3" placeholder="Enter SKU">' +
                    '    </div>' +
                    '   <div class="col-sm-3">' +
                    '        <input type="text" class="form-control" id="mrp" name="mrp[]"' +
                    '            rows="3" placeholder="Enter MRP">' +
                    '    </div>' +
                    '    <div class="col-sm-3">' +
                    '       <input type="text" class="form-control" id="price" name="price[]"' +
                    '            rows="3" placeholder="Enter Price">' +
                    '    </div>' +
                    '    <div class="col-sm-3">' +
                    '        <input type="text" class="form-control" id="length" name="length[]"' +
                    '            rows="3" placeholder="Enter length">' +
                    '    </div>' +
                    '    <div class="col-sm-3">' +
                    '        <input type="text" class="form-control" id="breadth" name="breadth[]"' +
                    '            rows="3" placeholder="Enter Breadth">' +
                    '    </div>' +
                    '    <div class="col-sm-3">' +
                    '        <input type="text" class="form-control" id="height" name="height[]"' +
                    '            rows="3" placeholder="Enter Height">' +
                    '    </div>' +
                    '    <div class="col-sm-3">' +
                    '        <input type="text" class="form-control" id="weight"' +
                    '           name="weight[]" rows="3" placeholder="Enter Weight">' +
                    '   </div>' +
                    ' <div class="row mb-3">' +
                    '                    <label for="inputAddress4" class="col-sm-3 col-form-label">Product Images</label>' +
                    '                    <div class=" row col-sm-9"><input type="hidden" name="image_values[]" value="' + attrCounter + '"/>' +
                    '                        <div class="col-sm-3">' +
                    '                            <button type="button" onclick="addAttrImage(' +
                    attrCounter + ')" id="addAttrImages" class="btn btn-info">Add' +
                    '                               images</button>' +
                    '                       </div>' +
                    '                       <div class="row" id="attrImages_' + attrCounter + '">' +
                    '                           <div class="col-sm-3">' +
                    '                               <input type="file" class="form-control" id="attr_image"' +
                    '                                   name="attr_image_' + attrCounter + '[]" rows="3">' +
                    '                           </div>' +
                    '                       </div>' +
                    '                   </div>' +
                    '               </div>' +
                    ' <div class="row" >' +
                    '                           <div class="col-sm-12">' +
                    '                             <button type="button" onclick="removeAttr(' +
                    attrCounter + ')" id="addAttrImages"' +
                    '                           class="btn btn-danger">Remove </button>' +
                    '                     </div>' +
                    '               </div></div>');
                attrCounter++;
            });
        });

        function removeAttr(id) {
            $('#attrRec_' + id).remove();
        }

        function getAttributes() {
            var category = $('select[name=category]').val();
            var html = '';
            $.ajax({
                url: '{{ url('admin/get_attributes') }}/' + category,
                type: 'get',
                // headers:{
                //     'X-CSRF-TOKEN':'{{ csrf_token() }}'
                // },
                // data: $('#productForm').serialize(),
                success: function(data) {
                    console.log(data);
                    if (data.data.length > 0) {


                        $('#attribute').html('<option value="test">Test</option>');
                        jQuery.each(data.data, function(index, value) {
                            console.log(value.values);
                            jQuery.each(value.values, function(vindex, vvalue) {
                                console.log('3');
                                $('#attribute').append('<option value="' + vvalue.id +
                                    '">' +
                                    value.attribute.name + ' (' + vvalue.value +
                                    ')</option>');
                            });
                        });
                        //$('#attribute').html(html);
                        $('#attribute').multiSelect();
                    }
                }
            });
        }
    </script>
    <script type="text/javascript" src="{{ asset('jmultiple/jquery.multi-select.js') }}"></script>
    <script type="text/javascript">
        $(function() {


        });
    </script>
@endsection
