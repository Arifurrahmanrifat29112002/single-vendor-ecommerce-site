@extends('frontendWeb.layouts.webtemp')
@section('webpag')

 <div class="container"><br>

    <div class="row justify-content-center ">
        <div class="col-5 ">

            <div class="box-main p-5 bg bg-dark text-light">

                    @if($errors->any())
                    <div class="card">
                    @foreach ($errors->all() as $error)
                        <ul>
                            <li>
                                <p class="text-danger">{{ $error }}</p>
                            </li>
                        </ul>
                    @endforeach
                </div>
                @endif


                <form action="{{ route('addshipping') }}" method="post" >
                    <h4 class="text-center mb-4">Provide your Shpping Address</h4>

                    @csrf
                    <div class="form-group">
                        <label for="phone_Number">Phone Number</label>
                        <input type="phone" class="form-control" id="phone_Number" name="phone_number">
                    </div>
                    <div class="form-group">
                        <label for="city_name">City/Village Name</label>
                        <input type="text" class="form-control" id="city_name" name="city_name">
                    </div>
                    <div class="form-group">
                        <label for="post_code">Post Code</label>
                        <input type="number" class="form-control" id="post_code" name="post_code">
                    </div>




                     <button type="submit" class="btn btn-primary">Next</button>
                    


                </form>



            </div>
        </div>
    </div>
 </div>
@endsection


