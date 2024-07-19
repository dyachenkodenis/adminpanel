@extends('admin.layouts.app')


@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Заявки с форм сайта</h1>
       
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
                         @foreach ($feedback as $content)                   
                              <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ "_$i" }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ "_$i" }}" aria-controls="collapse{{ "_$i" }}">
                                 {{ ($content->title ?? "") }}
                                </button>
                                </h2>
                                <div id="collapse{{ "_$i" }}" class="accordion-collapse collapse " aria-labelledby="heading{{ "_$i" }}">
                                <div class="accordion-body">
                                      
                                           @php
                                           echo "<pre>";
                                           $json = json_decode($content->value, true);
                                           print_r($json);
                                           echo "</pre>";
                                           @endphp                          
                                                                     
                                    
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