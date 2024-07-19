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
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="setting" data-bs-toggle="tab" href="#setting_panel" role="tab" aria-controls="setting" aria-selected="true">
                            Основная информация о пользователе
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="content" data-bs-toggle="tab" href="#content_panel" role="tab" aria-controls="content" aria-selected="false">
                           Дополнительная информация
                            </a> 
                        </li>                  
                    </ul>
            <div class="tab-content pt-2" id="tab-content">

                 <div class="tab-pane " id="setting_panel" role="tabpanel" aria-labelledby="setting">

                    <form id="setting_form" action="">
                    <div class="col-md-12 m-2">
                        <label for="page_name" class="form-label">Имя пользователя</label>
                        <input type="text" value="{{ $user->name }}" name="page_name" class="form-control" id="page_name">
                        <div class="valid-feedback">                      
                        </div>
                    </div>
                     

                  
                      </form>

                 </div>

                  <div class="tab-pane active" id="content_panel" role="tabpanel" aria-labelledby="content">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
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
                        </li>
                    </ul>

                    <div class="tab-content pt-2" id="tab-content">
                        <div class="tab-pane active" id="ru" role="tabpanel" aria-labelledby="ru_panel">                              
                            <x-other.user  id="ru_component"/>    
                        </div>
                        <div class="tab-pane" id="en" role="tabpanel" aria-labelledby="en_panel">
                            <x-other.user id="en_component"/>    
                        </div>
                        <div class="tab-pane" id="uz" role="tabpanel" aria-labelledby="uz_panel">
                            <x-other.user id="uz_component"/>    
                        </div>
                    </div>

                  </div>
            </div>

             <div class="col-12 mt-2">
                <button id="save" class="btn btn-primary" type="button" >Submit form</button>
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

                window.onload = function(){

                                    @if(isset($user->jsonvalue) && $user->jsonvalue)
                                        @php
                                        echo 'var data_json ='.json_encode($page->jsonvalue);
                                        @endphp

                                        console.log(data_json.setting);

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

                                    let formRu = document.querySelector('#ru_component');

                                    for(const key in data_json.ru) {
                                        const input = formRu.querySelector(`input[name="${key}"]`)
                                         const textarea = formRu.querySelector(`textarea[name="${key}"]`)
                                          const select = formRu.querySelector(`select[name="${key}"]`)
                                        if (input) {
                                            input.value = data_json.ru[key]
                                        }
                                        if (textarea) {
                                            textarea.value = data_json.ru[key]
                                        }
                                        if (select) {
                                            select.value = data_json.ru[key]
                                        }
                                    }

                                    let formUz = document.querySelector('#uz_component');

                                    for(const key in data_json.uz) {
                                        const input = formUz.querySelector(`input[name="${key}"]`)
                                        const textarea = formUz.querySelector(`textarea[name="${key}"]`)
                                          const select = formUz.querySelector(`select[name="${key}"]`)
                                        if (input) {
                                            input.setAttribute('value', data_json.uz[key])
                                        }
                                        if (textarea) {
                                            textarea.textContent = data_json.uz[key]
                                        }
                                        if (select) {
                                            select.value = data_json.uz[key]
                                        }
                                    }

                                      let formEn = document.querySelector('#en_component');

                                    for(const key in data_json.en) {
                                        const input = formEn.querySelector(`input[name="${key}"]`)
                                        const textarea = formEn.querySelector(`textarea[name="${key}"]`)
                                          const select = formEn.querySelector(`select[name="${key}"]`)
                                        if (input) {
                                            input.setAttribute('value', data_json.en[key])
                                        }
                                        if (textarea) {
                                            textarea.textContent = data_json.en[key]
                                        }
                                        if (select) {
                                            select.value = data_json.en[key]
                                        }
                                    }
                                @endif

                        document.querySelector('#save').addEventListener('click', alldata);

                                        function getData() {
                                        const formData = new FormData(document.querySelector('form#setting_form'));
                                        const formDataRu = new FormData(document.querySelector('form#ru_component'));
                                        const formDataUz = new FormData(document.querySelector('form#uz_component'));
                                        const formDataEn = new FormData(document.querySelector('form#en_component'));
                                        
                                        const jsonObject = {};
                                        
                                        jsonObject.setting = Object.fromEntries(formData);
                                        jsonObject.ru = Object.fromEntries(formDataRu);
                                        jsonObject.uz = Object.fromEntries(formDataUz);
                                        jsonObject.en = Object.fromEntries(formDataEn);
                                        return jsonObject;
                                        }


                                        function alldata()
                                        {
                                          //  console.log(getData());
                                            fetch("{{ route('admin.page.update', $user->id) }}", {
                                                method: "POST",
                                                headers: {
                                                    "Content-Type": "application/json",
                                                    'X-CSRF-Token': "{{ csrf_token()  }}",
                                                },
                                                body: JSON.stringify(getData()),
                                            })
                                                .then(response => response.json())
                                                .then(info => {
                                                    console.log(info); // Ответ от сервера

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