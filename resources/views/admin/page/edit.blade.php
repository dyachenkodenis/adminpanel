@extends('admin.layouts.app')


@section('content')

<main>

    <div class="container-fluid px-4">
        <!--h1 class="mt-4">Admin</h1-->
        <ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item active">
              <a href="{{ route('admin.page.index') }}" title="Go back">Назад к списку страниц</a>
            </li>
        </ol>
        @if (session('update'))
             <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                 <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <strong>{{ session('update') }}</strong>
               </div>
            </div>
        @endif

        <div class="card mb-12">

            <div class="card-body">


                   <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"  role="presentation">
                            <a class="nav-link" id="setting" data-bs-toggle="tab" href="#setting_panel" role="tab" aria-controls="setting" aria-selected="true">
                            Настройки страницы
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="content" data-bs-toggle="tab" href="#content_panel" role="tab" aria-controls="content" aria-selected="false">
                            Контент
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="widget" data-bs-toggle="tab" href="#widget_panel" role="tab" aria-controls="widget" aria-selected="true">
                            Компоненты
                            </a>
                        </li>
                    </ul>
            <div class="tab-content pt-2" id="tab-content">

                 <div class="tab-pane " id="setting_panel" role="tabpanel" aria-labelledby="setting">

                    <form id="setting_form" action="">
                    <div class="col-md-12 m-2">
                        <label for="page_name" class="form-label">Название страницы</label>
                        <input type="text" value="{{ $page->title }}" name="page_name" class="form-control" id="page_name">
                        <div class="valid-feedback">
                        </div>
                    </div>
                     <div class="col-md-12">
                        <label for="slugPage" class="form-label">Ссылка на страницу</label>
                        <input type="text" value="{{ $page->slug }}" name="slug_page" class="form-control" id="slugPage" >
                        <div class="valid-feedback">
                        </div>
                    </div>

                    <div class="col-md-12 m-2">
                            <label for="page_template" class="form-label">Шаблон страницы</label>
                            <select class="form-select form-select-sm" name="template_page" aria-label=".form-select-sm example">
                                @foreach($files as $f)
                                    @php
                                    $temp = str_replace('.blade.php', '', $f->getFilename());
                                    @endphp
                                    <option
                                        value="{{ $temp }}"
                                    @php
                                        echo ($temp === $page->template) ? "selected":"";
                                    @endphp
                                    >
                                        {{ str_replace('.blade.php', '', $f->getFilename()) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                      <div class="col-md-12 m-2">
                        <label for="page_template" class="form-label">Опубликовать/Скрыть страницу</label>
                        <select class="form-select form-select-sm" name="select_public" aria-label=".form-select-sm example">
                        <option value="activate" selected>Опубликовано</option>
                        <option value="deactivate">Скрыто</option>
                        </select>
                      </div>

                       <div class="col-md-12 mt-5">
                            <h3>Seo настройки</h3>
                        </div>


                        <div class="col-md-12 m-2">
                            <label for="page_keywords" class="form-label">Keywords</label>
                            <textarea class="form-control" name="page_keywords" id="page_keywords" rows="2"></textarea>
                        </div>

                        <div class="col-md-12 m-2">
                            <label for="page_description" class="form-label">Description</label>
                            <textarea class="form-control" name="page_description" id="page_description" rows="4"></textarea>
                        </div>

                        <div class="col-md-12 m-2">
                            <label for="page_schema" class="form-label">Schema</label>
                            <textarea class="form-control" name="page_schema" id="page_schema" rows="8"></textarea>
                        </div>

                      </form>

                 </div>

                  <div class="tab-pane " id="content_panel" role="tabpanel" aria-labelledby="content">
                    <ul class="nav nav-tabs" role="tablist">
                        {{--li class="nav-item" role="presentation">
                            <a class="nav-link active" id="ru_panel" data-bs-toggle="tab" href="#ru" role="tab" aria-controls="ru_panel" aria-selected="true">
                                ru
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="en_panel" data-bs-toggle="tab" href="#en" role="tab" aria-controls="en_panel" aria-selected="false">
                            en
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="uz_panel" data-bs-toggle="tab" href="#uz" role="tab" aria-controls="uz_panel" aria-selected="false">
                            uz
                            </a>
                        </li--}}
                    </ul>

                    <div class="tab-content pt-2" id="tab-content">
                        <div class="tab-pane active" id="ru" role="tabpanel" aria-labelledby="ru_panel">
                            <div class="container_page_fields">
                                @foreach($custom_fields->toArray() as $k)

                                    <form id="{{ 'field_'.$k['id'] }}" class="row g-3 p-3">
                                        @csrf
                                        @method('POST')
                                        <input type="text" name="custom_field_id" value="{{ $k['id'] }}" hidden>
                                        <input type="text" name="type" value="{{ ($k['jsonvalue']->type ?? "") }}" hidden>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" name="key" value="{{ ($k['jsonvalue']->key ?? "") }}" readonly class="form-control-plaintext">
                                            </div>

                                            <div class="col-md-4">
                                                <input type="text" name="value" value="{{ ($k['jsonvalue']->value ?? "") }}" class="form-control update_field">
                                            </div>
                                            <div class="col-md-1">
                                                <button data-update="{{ $k['id'] }}" class="btn btn-primary" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="col-md-1">
                                            <button data-delete="{{ $k['id'] }}" class="btn btn-danger" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                                </svg>
                                            </button>
                                            </div>
                                        </div>

                                    </form>

                                @endforeach
                            </div>




                                <form id="form_add_field" class="row g-3 pt-3" novalidate>
                                @csrf
                                @method('POST')
                                <input type="text" name="page_id" value="{{$page->id}}" hidden>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" name="key" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <select id="selectType" class="form-select" name="type">
                                          @php
                                              $get_type_field = App\Services\GetTypeFields::get_type();
                                          @endphp
                                            @foreach( $get_type_field  as $d => $dd)
                                                <option value="{{ $d }}">{{ $dd }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 value_field">
                                        <input type="text" name="value" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <button id="add_field" class="btn btn-primary" type="submit">Добавить строку</button>
                                    </div>
                                </div>

                            </form>


                        </div>
                        {{--div class="tab-pane" id="en" role="tabpanel" aria-labelledby="en_panel">
                            <x-pages.home id="en_component" widget='{--  with($page->widget) --}' />
                        </div>
                        <div class="tab-pane" id="uz" role="tabpanel" aria-labelledby="uz_panel">
                            <x-pages.home id="uz_component" widget='{--  with($page->widget) --}'/>
                        </div--}}
                    </div>

                  </div>

                   <div class="tab-pane " id="widget_panel" role="tabpanel" aria-labelledby="widget">

                   <div class="card mb-4">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th  colspan="3">
                                        <form id="form_component" action="">
                                            @csrf
                                            @method('POST')
                                            <input type="text" name="page_id" value="{{ $page->id }}" hidden>
                                            <div class="row">
                                            <div class="col-md-5 m-2">
                                                <select class="form-select" name="widget_id" aria-label=".form-select-sm example">
                                                    @foreach($widget as $ww)
                                                        <option value="{{ $ww->id }}">
                                                            {{ ($ww->title ?? "") }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-5 m-2">
                                            <button type="submit" id="add_component" class="btn btn-primary">Добавить компонент</button>
                                            </div>
                                            </div>
                                        </form>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach($component->toArray() as $cm)
                                    @php
                                    $all_widget_dat = App\Services\GetWidgetData::get_all($page->id);
                                    @endphp
                                <tr>
                                    <td>{{ ($cm['title'] ?? "") }}</td>
                                    <td>
                                        <!--button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCompnent_{{ $i }}">
                                            Редактировать компонент
                                        </button-->
                                        <a href="/admin/component/{{ $cm['id'] }}/edit" class="btn btn-primary" style="text-decoration:none" aria-current="true">
                                         Редактировать компонент
                                        </a>
                                        <div class="modal fade" id="editCompnent_{{ $i }}" tabindex="-1" aria-labelledby="editCompnent_{{ $i }}" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editCompnent_{{ $i }}">Редактировать компонент</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body container_page_fields_component">
                                                        @php
                                                            $get_field_from_component = \App\Services\GetWidgetData::get_widget_fields($cm['id']);
                                                          //dd($get_field_from_component);
                                                        @endphp

                                                        @foreach($get_field_from_component as $saved_field_for_component)
                                                            @php

                                                                    $id = $saved_field_for_component['id'];

                                                                     $saved_field_for_component = $saved_field_for_component['jsonvalue'];

                                                            @endphp

                                                        <form id="field_{{ $id  }}" class="g-3 pt-3">
                                                            @csrf
                                                            @method('POST')
                                                            <input type="text" name="custom_field_id" value="{{ $id }}" hidden>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="text"
                                                                           class="form-control"
                                                                           name="key"
                                                                           value="{{ ($saved_field_for_component->key ?? "") }}">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <select class="form-select"
                                                                            name="type"
                                                                           >
                                                                        @php
                                                                            $get_type_field = App\Services\GetTypeFields::get_type();
                                                                        @endphp
                                                                        @foreach( $get_type_field  as $d => $dd)
                                                                            <option value="{{ $d }}">{{ $dd }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text"
                                                                           class="form-control"
                                                                           name="value"
                                                                           value="{{ ($saved_field_for_component->value ?? "")}}">
                                                                </div>
                                                                <div class="col-md-2">

                                                                    <button class="btn btn-primary" data-update="{{ $id  }}" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"></path>
                                                                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"></path>
                                                                        </svg></button>
                                                                    <button class="btn btn-danger" data-delete="{{ $id  }}" type="submit">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"></path>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        @endforeach
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="" class="g-3 pt-3 form_add_field_camp">
                                                            @csrf
                                                            @method('POST')
                                                            <input type="text" name="web_components_id" value="{{ ($cm['id'] ?? "") }}" hidden>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input name="key" type="text" class="form-control">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <select class="form-select" name="type" id="selectTypeComponent">
                                                                        @php
                                                                            $get_type_field = App\Services\GetTypeFields::get_type();
                                                                        @endphp
                                                                        @foreach( $get_type_field  as $d => $dd)
                                                                            <option value="{{ $d }}">{{ $dd }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4 value_field_component">
                                                                    <input type="text" name="value" class="form-control">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button id="" class="btn btn-primary add_field_camp" type="submit">Добавить строку</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewCompnent_{{ $i }}">
                                           Просмотр компонента
                                        </button>
                                        <div class="modal fade" id="viewCompnent_{{ $i }}" tabindex="-1" aria-labelledby="viewCompnent_{{ $i }}" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="viewCompnent_{{ $i }}">Изображение компонента</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ ($all_widget_dat['thumbnail'] ?? "") }}" class="img-fluid"  alt="Изображение компонента">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button  class="btn btn-danger" data-delcomp="{{ $cm['id'] }}" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>

                                </div>
                            </div>

                            <script>
                                //начало скрипта для редактирования полей блока контент
                                var container_page_fields = document.querySelector('.container_page_fields');
                                var selectElement = document.querySelector('#selectType');
                                function logSelectedValue() {
                                    var selectedValue = selectElement.value;
                                    //console.log(selectedValue);
                                    let field_container = document.querySelector('.value_field');
                                    if(selectedValue == 'string'){
                                        field_container.innerHTML = '<input type="text" name="value" class="form-control">';
                                    }else if(selectedValue == 'numeric'){
                                        field_container.innerHTML = '<input type="number" name="value" class="form-control">';
                                    }else if(selectedValue == 'bool'){
                                        field_container.innerHTML = '<input class="form-check-input" type="checkbox" role="switch" checked>';
                                    }else if(selectedValue == 'textarea') {
                                        field_container.innerHTML = '<textarea class="form-control" rows="3"></textarea>';
                                    }else if(selectedValue == 'editor') {
                                        field_container.innerHTML = '<input type="text" name="value" class="form-control">';
                                    }else if(selectedValue == 'file'){
                                        // field_container.innerHTML = '<input id="lfm" type="file" name="value" class="form-control">';
                                        // $('#lfm').filemanager('file', {prefix: route_prefix});
                                    }else if(selectedValue == 'image'){
                                        // field_container.innerHTML = '<div class="input-group"><span class="input-group-btn"><a id="lfm2" data-input="thumbnail2" data-preview="holder2" class="btn btn-primary text-white"><i class="fa fa-picture-o"></i> Выбрать</a></span><input id="thumbnail2" class="form-control" type="text" name="image"></div>';
                                        // $('#lfm').filemanager('image', {prefix: route_prefix});
                                    }
                                }
                                selectElement.addEventListener('change', logSelectedValue);
                                window.addEventListener('load', logSelectedValue);

                                document.querySelector('#add_field').addEventListener('click', function(event) {
                                    event.preventDefault();

                                    var formAddFieldElement = document.getElementById('form_add_field');

                                    var formAddData = new FormData(formAddFieldElement);

                                    var formAddDataObject = {};
                                    formAddData.forEach(function(value, key){
                                        formAddDataObject[key] = value;
                                    });

                                    var jsonData = JSON.stringify(formAddDataObject);


                                    fetch("{{ route('admin.customfields.store') }}", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            'X-CSRF-Token': "{{ csrf_token()  }}",
                                        },
                                        body: jsonData,
                                    })
                                        .then(response => response.json())
                                        .then(info => {
                                            //  console.log(info);
                                            if(info.alert_type == 'success'){

                                                location.reload();
                                            }


                                        })
                                        .catch(error => {
                                            console.error(error);
                                        });


                                });

                                //обновление имеющегося поля записи
                                var buttons = document.querySelectorAll('button[data-update]');
                                buttons.forEach(function(button) {
                                    button.addEventListener('click', function(event) {
                                        event.preventDefault();
                                        let id_field = document.querySelector("#field_"+this.dataset.update);
                                        let formField = new FormData(id_field);
                                        var jsonFieldData = {};
                                        for (var pair of formField.entries()) {
                                            jsonFieldData[pair[0]] = pair[1];
                                        }
                                        fetch("/update_pages_field", {
                                            method: "POST",
                                            headers: {
                                                "Content-Type": "application/json",
                                                'X-CSRF-Token': "{{ csrf_token()  }}",
                                            },
                                            body: JSON.stringify(jsonFieldData),
                                        })
                                            .then(response => response.json())
                                            .then(info => {
                                                if(info.alert_type == 'success'){
                                                    location.reload();
                                                }
                                            })
                                            .catch(error => {
                                                console.error(error);
                                            });
                                    });
                                });

                                //удаление имеющегося поля записи
                                var buttons = document.querySelectorAll('button[data-delete]');
                                buttons.forEach(function(button) {
                                    button.addEventListener('click', function(event) {
                                        event.preventDefault();
                                        let id_field = this.dataset.delete;

                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', '/delete_field', true);
                                        xhr.setRequestHeader('Content-Type', 'application/json');
                                        xhr.setRequestHeader('X-CSRF-Token', '{{ csrf_token() }}');
                                        xhr.onreadystatechange = function() {
                                            if (xhr.readyState === 4) {
                                                if (xhr.status === 200) {
                                                    location.reload();

                                                } else {
                                                    console.error('Ошибка:', xhr.statusText);
                                                }
                                            }
                                        };
                                        var requestData = JSON.stringify({ _method: 'POST', _token: '{{ csrf_token() }}', id: id_field });
                                        xhr.send(requestData);

                                    });
                                });
                                //конец скрипта для редактирования полей блока контент
                            </script>

                            <script>
                                //добавление компонента
                                document.querySelector('#form_component').addEventListener('submit', function(event) {
                                    event.preventDefault();
                                    var inputs = this.querySelectorAll('input, select');
                                    var formComponentData = {};
                                    inputs.forEach(function(input) {
                                        if (input.type !== 'submit') {
                                            if (input.type === 'select-one') {
                                                formComponentData[input.name] = input.options[input.selectedIndex].value;
                                            } else {
                                                formComponentData[input.name] = input.value;
                                            }
                                        }
                                    });

                                    let close_add_component = document.getElementById('AddWidget');
                                    const myModal = bootstrap.Modal.getInstance(close_add_component);
                                    fetch("{{ route('admin.component.store') }}", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            'X-CSRF-Token': "{{ csrf_token()  }}",
                                        },
                                        body: JSON.stringify(formComponentData),
                                    })
                                        .then(response => response.json())
                                        .then(info => {
                                            if(info.result === true) {
                                                location.reload();
                                            }//end if result
                                        })
                                        .catch(error => {
                                            console.error(error);
                                        });

                                });
                                var container_page_fields_component = document.querySelector('.container_page_fields_component');
                                var selectElementCamp = document.querySelector('#selectTypeComponent');
                                function logSelectedValueComp() {
                                    var selectedValueComp = selectElementCamp.value;
                                    //console.log(selectedValue);
                                    let field_containerComp = document.querySelector('.value_field_component');
                                    if(selectedValueComp == 'string'){
                                         field_containerComp.innerHTML = '<input name="value" type="text" class="form-control">';
                                    }else if(selectedValueComp == 'number'){
                                        field_containerComp.innerHTML = '<input  name="value" type="number" class="form-control">';
                                    }else if(selectedValueComp == 'bool'){
                                        field_containerComp.innerHTML = '<input name="value" class="form-check-input" type="checkbox" role="switch" checked>';
                                    }else if(selectedValueComp == 'textarea') {
                                        field_containerComp.innerHTML = '<textarea name="value" class="form-control" rows="3"></textarea>';
                                    }else if(selectedValueComp == 'editor') {
                                        field_containerComp.innerHTML = '<input name="value" type="text" class="form-control">';
                                    }else if(selectedValueComp == 'file'){
                                        // field_container.innerHTML = '<input id="lfm" type="file" name="value" class="form-control">';
                                        // $('#lfm').filemanager('file', {prefix: route_prefix});
                                    }else if(selectedValueComp == 'image'){
                                        // field_container.innerHTML = '<div class="input-group"><span class="input-group-btn"><a id="lfm2" data-input="thumbnail2" data-preview="holder2" class="btn btn-primary text-white"><i class="fa fa-picture-o"></i> Выбрать</a></span><input id="thumbnail2" class="form-control" type="text" name="image"></div>';
                                        // $('#lfm').filemanager('image', {prefix: route_prefix});
                                    }
                                }
                                selectElementCamp.addEventListener('change', logSelectedValueComp);
                                window.addEventListener('load', logSelectedValueComp);

                                document.querySelectorAll('.add_field_camp').forEach(function(element) {
                                    element.addEventListener('click', function(event) {
                                    event.preventDefault();

                                        var form = event.target.closest('form');


                                        if (form) {

                                            var formDataObject = {};


                                            var formElements = form.elements;


                                            for (var i = 0; i < formElements.length; i++) {
                                                var element = formElements[i];
                                                if (element.tagName === 'INPUT' || element.tagName === 'SELECT' || element.tagName === 'TEXTAREA') {
                                                    formDataObject[element.name] = element.value;
                                                }
                                            }


                                          //  console.log(formDataObject);
                                        } else {
                                            console.error('Форма не найдена.');
                                        }

                                    var jsonData = JSON.stringify(formDataObject);

                                    fetch("{{ route('admin.customfields.store') }}", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            'X-CSRF-Token': "{{ csrf_token()  }}",
                                        },
                                        body: jsonData,
                                    })
                                        .then(response => response.json())
                                        .then(info => {
                                             console.log(info);
                                            if(info.alert_type == 'success'){

                                                location.reload();
                                            }


                                        })
                                        .catch(error => {
                                            console.error(error);
                                        });


                                    });
                                });
                                //удаление компонента
                                var buttons = document.querySelectorAll('button[data-delcomp]');
                                buttons.forEach(function(button) {
                                    button.addEventListener('click', function(event) {
                                        event.preventDefault();

                                        var jsonFieldData = {};
                                       jsonFieldData = event.target.dataset['delcomp'];
                                        fetch("/delete_comp", {
                                            method: "POST",
                                            headers: {
                                                "Content-Type": "application/json",
                                                'X-CSRF-Token': "{{ csrf_token()  }}",
                                            },
                                            body: JSON.stringify(jsonFieldData),
                                        })
                                            .then(response => response.json())
                                            .then(info => {
                                                if(info.alert_type == 'success'){
                                                    location.reload();
                                                }
                                            })
                                            .catch(error => {
                                                console.error(error);
                                            });
                                    });
                                });

                            </script>


                        </div>

                    </div>

                 </div>
            </div>

             <div class="col-12 mt-2 pt-5">
                <button id="save" class="btn btn-primary" type="button" >Сохранить страницу</button>
            </div>

             <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                <strong class="me-auto">Сообщение!!!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">

                </div>
            </div>
            </div>

              <script>
               const jsonObject = {};





                window.onload = function(){

                                    @if(isset($page->jsonvalue) && $page->jsonvalue)
                                        @php
                                        echo 'var data_json ='.json_encode($page->jsonvalue);
                                        @endphp

                                       // console.log(data_json.setting);

                                    let formS = document.querySelector('#setting_form');

                                    for(const key in data_json.setting) {
                                        const input = formS.querySelector(`input[name="${key}"]`)
                                        const textarea = formS.querySelector(`textarea[name="${key}"]`)
                                        const select = formS.querySelector(`select[name="${key}"]`)
                                        if (input) {
                                            input.value = data_json.setting[key]
                                        }
                                        if (textarea) {
                                            textarea.value = data_json.setting[key]
                                        }
                                        if (select) {
                                            select.value = data_json.setting[key]
                                        }
                                    }

                                    // let formRu = document.querySelector('#ru_component');
                                    //
                                    // for(const key in data_json.ru) {
                                    //     const input = formRu.querySelector(`input[name="${key}"]`)
                                    //      const textarea = formRu.querySelector(`textarea[name="${key}"]`)
                                    //       const select = formRu.querySelector(`select[name="${key}"]`)
                                    //     if (input) {
                                    //         input.value = data_json.ru[key]
                                    //     }
                                    //     if (textarea) {
                                    //         textarea.value = data_json.ru[key]
                                    //     }
                                    //     if (select) {
                                    //         select.value = data_json.ru[key]
                                    //     }
                                    // }

                                    // let formUz = document.querySelector('#uz_component');

                                    // for(const key in data_json.uz) {
                                    //     const input = formUz.querySelector(`input[name="${key}"]`)
                                    //     const textarea = formUz.querySelector(`textarea[name="${key}"]`)
                                    //       const select = formUz.querySelector(`select[name="${key}"]`)
                                    //     if (input) {
                                    //         input.setAttribute('value', data_json.uz[key])
                                    //     }
                                    //     if (textarea) {
                                    //         textarea.textContent = data_json.uz[key]
                                    //     }
                                    //     if (select) {
                                    //         select.value = data_json.uz[key]
                                    //     }
                                    // }

                                    //   let formEn = document.querySelector('#en_component');

                                    // for(const key in data_json.en) {
                                    //     const input = formEn.querySelector(`input[name="${key}"]`)
                                    //     const textarea = formEn.querySelector(`textarea[name="${key}"]`)
                                    //       const select = formEn.querySelector(`select[name="${key}"]`)
                                    //     if (input) {
                                    //         input.setAttribute('value', data_json.en[key])
                                    //     }
                                    //     if (textarea) {
                                    //         textarea.textContent = data_json.en[key]
                                    //     }
                                    //     if (select) {
                                    //         select.value = data_json.en[key]
                                    //     }
                                    // }
                                @endif

                        document.querySelector('#save').addEventListener('click', alldata);

                                        function getData() {
                                        const formData = new FormData(document.querySelector('form#setting_form'));
                                      //  const formDataRu = new FormData(document.querySelector('form#ru_component'));
                                      //  const formDataUz = new FormData(document.querySelector('form#uz_component'));
                                      //  const formDataEn = new FormData(document.querySelector('form#en_component'));



                                        jsonObject.setting = Object.fromEntries(formData);
                                   //    jsonObject.ru = Object.fromEntries(formDataRu);
                                     //   jsonObject.uz = Object.fromEntries(formDataUz);
                                      //  jsonObject.en = Object.fromEntries(formDataEn);
                                        return jsonObject;
                                        }


                                        function alldata()
                                        {
                                          //  console.log(getData());
                                            fetch("{{ route('admin.page.update', $page->id) }}", {
                                                method: "POST",
                                                headers: {
                                                    "Content-Type": "application/json",
                                                    'X-CSRF-Token': "{{ csrf_token()  }}",
                                                },
                                                body: JSON.stringify(getData()),
                                            })
                                                .then(response => response.json())
                                                .then(info => {
                                                 //   console.log(info); // Ответ от сервера

                                                    if(info['alert-type'] == 'success'){
                                                        const toastLiveExample = document.getElementById('liveToast')

                                                                const toast = new bootstrap.Toast(toastLiveExample)
                                                            document.querySelector('.toast-body').textContent = info['message'];

                                                                toast.show()

                                                    }
                                                })
                                                .catch(error => {
                                                    console.error(error);
                                                });


                                        }



                }



    </script>

            </div>
        </div>
    </div>
</main>

@endsection



@section('table_script')
        <!-- filemanager start -->
         <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
  <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script-->
             <!-- filemanager stop -->

  <script>
   var route_prefix = "/filemanager";
  </script>

   <script>
//     (function( $ ){
//
//   $.fn.filemanager = function(type, options) {
//     type = type || 'file';
//
//     this.on('click', function(e) {
//       var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
//       var target_input = $('#' + $(this).data('input'));
//       var target_preview = $('#' + $(this).data('preview'));
//       window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
//       window.SetUrl = function (items) {
//         var file_path = items.map(function (item) {
//           return item.url;
//         }).join(',');
//
//         // set the value of the desired input to image url
//         target_input.val('').val(file_path).trigger('change');
//
//         // clear previous preview
//         target_preview.html('');
//
//         // set or change the preview image src
//         items.forEach(function (item) {
//           target_preview.append(
//             $('<img>').css('height', '5rem').attr('src', item.thumb_url)
//           );
//         });
//
//         // trigger change event
//         target_preview.trigger('change');
//       };
//       return false;
//     });
//   }
//
// })(jQuery);

  </script>


  <script>
    // var lfm = function(id, type, options) {
    //  let button = document.getElementById(id);
    //
    //   button.addEventListener('click', function () {
    //     var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
    //     var target_input = document.getElementById(button.getAttribute('data-input'));
    //     var target_preview = document.getElementById(button.getAttribute('data-preview'));
    //
    //     window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
    //     window.SetUrl = function (items) {
    //       var file_path = items.map(function (item) {
    //         return item.url;
    //       }).join(',');
    //
    //       // set the value of the desired input to image url
    //       target_input.value = file_path;
    //       target_input.dispatchEvent(new Event('change'));
    //
    //       // clear previous preview
    //       target_preview.innerHtml = '';
    //
    //       // set or change the preview image src
    //       items.forEach(function (item) {
    //         let img = document.createElement('img')
    //         img.setAttribute('style', 'height: 5rem')
    //         img.setAttribute('src', item.thumb_url)
    //         target_preview.appendChild(img);
    //       });
    //
    //       // trigger change event
    //       target_preview.dispatchEvent(new Event('change'));
    //     };
    //   });
    // };
    //
    // lfm('lfm2', 'file', {prefix: route_prefix});
  </script>

  <script>
    // $(document).ready(function(){

    //   // Define function to open filemanager window
    //   var lfm = function(options, cb) {
    //     var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
    //     window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
    //     window.SetUrl = cb;
    //   };

    //   // Define LFM summernote button
    //   var LFMButton = function(context) {
    //     var ui = $.summernote.ui;
    //     var button = ui.button({
    //       contents: '<i class="note-icon-picture"></i> ',
    //       tooltip: 'Insert image with filemanager',
    //       click: function() {

    //         lfm({type: 'image', prefix: '/filemanager'}, function(lfmItems, path) {
    //           lfmItems.forEach(function (lfmItem) {
    //             context.invoke('insertImage', lfmItem.url);
    //           });
    //         });

    //       }
    //     });
    //     return button.render();
    //   };

      // Initialize summernote with LFM button in the popover button group
      // Please note that you can add this button to any other button group you'd like
    //   $('#summernote-editor').summernote({
    //     toolbar: [
    //       ['popovers', ['lfm']],
    //     ],
    //     buttons: {
    //       lfm: LFMButton
    //     }
    //   })
   // });

  document.addEventListener("DOMContentLoaded", function () {
    const storedTab = localStorage.getItem('activeTab');
    if (storedTab) {
      const triggerEl = document.querySelector(`#${storedTab}`);
      const tab = new bootstrap.Tab(triggerEl);
      tab.show();
    }

    const tabLinks = document.querySelectorAll('.nav-link');
    tabLinks.forEach(link => {
      link.addEventListener('click', function () {
        localStorage.setItem('activeTab', this.id);
      });
    });
  });
</script>
@endsection
