@extends('layouts.app')

<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>

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
                                                    <img style="height: 480px;width:auto;" src="storage/{{ $item->image }}"
                                                         alt="{{ $item->title }}"/>
                                                    <svg id="barcode"></svg>
                                                    <br/>
                                                    <script>
                                                        JsBarcode("#barcode", {{$item->barcode}})
                                                        document.getElementById('barcode').style.cssText += `width: 100%`
                                                    </script>
                                                    {{ $item->title }}<br/>
                                                    Артикул: {{ $item->vendor_code }} <br/>
                                                    <x-moonshine::badge color="primary">{{ $item->city?->name }}</x-moonshine::badge>
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
    .modal-dialog-xl {
        max-width: 100% !important;
    }
</style>
