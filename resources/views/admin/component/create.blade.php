@extends('admin.layouts.app')


@section('content')

    <main>
        <div class="container-fluid px-4">

            <ol class="breadcrumb mb-4 mt-4">
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin.field.index') }}" title="Go back">Назад к списку строк переводов</a>
                </li>
            </ol>
            <div class="row">
                @if ($errors->any())
                    <div class="col-md-12">
                        <div class="alert alert-danger" role="alert">
                            <div class="card-body">Danger Card</div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>


                    </div>

                @endif
            </div>
            <div class="card mb-12">

                <div class="card-body">

                    <form id="create" action='{{ route("admin.customfields.store") }}' method="POST"  enctype="multipart/form-data">
                        @csrf
                        @csrf()
                        @method('POST')

                        <div class="col-md-12">
                            <label for="key" class="form-label">lang</label>
                            <input type="text" name="lang" class="form-control">
                            <div class="valid-feedback">
                            </div>
                        </div>



                        <div class="col-12 mt-2">
                            <button class="btn btn-primary" type="submit">Cоздать</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </main>

@endsection
