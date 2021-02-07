@extends('admin.layout.main')

@section('content')

<div class="row">
    <div class="col-sm-4">
        <div class="card table-card">
            <div class="card-header">
                <h3>All user Types</h3>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="ik ik-chevron-left action-toggle"></i></li>
                        <li><i class="ik ik-minus minimize-card"></i></li>
                        <li><i class="ik ik-x close-card"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user_types as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a></td>
                            </tr> 
                            @endforeach
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            fd
        </div>

    </div>

    <div class="col-sm-4">
        <div class="card">
            f
        </div>

    </div>

</div>

@endsection