@extends('layouts.home')

@section('head')
    <link rel="stylesheet" href="{{asset('css/homes/put_up.css')}}">
@endsection

@section('title', '出品')


@section('main')
    @component('components.head')
        @slot('title', '出品')
        @slot('caption', 'PUT UP')
    @endcomponent

    <put-up-component
        v-bind:seller_id="{{Auth::user()->id}}"
        v-bind:categories="{{($categories)}}"
        v-bind:sub_categories="{{($sub_categories)}}"
        v-bind:all_tags="{{($tags)}}"
        v-bind:old="{{ json_encode(Session::getOldInput()) }}"
    >
        <template v-slot:csrf_token>
            @csrf
        </template>

        <template v-slot:name_error>
            @error('name')
            <p class="form_error">{{$message}}</p>
            @enderror
        </template>

        <template v-slot:image_error>
            @error('image')
            <p class="form_error">{{$message}}</p>
            @enderror
        </template>


        <template v-slot:price_error>
            @error('price')
            <p class="form_error">{{$message}}</p>
            @enderror
        </template>

        <template v-slot:text_error>
            @error('text')
            <p class="form_error">{{$message}}</p>
            @enderror
        </template>

        <template v-slot:category_error>
            @error('category')
            <p class="form_error">{{$message}}</p>
            @enderror
        </template>

        <template v-slot:sub_category_error>
            @error('sub_category')
            <p class="form_error">{{$message}}</p>
            @enderror
        </template>

        <template v-slot:tags_error>
            @error('tags')
            <p class="form_error">{{$message}}</p>
            @enderror
        </template>
    </put-up-component>


@endsection
