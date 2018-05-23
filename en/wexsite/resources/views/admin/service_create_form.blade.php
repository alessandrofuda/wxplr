@extends('admin.layout')
@section('content')
<div class='row'>
    <div class="col-md-12">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class='col-md-12'>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $page_title }}</h3> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="user_update_wrapper" class="dataTables_wrapper dt-bootstrap">
                    <div class="box-body">
					@if($page_type == 'edit')
                      <form role="form" method="post" enctype="multipart/form-data" action="{{ url('admin/service/'.$service->id.'/edit') }}">
					@else
					  <form role="form" method="post" enctype="multipart/form-data" action="{{ url('admin/service/create') }}">
					@endif
                        <!-- text input -->                        
                        <div class="form-group">
                          <label>Service Name</label>
							@if($page_type == 'edit')
                          <input type="text" name="sname" required class="form-control" placeholder="Service Name" value="{{ $service->name }}">
						  @else
						  <input type="text" name="sname" required class="form-control" placeholder="Service Name" value="{{ old('sname') }}">
							@endif
						</div>
						<div class="form-group">
						<label>Service Type</label>						
						@if($page_type == 'edit')
							<div class="radio">
						  <label>
							<input type="radio" name="stype" required id="stype1" value="free" checked="" @if($service->type == 'free') checked="" @endif>
							Free
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="stype" required id="stype2" value="paid" @if($service->type == 'paid') checked="" @endif>
							Paid
						  </label>
						</div>
						@else
							<div class="radio">
						  <label>
							<input type="radio" name="stype" required id="stype1" value="free" checked="" @if(old('stype') == 'free') checked="" @endif>
							Free
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="stype" required id="stype2" value="paid" @if(old('stype') == 'paid') checked="" @endif>
							Paid
						  </label>
						</div>
						@endif
					  </div>
					<div class="form-group">
					<label>Price</label>
						<div class="input-group">
							<span class="input-group-addon">&euro;</span>
						@if($page_type == 'edit' && $service->type=="paid")
							<input type="text" name="sprice" value="{{ $service->price }}" class="form-control">
						@else
							<input type="text" name="sprice" value="{{ old('sprice') }}" class="form-control">
						@endif
						  </div>
					</div>
						<div class="form-group">
                          <label for="simage">Image</label>                          
							@if($page_type == 'edit')
								<input type="file" name="simage" >
								  <br/><img  alt="{{ $service->name }}"  src="{{ asset($service->image) }}" width="100">
							@else
								<input type="file" required name="simage" >
							@endif
                        </div>
						<div class="form-group">
                          <label for="simage">User dashboard image</label>                          
							@if($page_type == 'edit')
								<input type="file" name="user_dashboard_image" >
								  <br/><img  alt="{{ $service->name }}" src="{{ asset($service->user_dashboard_image) }}" width="100">
							@else
								<input type="file" required name="user_dashboard_image" >
							@endif
                        </div>
						<div class="form-group">
                          <label>Description</label>
							<textarea name="sdesc"  id="textarea-ckeditor" required required id="desc" class="form-control" placeholder="Description" rows="8">@if($page_type == 'edit'){{ $service->description }}@endif</textarea>
						</div>
						<div class="form-group">
                          <label>User Dashboard Small Description (max. 500 word)</label>
							<textarea name="user_dashboard_desc"  id="textarea-ckeditor" required required id="desc" class="form-control" placeholder="Description" rows="8">@if($page_type == 'edit'){{ $service->user_dashboard_desc }}@endif</textarea>
						</div>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/services') }}" class="btn btn-default">Cancel</a>
                      </form>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection