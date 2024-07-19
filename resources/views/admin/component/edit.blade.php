 @extends('admin.layouts.app')


@section('content')

<main>
  
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ $component->title }}</h1>
        <a href="/admin/page/1/edit">переход на страницу компонента</a>
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


                  
            <div class="tab-content pt-2" id="tab-content">

                 <div class="tab-pane " id="setting_panel" role="tabpanel" aria-labelledby="setting">

                    <form id="setting_form" action="">
                    <div class="col-md-12 m-2">
                        <label for="page_name" class="form-label">Название страницы</label>
                        <input type="text" value="{--{ $component->title }--}" name="page_name" class="form-control" id="page_name">
                        <div class="valid-feedback">
                        </div>
                    </div>
                     <div class="col-md-12">
                        <label for="slugPage" class="form-label">Ссылка на страницу</label>
                        <input type="text" value="{--{ $component->slug }--}" name="slug_page" class="form-control" id="slugPage" >
                        <div class="valid-feedback">
                        </div>
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

                                    @if(isset($component->jsonvalue) && $component->jsonvalue)
                                        @php
                                        echo 'var data_json ='.json_encode($component->jsonvalue);
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

                                    let formRu = document.querySelector('#ru_component');
                                                                 
                                @endif

                        document.querySelector('#save').addEventListener('click', alldata);

                                        function getData() {
                                        const formData = new FormData(document.querySelector('form#setting_form'));
                                       const formDataRu = new FormData(document.querySelector('form#ru_component'));
                                       const formDataUz = new FormData(document.querySelector('form#uz_component'));
                                       const formDataEn = new FormData(document.querySelector('form#en_component'));



                                        jsonObject.setting = Object.fromEntries(formData);
                                     
                                        return jsonObject;
                                        }


                                        function alldata()
                                        {
                                          //  console.log(getData());
                                            fetch("{{ route('admin.page.update', $component->id) }}", {
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



@endsection
