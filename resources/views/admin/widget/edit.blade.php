@extends('admin.layouts.app')


@section('content')

<main> 
   
    <div class="container-fluid px-4">
        <!--h1 class="mt-4">Admin</h1-->
        <ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item active">
              <a href="{{ route('admin.widget.index') }}" title="Go back">Назад к списку виджетов</a>
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
                
                   
                
            <div class="tab-content pt-2" id="tab-content">

                 <div class="tab-pane active" id="setting_panel" role="tabpanel" aria-labelledby="setting">

                    <form id="setting_form" action="">
                    <div class="col-md-12 m-2">
                        <label for="widget_name" class="form-label">Название виджета</label>
                        <input type="text" value="{{ $widget->title }}" name="title" class="form-control" id="widget_name">
                        <div class="valid-feedback">                      
                        </div>
                    </div>
                    
                   <div class="col-md-12 m-2">
                             <label  class="form-label">Изображение виджета</label>
                        <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm2" data-input="thumbnail2" data-preview="holder2" class="btn btn-primary text-white">
                            <i class="fa fa-picture-o"></i> Выбрать
                            </a>
                        </span>
                        <input id="thumbnail2" value="{{ ($widget->thumbnail ?? "") }}" class="form-control" type="text" name="thumbnail">
                        </div>
                        </div>

                    <div class="col-md-12 m-2">
                            <label for="widget_template" class="form-label">Шаблон виджета</label>
                            <select class="form-select form-select-sm" name="template" aria-label=".form-select-sm example">
                                @foreach($files as $f)
                                @php
                                    $result = str_replace('.blade.php', '', $f->getFilename());
                                @endphp
                                    <option value="{{ $result }}" {{ ($result == $widget->template)?" selected":"" }}>
                                        {{ str_replace('.blade.php', '', $f->getFilename()); }}
                                    </option>
                                @endforeach    
                            </select>
                        </div>

                      </form>

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

                                    @if(isset($widget->jsonvalue) && $widget->jsonvalue)
                                        @php
                                        echo 'var data_json ='.json_encode($widget->jsonvalue);
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

                                 
                                @endif

                        document.querySelector('#save').addEventListener('click', alldata);

                                        function getData() {
                                        const formData = new FormData(document.querySelector('form#setting_form'));
                                    
                                        const jsonObject = {};
                                        
                                        jsonObject.setting = Object.fromEntries(formData);
                                     
                                        return jsonObject;
                                        }


                                        function alldata()
                                        {
                                          //  console.log(getData());
                                            fetch("{{ route('admin.widget.update', $widget->id) }}", {
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
  <!-- script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script-->
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




