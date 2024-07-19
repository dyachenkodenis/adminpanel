@extends('admin.layouts.app')


@section('content')

<main>
    <div class="container-fluid px-4">
      
        <ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item active">
              <a href="{{ route('admin.setting.index') }}" title="Go back">Назад к списку настроек</a>
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

                <form id="create" action='{{ route("admin.setting.store") }}' method="POST"  enctype="multipart/form-data">
                            @csrf
                            @csrf()
                            @method('POST')
                    <div class="row">
                         <div class="col-md-6">
                            <label for="title_setting" class="form-label">Ведите название настроек</label>
                            <input type="text" name="title_setting" class="form-control" id="title_setting" >
                            <div class="valid-feedback">                         
                            </div>
                        </div> 
                       
  
                        <div class="col-md-6">
                            <label for="select_widget" class="form-label">Выберите виджет для интерфейса настроек</label>
                            <select id="select_wiidget" name="select_widget" class="form-select">                         
                            @foreach($files as $f)
                                    <option value="{{ str_replace('.blade.php', '', $f->getFilename()); }}" selected>
                                        {{ str_replace('.blade.php', '', $f->getFilename()); }}
                                    </option>
                                @endforeach    
                            </select> 
                            <div class="valid-feedback">                         
                            </div>
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