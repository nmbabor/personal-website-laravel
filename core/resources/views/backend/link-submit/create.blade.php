@extends('backend.master')

@section('title', 'Qucik Link Submit')
@section('title_button')
    <a href="{{ route('link-submit.index') }}" class="btn bg-gradient-primary">
        <i class="fas fa-list"></i>
        View All
    </a>
@endsection

@section('content')
    <!-- card -->
    <div class="card">
        <!-- form start -->
        <form action="{{ route('link-submit.store') }}" method="post" id="create-blog-form">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 pr-5">
                        <div class="form-group">
                            <label for="title"> Name <span class="text-danger">*</span> : </label>
                            <input type="text" class="form-control" placeholder="Enter title" name="title"
                                value="{{ old('title') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="customFile">Text file with links (one per line) : </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="link_file">
                                <label class="custom-file-label" for="customFile">Upload .xlsx, .csv or .txt file with links</label>
                            </div>
                            <p id="file_error" class="text-danger" style="display: none">File type not supported</p>
                        </div>
                        <div class="form-group text-center mb-0">
                            <label class="mb-0"> OR </label>
                        </div>
                        <div class="form-group">
                            <label for="content">
                                Links (One per line) :
                            </label>
                            <textarea class="form-control" placeholder="http://example-1.com/backlink-1/
http://example-2.com/backlink-2/
http://example-3.com/backlink-3/" name="links" cols="30" rows="10"
                                id="json-load">{{ old('links') }}</textarea>
                        </div>

                        <button type="submit" class="btn bg-gradient-primary">Submit</button>
                    </div>
                    <div class="col-md-4 border-left">
                        <h5> Recent Submitted Links: </h5>
                        <table class="table table-stripted">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Links</th>
                                    <th><i class="fa fa-trash"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestData as $key => $data)
                                <tr>
                                    <td> {{$key+1}} </td>
                                    <td> <a class="{{$data->status==1?'text-info':'text-warning'}}" href="{{route('link-submit.show',$data->id)}}"> @if($data->status==1) <i class="text-success fa fa-check-circle"></i> @else <i class="text-danger fa fa-times-circle"></i> @endif {{$data->title}} </a></td>
                                    <td> <a href="{{route('link-submit.show',$data->id)}}""> <span class="badge badge-info">{{$data->total_links}}</span> </a> </td>
                                    <td><a class="btn btn-danger btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Data"
                                        href="javascript:void(0)"
                                        onclick=resourceDelete("{{ route('link-submit.destroy', $data->id) }}")>
                                        <span class="delete-icon">
                                        <i class="fas fa-trash-alt"></i>
                                    </a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p class="mt-2">
                        <a class="btn btn-info" href="{{route('link-submit.index')}}">View All</a>
                        </p>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection

@push('script')
    <script src="{{ asset('assets/backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/xlsx.core.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
        /*Import*/

        function importExcel(e) {
            $('#file_error').hide();
            //Get the files from Upload control
            var files = e.target.files;
            var type = files[0]['type'];
            var json = '';
            if(files[0].name.endsWith('.xlsx')){
                importXlsx(files[0])
            }else if(files[0].name.endsWith('.csv')){
              csvJSON(files[0])
            }else if(files[0].name.endsWith('.txt')){
                csvJSON(files[0])
            }else{
                $('#file_error').show();
            }
        }
        /* Import Xlsx file */
        function importXlsx(file){
            var reader = new FileReader();
            reader.onloadend = function () {
                var data = this.result;
                var result;
                const workbook = XLSX.read(data, { type: 'binary' });
                const sheetName = workbook.SheetNames[0];
                const worksheet = workbook.Sheets[sheetName];
                const jsonData = XLSX.utils.sheet_to_json(worksheet);
                textData = jsonData.map((row,i) =>{
                    let rowData = '';
                    if(i==0){
                        rowData += (Object.keys(row).join('\n'))+'\n'
                    }
                    rowData += (Object.values(row).join('\n'));
                    return rowData;
                }).join('\n');
                jsonResult(textData)

            };
            reader.readAsArrayBuffer(file);
        }
        /*CSV to Json*/
        function csvJSON(file){
            oFReader = new FileReader();
            oFReader.onloadend = function() {
            var csv = this.result;
            var lines=csv.split("\n");
            var result = [];

            var headers=lines[0].split(",");
            for(var i=0;i<lines.length;i++){

                var obj = {};
                var currentline=lines[i].split(",");

                for(var j=0;j<headers.length;j++){
                    obj = currentline[j];
                    result.push(obj+"");
                }

                //result.push(obj);
            }
            const filteredArray = result.filter(item => item !== "" && item !== undefined && item !== 'undefined');

            // Step 2: Remove '\r' characters
            const cleanedArray = filteredArray.map(item => item.replace(/\r/g, '')).filter(item => item !== "");
            // Step 3: Convert the cleaned array to text with newlines
            let textData = cleanedArray.join('\n');
            // Remove newline from the end of textData
            textData = textData.replace(/\n$/, '');
            jsonResult(textData)

            };
            oFReader.readAsText(file);
        }
    function jsonResult(result){
        $('#json-load').val(result)
    }
/**/


        //Change event to dropdownlist
        $(document).ready(function(){
            $('#customFile').change(importExcel);
        });
    </script>
@endpush
