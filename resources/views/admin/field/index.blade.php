@extends('admin.layouts.app')


@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Группа строк переводов</h1>
        <ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item active">
                <a href="{{ route('admin.field.create') }}"  title="Добавить строку">
                    <button class="btn btn-primary">Добавить строку перевода</button>
                </a>
            </li>
        </ol>
        @if(Session::has('notification'))
            <div class="alert alert-{{ Session::get('notification.alert-type') }}">
                {{ Session::get('notification.message') }}
            </div>
        @endif
        <div class="card mb-4"> 
           
            <div class="card-body">
                <div class="accordion">
                    @php
                    $i = 1;
                    @endphp
                         @foreach ($field as $content)                   
                              <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ "_$i" }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ "_$i" }}" aria-controls="collapse{{ "_$i" }}">
                                 {{ ($content->key ?? "") }}
                                </button>
                                </h2>
                                <div id="collapse{{ "_$i" }}" class="accordion-collapse collapse " aria-labelledby="heading{{ "_$i" }}">
                                <div class="accordion-body">
                                    {{-- print_r($content->value); --}}
                                    <form method="post" action="{{ route('admin.field.update', $content->id) }}">
                                         @csrf
                                        @csrf()
                                        @method('POST')
                                        <input type="text" value="{{ $content->key }}" name="key" hidden>

                                        <div class="row">
                                            @foreach(json_decode($content->value) as $k => $v)                                          
                                            <div class="col-md-4">
                                                <label  class="form-label">{{ $k }}</label>
                                                <input type="text" class="form-control" name="{{ $k }}"  value="{{ $v }}">
                                                <div class="valid-feedback">                                           
                                                </div>
                                            </div>
                                            @endforeach                                          
                                        </div>                                       
                                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                        </form>
                                </div>
                                </div>
                            </div>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('table_script')
<script src="/admin_panel/assets_admin/js/Chart.min.js" ></script> 
@endsection