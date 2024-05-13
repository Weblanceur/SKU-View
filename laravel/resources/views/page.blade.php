@extends('layouts.app')

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
                    <x-slot:tbody>
                        @foreach($items as $item)
                            <tr>
                                <th>{{ $item->title }}</th>
                                <th>{{ $item->barcode }}</th>
                                <th>{{ $item->vendor_code }}</th>
                                <th>
                                    <x-moonshine::modal wide title="{{ $item->title }}">
                                        <div>
                                            {!! $item->text !!} <br/>
                                            {{ $item->barcode }} <br/>
                                            {{ $item->vendor_code }} <br/>
                                        </div>
                                        <x-slot name="outerHtml">
                                            <x-moonshine::link-button @click.prevent="toggleModal">
                                                Open wide modal
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
