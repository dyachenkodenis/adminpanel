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
                            Настройки страницы
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="content" data-bs-toggle="tab" href="#content_panel" role="tab" aria-controls="content" aria-selected="false">
                            Контент
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
                                    <option value="{{ str_replace('.blade.php', '', $f->getFilename()); }}" selected>
                                        {{ str_replace('.blade.php', '', $f->getFilename()); }}
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
                            <x-pages.home  id="ru_component"/>    
                        </div>
                        <div class="tab-pane" id="en" role="tabpanel" aria-labelledby="en_panel">
                            <x-pages.home id="en_component"/>    
                        </div>
                        <div class="tab-pane" id="uz" role="tabpanel" aria-labelledby="uz_panel">
                            <x-pages.home id="uz_component"/>    
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

                                    @if(isset($page->jsonvalue) && $page->jsonvalue)
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




@section('table_script')
        <!-- filemanager stop -->
         <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
             <!-- filemanager stop -->

                 <!-- filemanager start-->
     
  <script>
   var route_prefix = "/filemanager";
  </script>

   <script>
    (function( $ ){

  $.fn.filemanager = function(type, options) {
    type = type || 'file';

    this.on('click', function(e) {
      var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
      var target_input = $('#' + $(this).data('input'));
      var target_preview = $('#' + $(this).data('preview'));
      window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
      window.SetUrl = function (items) {
        var file_path = items.map(function (item) {
          return item.url;
        }).join(',');

        // set the value of the desired input to image url
        target_input.val('').val(file_path).trigger('change');

        // clear previous preview
        target_preview.html('');

        // set or change the preview image src
        items.forEach(function (item) {
          target_preview.append(
            $('<img>').css('height', '5rem').attr('src', item.thumb_url)
          );
        });

        // trigger change event
        target_preview.trigger('change');
      };
      return false;
    });
  }

})(jQuery);

  </script>
  <script>
    $('#lfm').filemanager('image', {prefix: route_prefix});
    // $('#lfm').filemanager('file', {prefix: route_prefix});
  </script>

  <script>
    var lfm = function(id, type, options) {
      let button = document.getElementById(id);

      button.addEventListener('click', function () {
        var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
        var target_input = document.getElementById(button.getAttribute('data-input'));
        var target_preview = document.getElementById(button.getAttribute('data-preview'));

        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = function (items) {
          var file_path = items.map(function (item) {
            return item.url;
          }).join(',');

          // set the value of the desired input to image url
          target_input.value = file_path;
          target_input.dispatchEvent(new Event('change'));

          // clear previous preview
          target_preview.innerHtml = '';

          // set or change the preview image src
          items.forEach(function (item) {
            let img = document.createElement('img')
            img.setAttribute('style', 'height: 5rem')
            img.setAttribute('src', item.thumb_url)
            target_preview.appendChild(img);
          });

          // trigger change event
          target_preview.dispatchEvent(new Event('change'));
        };
      });
    };

    lfm('lfm2', 'file', {prefix: route_prefix});
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
  </script>
@endsection