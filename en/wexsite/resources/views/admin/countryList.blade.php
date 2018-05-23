@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="box-header">
            <a class="btn btn-primary" href="{{ url('admin/steady_aim_shoot/country_pdf') }}"><span class="glyphicon glyphicon-plus"></span> Add country Pdf</a>
        </div>
        <div class="col-md-12">
            <table id="country_pdf" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                    <th>Country Name</th>
                    <th>Pdf</th>
                    <th>Country Pdf Lable</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                @if (count($country_arr) > 0)
                    @foreach ($country_arr as $country)
                        <tr role="row" class="odd">
                            <td class="sorting_1">{{ $country['country_name'] }}</td>
                            <td class="sorting_1">
                                @if(!empty($country['country_pdf']))
                                    <a href="{{ asset($country['country_pdf']) }}" target="_blank">
                                        <img alt="Country_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                    </a>
                                @endif
                            </td>
                            <td class="sorting_1">{{ $country['country_pdf_label'] }}</td>
                            <td><a href="{{ $country['country_pdf_id'] }}/edit">Edit</a></td>
                        </tr>
                        @endforeach
                        @else
                        <tr role="row" class="odd">
                            <td colspan="2">No Availability found yet!</td>
                        </tr>
                        @endif
                </tbody>
            </table>
        </div>
    </div>
    @endsection