@extends('web.layouts.app')

@php
    //echo "список полей страницы"; +
   // $result = App\Services\GetPageFields::get_custon_fields_for_page($page['id']);
     //   print_r($result);

    //echo "список полей компонентов";

    //$r= App\Services\GetComponentFields::component_field($page['id']);
      //  print_r($r);
@endphp

@section('content')

        @php
        print_r($page);
        @endphp

        <!--x-pages.footer_contact_data /-->

 @endsection
