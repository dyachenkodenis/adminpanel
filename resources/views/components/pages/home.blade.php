<form id="{{ $id }}">


  <!--div class="col-md-12">
    <label for="titlePage" class="form-label">Заголовок страницы</label>
    <input type="text" name="title_page" class="form-control" id="titlePage" >
    <div class="valid-feedback">  
    </div>
  </div>

   <div class="col-md-12">
    <label for="slugPage" class="form-label">Ссылка на страницу</label>
    <input type="text" name="slug_page" class="form-control" id="slugPage" >
    <div class="valid-feedback">
    </div>
  </div-->

  
  {{-- блок виджетов --}}
   <div class="col-md-12">
    @php
    $widget_page = json_decode($widget, true);
   // dd($widget_page);
    if(isset($widget_page) && $widget_page):
    @endphp
    @foreach($widget_page as $ww)   
      @php
      $t =  App\Services\GetWidgetTemplateFromId::get_template($ww['id']);          
      $template = $t[0]['template']; 
      $title =  $t[0]['title'];
      @endphp
    <div class="card mt-4">
       <div class="card-header">
          <h3>Виджет: {{ $title }}</h3>
      </div>
    <div class="card-body">   
    @includeWhen($template, 'components.widget.'.$template) 
    </div>
    </div>
    @endforeach
    @php
      endif;
    @endphp
   </div>
 {{-- блок виджетов --}}
   

  </form> 