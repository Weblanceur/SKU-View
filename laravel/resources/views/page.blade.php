@extends('layouts.app')

{{--<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>--}}

@section('content')
    <x-moonshine::grid>
        <x-moonshine::column colSpan="12">
            <x-moonshine::card>
                {{ $form->render() }}
                @if($error)
                    <x-moonshine::alert type="warning" removable="true">
                        {{ $error }}
                    </x-moonshine::alert>
                @endif
            </x-moonshine::card>
        </x-moonshine::column>
        @if(sizeof($items))
            <x-moonshine::column colSpan="12">
                <x-moonshine::table>
                    <x-slot:thead>
                        <th>Город</th>
                        <th>Название</th>
                        <th>Штрихкод</th>
                        <th>Артикул</th>
                        <th>Просмотр</th>
                    </x-slot:thead>
                    <x-slot:tbody>
                        @foreach($items as $item)
                            <tr>
                                <th>
                                    <x-moonshine::badge color="primary">{{ $item->city?->name }}</x-moonshine::badge>
                                </th>
                                <th>{{ $item->title }}</th>
                                <th>{{ $item->barcode }}</th>
                                <th>{{ $item->vendor_code }}</th>
                                <th>
                                    <x-moonshine::modal wide title="{{ $item->title }}">
                                        <x-moonshine::grid>
                                            <x-moonshine::column colSpan="6">
                                                <x-moonshine::box>{!! $item->text !!}</x-moonshine::box>
                                            </x-moonshine::column>
                                            <x-moonshine::column colSpan="6">
                                                <x-moonshine::card class="text-center items-center">
                                                    <img style="height:420px;width:auto;margin-bottom:1rem" src="storage/{{ $item->image }}"
                                                         alt="{{ $item->title }}"/>
                                                    <object style="margin:auto;" data="storage/{{ $item->pdf }}" width="229" height="161"></object>
                                                    <x-moonshine::badge class="mt-2" color="primary">{{ $item->city?->name }}</x-moonshine::badge>
                                                </x-moonshine::card>
                                            </x-moonshine::column>
                                        </x-moonshine::grid>
                                        <x-slot name="outerHtml">
                                            <x-moonshine::link-button icon="heroicons.eye" @click.prevent="toggleModal">
                                                Открыть
                                            </x-moonshine::link-button>
                                        </x-slot>
                                    </x-moonshine::modal>
                                </th>
                            </tr>
                        @endforeach
                    </x-slot:tbody>
                </x-moonshine::table>
            </x-moonshine::column>
        @endif
    </x-moonshine::grid>
@endsection

<style>
    .modal {
        overflow: hidden !important;
    }
    .modal-dialog {
        margin: 0 !important;
        padding: 0 !important;
    }
    .modal-dialog-xl {
        max-width: 100vw !important;
        min-height: 100vh !important;
        height: 100vh;
    }
    .modal-content {
        height: 100% !important;
    }
</style>
