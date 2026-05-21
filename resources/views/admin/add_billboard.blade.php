@extends('layouts.app')

@section('title', "GTA 6 Billboards")
@section('description', "Admin - Add billboard")

@push('styles')
    @vite(['resources/css/admin/add_billboard.css'])
@endpush

@section('content')
    <main id="main">
        <section id="formSection">
            <h2>Add billboard</h2>
            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $newId }}">
                <fieldset>
                    <legend>Contributor</legend>
                    <div class="inputCont" data-dir="vertical" id="existingContribCont">
                        <label for="contributorId">Existing contributor :</label>
                        <select name="contributorId" id="contributorId" required>
                            <option value="" disabled selected>Select a contributor</option>
                            @foreach ($contributors as $contributor)
                            <option value="{{ $contributor->id }}">{{ $contributor->username }} [{{ $contributor->contribution_number }}]</option>
                            @endforeach
                        </select>
                        <button type="button" class="btnLink" id="addContributorBtn"><i class='iiicon' data-name='add'></i> Add contributor</button>
                    </div>
                    <div class="inputCont hidden" id="newContribCont">
                        <label for="newContributorUsername">New contributor :</label>
                        <input type="text" name="newContributorUsername" id="newContributorUsername">
                    </div>
                </fieldset>
                <div class="inputCont">
                    <label for="image">Image :</label>
                    <input type="file" name="image" id="image" accept="image/png, image/jpeg" required>
                </div>
                <div class="inputCont">
                    <label for="score">Score :</label>
                    <input type="number" name="score" id="score" min="0" max="4" value="0" required>
                </div>
                <div class="inputGroup">
                    <div class="inputCont">
                        <label for="width">Width :</label>
                        <input type="number" name="width" id="width" min="1" max="4" value="1" required>
                    </div>
                    <div class="inputCont">
                        <label for="height">Height :</label>
                        <input type="number" name="height" id="height" min="1" max="4" value="1" required>
                    </div>
                </div>
                <details>
                    <summary>Size preview</summary>
                    <div id="sizePreviewGrid">
                        <div id="sizePreview">
                            <img id="imagePreview" src="" alt="">
                        </div>
                    </div>
                </details>
                <div class="inputCont">
                    <label for="group">Group :</label>
                    <select name="group" id="group" required>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                        <option value="{{ $newId }}" selected>[New group]</option>
                    </select>
                </div>
                <div class="inputCont" data-dir="vertical">
                    <label for="name">Name :</label>
                    <input type="text" name="name" id="name" list="existingNames" required placeholder="Main subject">
                </div>
                <div class="inputCont" data-dir="vertical">
                    <label for="description">Description :</label>
                    <textarea name="description" id="description" cols="30" rows="10" required placeholder="Textual description of the billboard"></textarea>
                </div>
                <div class="inputCont" data-dir="vertical">
                    <label for="remark">Remark (HTML) :</label>
                    <textarea name="remark" id="remark" cols="30" rows="10" placeholder="Additional comment"></textarea>
                </div>
                <fieldset>
                    <legend>Zone</legend>
                    <div class="inputCont" data-dir="vertical" id="existingZoneCont">
                        <label for="zoneId">Existing zone :</label>
                        <select name="zoneId" id="zoneId" required>
                            <option value="" disabled selected>Select a zone</option>
                            @foreach ($zones as $zone)
                                <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btnLink" id="addZoneBtn"><i class='iiicon' data-name='add'></i> Add zone</button>
                    </div>
                    <div class="inputCont hidden" id="newZoneCont">
                        <label for="newZoneName">New Zone :</label>
                        <input type="text" name="newZoneName" id="newZoneName">
                    </div>
                </fieldset>
                <div class="inputGroup">
                    <div class="inputCont">
                        <label for="coord_x">X :</label>
                        <input type="number" name="coord_x" id="coord_x" value="0.0" step="0.00001" required>
                    </div>
                    <div class="inputCont">
                        <label for="coord_y">Y :</label>
                        <input type="number" name="coord_y" id="coord_y" value="0.0" step="0.00001" required>
                    </div>
                </div>
                <button type="submit">Add billboard</button>
            </form>
        </section>

        <datalist id="existingNames">
            @foreach ($existingBillboardNames as $existingName)
                <option value="{{ $existingName->name }}"></option>
            @endforeach
        </datalist>
    </main>
@endsection

@push('scripts')
    @vite(['resources/js/admin/add_billboard.js'])
@endpush