@extends('admin.layouts.app')


@section('content')

<main>
    <div class="container-fluid px-4">
      
        <ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item active">
              <a href="{{ route('admin.menu.index') }}" title="Go back">Назад к списку меню</a>
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

                <form id="create" action='{{ route("admin.menu.store") }}' method="POST"  enctype="multipart/form-data">
                            @csrf
                            @csrf()
                            @method('POST')

                        <div class="col-md-12">
                            <label for="nameMenu" class="form-label">Название меню</label>
                            <input type="text" name="name_menu" class="form-control" id="nameMenu" >
                            <div class="valid-feedback">                      
                            </div>
                        </div>
                       

                        <div class="col-md-12 m-2">
                            <label for="menu_template" class="form-label">Шаблон меню</label>
                            <select class="form-select form-select-sm" name="template_menu" aria-label=".form-select-sm example">
                                @foreach($files as $f)
                                    <option value="{{ str_replace('.blade.php', '', $f->getFilename()); }}" selected>
                                        {{ str_replace('.blade.php', '', $f->getFilename()); }}
                                    </option>
                                @endforeach    
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