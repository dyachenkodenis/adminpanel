@extends('admin.layouts.app')


@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dictionary</h1>
      
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
                         @foreach ($dict as $content)                   
                              <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ "_$i" }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ "_$i" }}" aria-controls="collapse{{ "_$i" }}">
                                 {{ ($content->word ?? "") }}
                                </button>
                                </h2>
                                <div id="collapse{{ "_$i" }}" class="accordion-collapse collapse " aria-labelledby="heading{{ "_$i" }}">
                                <div class="accordion-body">
                                  

                                        <div class="row">
                                            @foreach(json_decode($content->translate) as $k)                                          
                                            <div class="col-md-4">
                                                <span>{{ $k }}</span>
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