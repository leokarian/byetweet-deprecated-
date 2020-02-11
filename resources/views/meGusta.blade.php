@extends('layout.base')

@section('header')
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="dist/css/byeTweets.css">
@endsection


@section('content')
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mis Favoritos!</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Me Gusta</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lista de tweets que me gustan</h3>
                    </div>
                    <!-- /.card-header -->
                <form method="POST" action="{{ route('borrarFavoritos') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <div class="card-body">
                        <div>
                            Tweets seleccionados: <span id="numSelectedTweets">0</span>
                        </div>
                        <div>
                            <button class="btn btn-block btn-danger" type="submit"> Borrar los Me Gusta seleccionados </button>
                        </div>
                        <div>
                            <span class="float-right">
                            <select class="js-example-basic-single" name="state" id="tweeteros" onchange="buscarTweetero()">
                                <option value=""> Seleccionar </option>
                                @foreach ($tweeteros as $user => $cant)
                                    <option value="{{ "@".$user }}">{{ $cant }} - {{ "@".$user }}</option>
                                @endforeach
                            </select>
                            </span>
                        </div>
                        <table id="myTweets" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th><input type="checkbox" onclick="checkAll(this)" /></th>
                                <th>User</th>
                                <th>Thumb</th>
                                <th>Fecha</th>
                                <th>Texto</th>
                                <th>RT</th>
                                <th>Likes</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($likes as $tweet)
                                <tr>
                                    <td><input type="checkbox" id="cb{{ $tweet->getId() }}" name="selectedFavorites[]" value="{{ $tweet->getId() }}" onclick="getNumSelectedTweets()" /></td>
                                    <td>{{ "@".$tweet->getUser()->getScreenName() }}</td>
                                    <td>
                                        @if ($tweet->hasThumbnail())
                                            <img src=" {{ $tweet->getThumbnail() }}:thumb" width="150px" \> </td>
                                        @endif 
                                    <td> 
                                        <i class="fas fa-clock" data-toggle="tooltip" title="{{ Utilidades::twitterDateFormat($tweet->getCreatedAt())  }}"></i>
                                        {{ Utilidades::twitterDateFormatHumans($tweet->getCreatedAt()) }}
                                    </td>
                                    <td>{{ $tweet->getText() }}</td>
                                   
                                    <td>{{ $tweet->getRetweetCount() }}</td>
                                    <td>{{ $tweet->getFavoriteCount() }}</td>
                                    <td>
                                        <i class="fas fa-map-pin" data-toggle="tooltip" title="{{ $tweet->getId()  }}"></i>
                                        <a href="https://twitter.com/leokarian/status/{{ $tweet->getId()  }}" target="_blank"><i class="fas fa-external-link-alt pl-1"></i></a>
                                        <a href="#"><i class="fas fa-trash-alt pl-1"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th>User</th>
                                <th>Thumb</th>
                                <th>Fecha</th>
                                <th>Texto</th>
                                <th>RT</th>
                                <th>Likes</th>
                                <th>Opciones</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </form>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- {{ print_r($likes) }} --}}
                </div>
            </div>
        </div>

        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

@section('footer')
        <!-- DataTables -->
        <script src="plugins/datatables/jquery.dataTables.js"></script>
        <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    
        <script src="dist/js/demo.js"></script>
        <!-- page script -->
        <script>
            $(function () {
                var table = $('#myTweets').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "order": [[ 7, "desc" ]],
                    "info": true,
                    "autoWidth": false,
                    "lengthMenu": [[ 10, 25, 50, 75, 100, -1], [ 10, 25, 50, 75, 100, "Todos"]],
                    "columnDefs": [
                        { "targets": [0 ,2], "orderable": false },
                        { "className": 'text-left', targets: [3, 4] },
                        { "className": 'text-center', targets: [0, 1, 5, 6, 7] },
                        { "width" : "2%", "targets" : [0 ] },
                        { "width" : "4%", "targets" : [1, 6] },
                        { "width" : "6%", "targets" : [5, 6] }
                    ],
                });
    
                table.on( 'draw', function () {
                    console.log( 'Redraw occurred at: '+new Date().getTime() );
                    getNumSelectedTweets();
                } );
    
                
                
            });
    
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
                $('#myTweets_filter label input').attr('id', 'search-box');
            });
    
            function checkAll(source) {
                checkboxes = document.getElementsByName('selectedFavorites[]');
                for(var i=0, n = checkboxes.length; i<n; i++) {
                    checkboxes[i].checked = source.checked;
                }
                getNumSelectedTweets();
            }
    
            function getNumSelectedTweets(){
                checkboxes = document.getElementsByName('selectedFavorites[]');
                cant = 0;
                for(var i=0, n = checkboxes.length; i<n; i++) {
                    if (checkboxes[i].checked) cant++;
                }
                element = document.getElementById('numSelectedTweets');
                element.innerHTML = cant;
            }
    
            function buscarTweetero(){
                var table = $('#myTweets').DataTable();
                table.search(document.getElementById("tweeteros").value).draw();
            }
        </script>
@endsection