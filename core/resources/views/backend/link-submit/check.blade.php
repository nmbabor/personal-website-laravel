@extends('backend.master')

@section('title', 'Check backlink')
@section('title_button')
    <a href="{{ route('link-submit.create') }}" class="btn bg-info">
        <i class="fas fa-plus"></i>
        Link Submit
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
                    <div class="col-md-12">

                        <div class="form-group col-md-8 pl-0">
                            <label for="content">
                                Links (One per line) :
                            </label>
                            <textarea class="form-control"
                                placeholder="http://example-1.com/backlink-1/
http://example-2.com/backlink-2/
http://example-3.com/backlink-3/"
                                name="links" cols="30" rows="10" id="linksTextarea">{{ old('links') }}</textarea>
                            <p class="text-danger" id="error"></p>
                        </div>

                        <button type="button" class="btn bg-gradient-primary" onclick="linkProcess()"> <i class="fa fa-spinner fa-spin" style="display: none"></i> Check Link</button>
                    </div>
                    <div class="col-md-12 pt-3">
                        <table class="table table-stripted table-bordered" id="url-table">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="40%">Backlink</th>
                                    <th width="20%">Show on Google</th>
                                    <th>Title</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <button type="button" onclick="exportTableToExcel('url-table', 'My Backlinks')" class="btn btn-md btn-success" id="export" style="display: none"> <i class="fa fa-download"></i> Export</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection

@push('script')
    <script>
        function linkProcess() {
            $('#url-table tbody').html('');
            var textareaContent = $('#linksTextarea').val();
            if (textareaContent.trim() === '') {
                // Display an error message
                $('#error').text('Please enter some text');
            } else {

                // Split the content by newline character
                var linksArray = textareaContent.split('\n');

                // Filter out any empty strings or strings with just spaces
                linksArray = linksArray.filter(function(link) {
                    return link.trim() !== '';
                });
                $('#error').empty();
                // Loop through each link and make an API request
                let j = 1;
                for (var i = 0; i < linksArray.length; i++) {
                    var link = linksArray[i];
                    $('.fa-spin').show();
                    // Make an API request for each link
                    $.ajax({
                        type: 'POST', // Adjust the HTTP method as needed
                        url: "{{route('link-check.submit')}}", // Replace with your API endpoint
                        data: {
                            url: link
                        }, // Pass the link as a parameter to your API
                        success: function(response) {
                            $('.fa-spin').hide();
                            $('#export').show();
                            // Handle the API response here
                            let urlRow = `<tr>
                                    <td>${j++}</td>
                                    <td>${response.url}</td>
                                    <td>${response.code == 200 ? '<span class="text-success">Indexed</span>' : '<span class="text-danger">No</span>'}</td>
                                    <td>${response.title}</td>
                                </tr>`;
                                $('#url-table').append(urlRow);
                        },
                        error: function(xhr, status, error) {
                            // Handle any errors that occur during the API request
                            console.error('Error for link ' + link + ':', status, error);
                        }
                    });
                }
            }

        }
 
        function download_csv(csv, filename) {
                var csvFile;
                var downloadLink;
                // CSV FILE
                csvFile = new Blob([csv], {type: "text/csv"});
                // Download link
                downloadLink = document.createElement("a");
    
                // File name
                downloadLink.download = filename;
    
                // We have to create a link to the file
                downloadLink.href = window.URL.createObjectURL(csvFile);
    
                // Make sure that the link is not displayed
                downloadLink.style.display = "none";
    
                // Add the link to your DOM
                document.body.appendChild(downloadLink);
    
                // Lanzamos
                downloadLink.click();
            }
    
            function exportTableToExcel(tableID, filename) {
    
                var csv = [];
                var rows = document.querySelectorAll("#"+tableID+" tr");
    
                for (var i = 0; i < rows.length; i++) {
                    var row = [], cols = rows[i].querySelectorAll("#"+tableID+" td, th");
    
                    for (var j = 0; j < cols.length; j++)
                        row.push(cols[j].innerText);
    
                    csv.push(row.join(","));
                }
    
                // Download CSV
                download_csv(csv.join("\n"), filename+'.csv');
            }
    </script>
@endpush
