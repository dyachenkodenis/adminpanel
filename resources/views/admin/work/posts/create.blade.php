@extends('admin.layouts.app')


@section('content')

<main>
    <div class="container-fluid px-4">
      
        <ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item active">
              <a href="{{ route('admin.work.posts.index') }}" title="Go back">Назад к списку проектов</a>
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

                <form id="create" action='{{ route("admin.work.posts.store") }}' method="POST"  enctype="multipart/form-data">
                            @csrf
                            @csrf()
                            @method('POST')

                        <div class="col-md-12">
                            <label for="nameWork" class="form-label">Название страницы</label>
                            <input type="text" name="name_works" class="form-control" id="nameWorks" >
                            <div class="valid-feedback">
                           
                            </div>
                        </div>
                       

                        <div class="col-md-12 m-2">
                            <label for="work_template" class="form-label">Шаблон страницы</label>
                            <select class="form-select form-select-sm" name="template_work" aria-label=".form-select-sm example">
                                {{-- @foreach($files as $f)
                                    <option value="{{ str_replace('.blade.php', '', $f->getFilename()); }}" selected>
                                        {{ str_replace('.blade.php', '', $f->getFilename()); }}
                                    </option>
                                @endforeach     --}}
                            </select>
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