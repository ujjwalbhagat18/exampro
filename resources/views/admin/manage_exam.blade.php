@extends('layouts.app')
@section('title','Dashboard')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Exam</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Exam</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">

                <div class="card-tools">
                  <a class="btn btn-info btn-sm" href="" data-toggle="modal" data-target="#myModal">Add New</a>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-striped table-bordered table-hover datatable">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Exam Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($exams as $key => $exam)
                      <tr>
                        <td>{{ $key +1 }}</td>
                        <td>{{ $exam['title'] }}</td>
                        <td>{{ $exam['category'] }}</td>
                        <td>{{ $exam['exam_date'] }}</td>
                        <td><input type="checkbox" class="exam_status" data-id=
                          "{{ $exam['id'] }}" <?php if($exam['status']==1){echo "checked";} ?> name="status"></td>
                        <td>
                          <a href="" class="btn btn-info">Edit</a>
                          <a href="{{ url('admin/delete_exam/'.$exam['id']) }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                       <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Exam Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                </table>
              </div>
            
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
        
        <h4 class="modal-title">Add New Exam</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form action="{{url('admin/add_new_exam')}}" class="database_operation">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Enter Title</label>
                            {{csrf_field()}}
                            <input type="text" required="required" name="title" placeholder="Enter Title" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Select Exam Date </label>
                            <input type="date" required="required" name="exam_date"  class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Select Exam Category</label>
                            {{csrf_field()}}
                            <select class="form-control" name="exam_category" required="required">
                              <option value="">Select</option>
                              @foreach($category as $cat)
                                <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <button class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </form>
        </div> 
    </div>
    </div>
</div>	
@endsection