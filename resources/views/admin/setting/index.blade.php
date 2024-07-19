@extends('admin.layouts.app')


@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Группы настроек сайта</h1>
        <!--ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item active">
                <a href="{{ route('admin.setting.create') }}"  title="Добавить настроки сайта">
                    <button class="btn btn-primary">Добавить настроки сайта</button>
                </a>
            </li>
        </ol-->
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
                         @foreach ($setting as $content)                   
                              <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ "_$i" }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ "_$i" }}" aria-controls="collapse{{ "_$i" }}">
                                 {{ ($content->title_setting ?? "") }}
                               
                                </button>
                                </h2>
                                <div id="collapse{{ "_$i" }}" class="accordion-collapse collapse " aria-labelledby="heading{{ "_$i" }}">
                                <div class="accordion-body">
                                   
                                    <form id="{{ $content->id }}" method="post" action="{{ route('admin.setting.update', $content->id) }}" class="setting_form">
                                         @csrf
                                        @csrf()
                                        @method('POST')                                      
                                        <div class="row"> 
                                               @includeWhen($content->template_widget, 'components.widget.'.$content->template_widget)                  
                                        </div>                                       
                                        <button type="submit" class="btn btn-primary mt-3 submit">Submit</button>
                                        </form>

                                        <script>
                                            @php
                                            if(isset($content->value) && $content->value):     
                                            @endphp
                                        
                                            var formDataJson = '{!! $content->value !!}';

                                            var formData = JSON.parse(formDataJson);
                                        
                                                var form = document.getElementById('{{ $content->id }}');
                                                for (var key in formData) {
                                                    if (formData.hasOwnProperty(key)) {
                                                    var input = form.querySelector('[name="' + key + '"]');
                                                    if (input) {
                                                        input.value = formData[key];
                                                    }
                                                    }
                                                }
                                           @php
                                                endif;
                                           @endphp

                                            var forms = document.querySelectorAll('.setting_form');

                                            forms.forEach(function(form) {
                                          
                                            form.querySelector('.submit').addEventListener("click", function() {
                                                var formData = new FormData({'form' :form});

                                                fetch("{{ route('admin.setting.update', $content->id) }}", {
                                                method: "POST",
                                                  headers: {
                                                    "Content-Type": "application/json",
                                                    'X-CSRF-Token': "{{ csrf_token()  }}",
                                                },
                                                  body: formData,
                                                })
                                                .then(response => {
                                                if (!response.ok) {
                                                    throw new Error("Ошибка HTTP: " + response.status);
                                                }
                                                return response.json(); 
                                                })
                                                .then(data => {
                                              
                                                console.log(data);
                                                })
                                                .catch(error => {                                               
                                                console.error("Ошибка при отправке запроса:", error);
                                                });
                                            });
                                            });

                                        </script>
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