@extends('layouts.app_plain')

@section('main')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                   <div class="mb-3 text-center">
                       <h5 class="mb-3">QR Code</h5>
                       <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate('lee bae')) !!} ">
                       <a class="text-muted d-block mt-3">Please Scan QR to check in or checkout</a>
                   </div>
                    <hr>
                       <div class="my-4 text-center">
                           <h5 class="">Pin Code</h5>
                           <input type="text" name="mycode" id="pincode-input1">
                           <p class="text-muted mt-3">Please enter your pin code QR to check in or checkout</p>
                       </div>
                   </div>
                </div>
            </div>
        </div>

    </div>
@endsection


 @section('scripts')

      <script>

              // Csrf token
              let token = document.head.querySelector('meta[name="csrf-token"]');
              if (token) {
              $.ajaxSetup({
                  headers: {
                      "X-CSRF-TOKEN": token.content,
                  },
              });
          } else {
              console.log("csrf token not found");
          }
              $('#pincode-input1').pincodeInput({
              inputs: 6,
              complete: function(value, e, errorElement) {
              $.ajax({
              url: "",
              method: "POST",
              data: {
              "pin_code": value
          },
              success: function(res) {
              if (res.status == 'success') {
              Swal.fire({
              icon: res.status,
              title: res.title,
              text: res.message,
          })
          } else {
              const Toast = Swal.mixin({
              toast: true,
              position: 'top',
              showConfirmButton: false,
              timer: 2500,
              timerProgressBar: true,
              didOpen: (toast) => {
              toast.addEventListener('mouseenter',
              Swal.stopTimer)
              toast.addEventListener('mouseleave',
              Swal
              .resumeTimer)
          }
          })
              Toast.fire({
              icon: res.status,
              title: res.title,
          })
          }
              $('.pincode-input-container .pincode-input-text').val("");
              $('.pincode-input-text').first().select().focus();
          }
          })
              $('.pincode-input-text').first().select().focus();
          }
          });
              $('.pincode-input-text').first().select().focus();


              {{--$('#pincode-input1').pincodeInput({inputs:6,complete:function(value, e, errorElement){--}}
              {{--        console.log("code entered: " + value);--}}

              {{--        $.ajax({--}}
              {{--            url:"{{route('checkin')}}",--}}
              {{--            type:"POST",--}}
              {{--            data:{"pin_code":value},--}}
              {{--            success:function (res){--}}
              {{--                if(res.status == 'success'){--}}
              {{--                    Toast.fire({--}}
              {{--                        icon:'success',--}}
              {{--                        title:res.message,--}}
              {{--                    });--}}
              {{--                }else{--}}
              {{--                    Toast.fire({--}}
              {{--                        icon:'error',--}}
              {{--                        title:res.message,--}}
              {{--                    });--}}
              {{--                }--}}

              {{--            }--}}
              {{--        });--}}

              {{--        /*do some code checking here*/--}}

              {{--        $(errorElement).html("I'm sorry, but the code not correct");--}}
              {{--    }});--}}
              {{--$('#pincode-input1').pincodeInput({--}}
              {{--    inputs:6,--}}
              {{--    complete: function(value, e, errorElement) {--}}
              {{--        $.ajax({--}}
              {{--            url: "{{ route('checkin') }}",--}}
              {{--            method: "POST",--}}
              {{--            data: {--}}
              {{--                "pin_code": value--}}
              {{--            },--}}
              {{--            success: function(res) {--}}
              {{--                if (res.status == 'success') {--}}
              {{--                    Swal.fire({--}}
              {{--                        icon: res.status,--}}
              {{--                        title: res.title,--}}
              {{--                        text: res.message,--}}
              {{--                    })--}}
              {{--                } else {--}}
              {{--                    const Toast = Swal.mixin({--}}
              {{--                        toast: true,--}}
              {{--                        position: 'top',--}}
              {{--                        showConfirmButton: false,--}}
              {{--                        timer: 2500,--}}
              {{--                        timerProgressBar: true,--}}
              {{--                        didOpen: (toast) => {--}}
              {{--                            toast.addEventListener('mouseenter',--}}
              {{--                                Swal.stopTimer)--}}
              {{--                            toast.addEventListener('mouseleave',--}}
              {{--                                Swal--}}
              {{--                                    .resumeTimer)--}}
              {{--                        }--}}
              {{--                    })--}}
              {{--                    Toast.fire({--}}
              {{--                        icon: res.status,--}}
              {{--                        title: res.title,--}}
              {{--                    })--}}
              {{--                }--}}
              {{--                $('.pincode-input-container .pincode-input-text').val("");--}}
              {{--                $('.pincode-input-text').first().select().focus();--}}
              {{--            }--}}
              {{--        })--}}
              {{--        $('.pincode-input-text').first().select().focus();--}}
              {{--    }--}}
              {{--});--}}
              {{--$('.pincode-input-text').first().select().focus();--}}

      </script>
 @endsection

