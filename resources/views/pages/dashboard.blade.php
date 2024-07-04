@extends('components.layout.index')
@section('content')

    @include('components.allert.success')

    {{-- ISI DASHBOARD --}}
    <div class="w-full mt-2">
        @include('pages.pemilik.index')
    </div>
    <div class="mt-1 flex flex-wrap -mx-6">

        
        <div class="w-full pl-4 sm:w-4/5 xl:w-1/2 mt-4">
            @include('pages.jenis_bts.index')
        </div>
        
        <div class="w-full pl-4 sm:w-4/5 xl:w-1/2 mt-4">
            @include('pages.wilayah.index')
        </div>
        @component('components.allert.modal')
            Data
        @endcomponent
        

        <div class="mt-8"></div>
    @endsection
