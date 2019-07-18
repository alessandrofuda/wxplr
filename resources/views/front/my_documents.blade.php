@extends('layouts.dashboard_layout')
@section('content')
    <div class="upper-test-container">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif
    <!--<h1></h1>-->
        <div class="box-header">
            <h3 class="box-title">{{ $page_title }}</h3>
        </div>
        <div class="content box">
            <div class="row">
                <div class="col-sm-12">
                    <table id="list_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                        <tr role="row">
                            <th>Name</th>
                            <th>Consultant Name</th>
                            <th>Date</th>
                            <th>Download</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($documents) > 0)
                            @foreach($documents as $document)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{!! $document['title'] !!}</td>
                                    <td class="sorting_1">{{ $document['consultant_name'] }}</td>
                                    <td class="sorting_1">{{ $document['date']->setTimezone( session('timezone') ? session('timezone') : 'UTC' )  }}</td>
                                    <td class="sorting_1"><a href="{{ $document['url'] }}"><i class="fa fa-cloud-download"></i> Download</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr role="row" class="odd">
                                <td colspan="4">No Documents found!</td>
                            </tr>
                        @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection