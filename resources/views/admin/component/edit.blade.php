 @extends('admin.layouts.app')


@section('content')

<main>
  
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ $component->title }}</h1>
        <div class="row">
            <div class="col-md-12 pt-2 pb-4">
                   <a class="btn btn-primary" href="/admin/page/{{  $component->page_id }}/edit">Переход на страницу компонента</a>
            </div>
        </div>
     
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


        @php
            $locales =  \App\Services\Options\GetListLang::get();
           // print_r($locales);
        @endphp
        <div class="card mb-12">

            <div class="card-body">

              <div class="tab-pane " id="content_panel" role="tabpanel" aria-labelledby="content">
                    <ul class="nav nav-tabs" role="tablist">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($locales as $loc)
                          <li class="nav-item" role="presentation">
                            <a class="nav-link {{ ($i == 1)?"active":""; }}" 
                                id="{{ strtolower($loc) }}_panel" 
                                data-bs-toggle="tab" 
                                href="#{{ strtolower($loc) }}" 
                                role="tab" 
                                aria-controls="{{ strtolower($loc) }}_panel" 
                                aria-selected="{{ ($i == 1)?"true":""; }}">
                                @php 
                                    echo strtolower($loc);
                                @endphp
                            </a>
                        </li>      
                        @php
                            $i++;
                        @endphp
                        @endforeach
                    </ul>
                  
            <div class="tab-content pt-2" id="tab-content">

            @php
                $i = 1;
            @endphp
            @foreach ($locales as $loc)
            <div class="tab-pane {{ ($i == 1)?"active":""; }}" 
                    id="{{ strtolower($loc) }}" 
                    role="tabpanel" 
                    aria-labelledby="{{ strtolower($loc) }}_panel">
                {{-- <h3>
                       {{ $component->title }}
                </h3> --}}
             
                  
                 <div class="container_page_fields">                   
                    <div class="container_page_fields">
                        @php
                            $arr_component_js = json_decode($component->jsonvalue);                          
                        @endphp
                                @foreach($arr_component_js as $k => $v)
                                @php
                                    $sub_keys = array_keys((array)$v);                                          
                                    $sub_keys_str = implode(', ', $sub_keys);
                                 
                                @endphp     
                                    @foreach ($v as $sub)             
                                    @if($sub->lang === strtolower($loc))                

                                    <form id="field_{{ $sub_keys_str }}" class="row g-3 p-3">
                                        @csrf
                                        @method('POST')
                                        <input type="text" name="field_id" value="{{ $sub_keys_str }}" hidden>
                                        <input type="text" name="component_id" value="{{ $component->id }}" hidden>
                                        <input type="text" name="type" value="{{ ($sub->type ?? 'string') }}" hidden>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" name="key" value="{{ ($sub->key ?? "") }}" readonly class="form-control-plaintext">
                                            </div>

                                            <div class="col-md-4">
                                                <input type="text" name="value" value="{{ ($sub->value ?? "") }}" class="form-control update_field">
                                            </div>
                                            <div class="col-md-1">
                                                <button data-update="{{ $sub_keys_str }}" class="btn btn-primary" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="col-md-1">
                                            <button data-delete="{{ $sub_keys_str }}" class="btn btn-danger" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                                </svg>
                                            </button>
                                            </div>
                                        </div>

                                    </form>
                                    @endif
                                    @endforeach

                                @endforeach
                            </div>
                 

                  


                 
                
                </div></div>
             @php
                $i++;
            @endphp
            @endforeach
                   </div>

                       <div class="card mb-12">
            <div class="card-body">

                      <form id="form_add_field" class="row g-3 pt-3" novalidate>
                                @csrf
                                @method('POST')
                                <input type="text" name="page_id" value="{{$component->page_id}}" hidden>
                              
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" name="key" class="form-control">
                                    </div>
                                     <div class="col-md-1">
                                        <select id="selectType" class="form-select" name="lang">
                                            @php
                                                $r = 1;
                                            @endphp
                                            @foreach( $locales  as  $ll)
                                                <option value="{{ strtolower($ll) }}">{{ strtolower($ll) }}</option>
                                                @php
                                                $r++;
                                            @endphp
                                            @endforeach
                                        </select>
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
            </div></div>

         
             <!--div class="col-12 mt-2 pt-5">
                <button id="save" class="btn btn-primary" type="button" >Сохранить страницу</button>
            </div-->

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
                document.querySelector('#add_field').addEventListener('click', function(event) {
                                    event.preventDefault();

                                    var formAddFieldElement = document.getElementById('form_add_field');

                                    var formAddData = new FormData(formAddFieldElement);

                                    var formAddDataObject = {};
                                    formAddData.forEach(function(value, key){
                                        formAddDataObject[key] = value;
                                    });

                                    var jsonData = JSON.stringify(formAddDataObject);


                                      fetch("{{ route('admin.component.update', $component->id) }}", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            'X-CSRF-Token': "{{ csrf_token()  }}",
                                        },
                                        body: jsonData,
                                    })
                                        .then(response => response.json())
                                        .then(info => {
                                     
                                            if(info.alert_type  == 'success'){
                                          
                                                const toastLiveExample = document.getElementById('liveToast')

                                                const toast = new bootstrap.Toast(toastLiveExample)
                                                document.querySelector('.toast-body').textContent = info['message'];

                                                                toast.show();
                                                    
                                                              //   location.reload();

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
                                        fetch("/updatefields", {
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
                                                 //  location.reload();
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
                                        xhr.open('POST', '/deletefields', true);
                                        xhr.setRequestHeader('Content-Type', 'application/json');
                                        xhr.setRequestHeader('X-CSRF-Token', '{{ csrf_token() }}');
                                        xhr.onreadystatechange = function() {
                                            if (xhr.readyState === 4) {
                                                if (xhr.status === 200) {
                                                  // location.reload();

                                                } else {
                                                    console.error('Ошибка:', xhr.statusText);
                                                }
                                            }
                                        };
                                        var requestData = JSON.stringify({ _method: 'POST', _token: '{{ csrf_token() }}', id: id_field , id_component: '{{ $component->id }}'});
                                        xhr.send(requestData);

                                    });
                                });
    </script>

            </div>
        </div>
         </div>
    </div>
</main>

@endsection
 


@section('table_script')
        <!-- filemanager start -->
         <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
  <script src="/admin_panel/js/bootstrap.min.js"></script>
<!-- filemanager stop -->



@endsection
