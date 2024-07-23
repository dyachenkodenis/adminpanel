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

        <div class="card mb-12">

            <div class="card-body">

               <?php
                   
                    if(!empty($component->jsonvalue) && $component->jsonvalue){

                    $array_component = $component->jsonvalue;
                    echo "<script> const arr_data = '" .$array_component. "'; </script>";
                    
                    }else{
                    
                    $array_component = "[]";
                    echo "<script> const arr_data = '" .$array_component. "'; </script>";
                    
                    }

                  //  print_r($array_component);

               ?>
                  
            <div class="pt-2">

                {{ $component->title }}
                  
                 <div class="container_page_fields">
                             
                            
                   




                                <form id="form_add_field" class="row g-3 pt-3" novalidate>
                                @csrf
                                @method('POST')
                                <input type="text" name="page_id" value="{{$component->page_id}}" hidden>
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
     
       
            async function fetchData() {
                try {
                    let response = await fetch('/admin/cm', {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    let data = await response.json();
                    console.log(data.body);
                } catch (error) {
                    console.error('Error fetching data:', error);
                }
            }

        
            fetchData();


        // document.getElementById('add-data').addEventListener('click', async function() {
        //     try {
        //         let newData = { id: 4, name: 'Item 4' }; // Пример новых данных
        //         let response = await fetch('/json-add', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //             },
        //             body: JSON.stringify(newData)
        //         });
        //         let result = await response.json();
        //         console.log('Add Response:', result);
        //     } catch (error) {
        //         console.error('Error adding data:', error);
        //     }
        // });
    </script>

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
                                            //  console.log(info);
                                            if(info.alert_type == 'success'){

                                                location.reload();
                                            }


                                        })
                                        .catch(error => {
                                            console.error(error);
                                        });


                                });


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
