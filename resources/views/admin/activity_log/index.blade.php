@extends('admin.layouts.app')


@section('content')
 
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Активность пользователей</h1>
       
       
        <div class="card mb-4">
           
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название страницы</th>
                            <th>Статус публикации</th>                         
                            <th>Дата создания</th>                           
                            
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Название страницы</th>
                            <th>Статус публикации</th>                         
                            <th>Дата создания</th>                    
                          
                        </tr>
                    </tfoot>
                    <tbody>
                         @foreach ($log as $content)
                        <tr>
                             <td>{{ ($content->id ?? "") }}</td>
                            <td>{{ ($content->title ?? "") }}</td>
                            <td>{{ ($content->status ?? "") }}</td>  
                            <td>{{ ($content->created_at ?? "") }}</td>                         
                         
                        
                        </tr>
                        @endforeach
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@endsection

@section('table_script')
<script src="/admin_panel/assets_admin/js/Chart.min.js" ></script> 
@endsection