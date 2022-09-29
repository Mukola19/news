@extends('layouts.admin')

@section('title', 'Admin')


@section('content')
    <div class="container d-flex justify-content-center mt-5 bg-color">
            <div class="col-lg-6 mb-5 mb-lg-0 ">
                <div class="card">
                    <h1 class="mt-4 mr-4 text-center">Вхід в адмін панель</h1>
                    <div class="card-body py-5 px-md-5">
                        @error('message')
                            <p class="mr-4 text-center text-danger font-weight-bold">{{ $message }}</p>
                        @enderror

                        <form action="{{ route('admin.login_process') }}" method="POST">
                            @csrf
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3Example3">Логін</label>
                                <input name="email" type="email" id="form3Example3" class="form-control" />
                            </div>


                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3Example4">Пароль</label>
                                <input name="password" type="password" id="form3Example4" class="form-control" />
                            </div>


                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4">
                                Війти
                            </button>
                        </form>
                    </div>
            </div>
        </div>
    </div>


@endsection
