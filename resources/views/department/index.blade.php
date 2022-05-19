@extends('layouts.app')
@section('content')

       <div class="card">
           <div>
               <a href="{{route('department.create')}}" class="btn btn-primary m-3">
                <i class="fas fa-plus-circle"></i>   Create Department
               </a>
           </div>
           <div class="card-body">
               <table class="table table-bordered Datatable" style="width: 100%">
                   <thead>
                         <th class="no-sort no-search"></th>
                         <th>Title</th>
                         <th>Action</th>
                         <th class="hidden no-sort no-search">Updated at</th>

                   </thead>
               </table>
           </div>

       </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            var table = $('.Datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '/department/datatable/ssd',
                columns: [

                    {data: 'title', name: 'title'},
                    {data: 'action', name: 'action'},
                    {data: 'updated_at', name: 'updated_at'}


                ],
                order: [[2, "desc"]],
                columnDefs: [
                    // {
                    //     "targets": [8],
                    //     "visible": false
                    // },
                    // {
                    //     "targets": [0],
                    //     "visible": "control"
                    // },
                    // {
                    //     "targets": "no-sort",
                    //     "orderable": false
                    // },
                    {
                        "targets": "no-search",
                        "searchable": false
                    },
                    {
                        "targets": "hidden",
                        "visible": true
                    }

                ],
                language: {
                    // "paginate":{
                    //     "next":"<i class='fas fa-arrow-circle-o-right'></i>"
                    // },
                    // "processing":"<img>"
                }
            })
            $(document).on('click','.delete-btn',function (e,id){
                e.preventDefault();
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure to delete?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire("Deleted!", "Your file has been deleted.", "success");
                        $.ajax({
                            method:"DELETE",
                            url:`/department/${id}`,
                        }).done(function (res){
                            table.ajax.reload();
                        });


                    }
                })

            });
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

