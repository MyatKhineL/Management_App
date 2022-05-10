@extends('layouts.app')
@section('content')

       <div class="card">
           <div>
               <a href="{{route('employee.create')}}" class="btn btn-primary m-3">
                <i class="fas fa-plus-circle"></i>   Create Employee
               </a>
           </div>
           <div class="card-body">
               <table class="table table-bordered Datatable" style="width: 100%">
                   <thead>
                         <th class="no-sort no-search"></th>
                         <th>Employee ID</th>
                         <th>Name</th>
                         <th>Phone</th>
                         <th>Email</th>
                         <th>Department</th>
                         <th>Is Present</th>
                         <th>Action</th>
                         <th class="hidden no-sort no-search">Updated at</th>

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
                responsive:true,
                ajax:'/employee/datatable/ssd',
                columns:[
                    {data:'plus-icon',name:'plus-icon'},
                    {data:'employee_id',name:'employee_id'},
                    {data:'name',name:'name'},
                    {data:'phone',name:'phone'},
                    {data:'email',name:'email'},
                    {data:'department_name',name:'department_name'},
                    {data:'is_present',name:'is_present'},
                    {data:'action',name:'action'},
                    {data:'updated_at',name:'updated_at'},



                ],
                order:[[8,"desc"]],
                columnDefs:[
                    {
                        "targets":[8],
                        "visible":false
                    },
                    {
                        "targets":[0],
                        "visible":"control"
                    },
                    {
                        "targets":"no-sort",
                        "orderable":false
                    },
                    {
                        "targets":"no-search",
                        "searchable":false
                    },
                    {
                        "targets":"hidden",
                        "visible":true
                    }

                ],
                language:{
                    // "paginate":{
                    //     "next":"<i class='fas fa-arrow-circle-o-right'></i>"
                    // },
                    // "processing":"<img>"
                }
            })
        });
        @if(session('create'))
        Swal.fire({
            title:'Successfully created',
            text:'{{session('create')}}',
            icon:'success',
        });
        @endif
        @if(session('update'))
        Swal.fire({
            title:'Successfully updated',
            text:'{{session('update')}}',
            icon:'update',
        });
        @endif
    </script>
@endsection

