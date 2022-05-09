@extends('layouts.app')
@section('content')

       <div class="card">
           <div>
               <a href="{{route('employee.create')}}" class="btn btn-primary m-3">
                <i class="fas fa-plus-circle"></i>   Create Employee
               </a>
           </div>
           <div class="card-body">
               <table class="table table-bordered Datatable">
                   <thead>
                         <th>Employee ID</th>
                         <th>Name</th>
                         <th>Phone</th>
                         <th>Email</th>
                         <th>Department</th>
                         <th>Is Present</th>

                   </thead>
               </table>
           </div>

       </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function (){
            $('.Datatable').DataTable({
                processing:true,
                serverSide:true,
                ajax:'/employee/datatable/ssd',
                columns:[
                    {data:'employee_id',name:'employee_id'},
                    {data:'name',name:'name'},
                    {data:'phone',name:'phone'},
                    {data:'email',name:'email'},
                    {data:'department_name',name:'department_name'},
                    {data:'is_present',name:'is_present'},

                ]
            })
        });
    </script>
@endsection

