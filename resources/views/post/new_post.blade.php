@extends('main_design')

@section('post.new_post')
    @if (session('post_message'))
        <div class="alert alert-success" role="alert">
            {{ session('post_message') }}
        </div>
    @endif

    <div class="contact-page section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <form id="contact-form" action="{{ route('post.post_new_post') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <h2 class="text-center">Create a New Post</h2>
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title"
                                        class="@error('title') is-invalid @enderror" placeholder="Enter title..."
                                        autocomplete="on" value="{{ old('title') }}" required>
                                    @error('title')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="@error('description') is-invalid @enderror" placeholder="Enter description....." required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="hidden_proof">Hidden Proof</label>
                                    <input type="text" name="hidden_proof" id="hidden_proof"
                                        class="@error('hidden_proof') is-invalid @enderror" placeholder="Enter hidden proof..."
                                        autocomplete="on" value="{{ old('hidden_proof') }}">
                                    @error('hidden_proof')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="occurrence_time">Occurrence Time</label>
                                    <input type="time" name="occurrence_time" id="occurrence_time"
                                        class="@error('occurrence_time') is-invalid @enderror"
                                        value="{{ old('occurrence_time') }}">
                                    @error('occurrence_time')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="occurrence_date">Occurrence Date</label>
                                    <input type="date" name="occurrence_date" id="occurrence_date"
                                        class="@error('occurrence_date') is-invalid @enderror"
                                        value="{{ old('occurrence_date') }}" min="2000-01-01" max="{{ date('Y-m-d') }}" required>
                                    @error('occurrence_date')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="autocomplete">Location</label>
                                    <input type="text" id="autocomplete" name="location"
                                        class="@error('location') is-invalid @enderror" placeholder="Enter location..."
                                        value="{{ old('location') }}">
                                    @error('location')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    {{-- <label for="latitude">Latitude</label> --}}
                                    <input type="hidden" id="latitude" name="latitude">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    {{-- <label for="longitude">Longitude</label> --}}
                                    <input type="hidden" id="longitude" name="longitude">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="contact_number">Contact Number</label>
                                    <input type="text" name="contact_number" id="contact_number"
                                        class="@error('contact_number') is-invalid @enderror" placeholder="Enter contact number..."
                                        value="{{ old('contact_number') }}">
                                    @error('contact_number')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="hide_private_info">Hide Private Info</label>
                                    <input type="text" name="hide_private_info" id="hide_private_info"
                                        class="@error('hide_private_info') is-invalid @enderror" placeholder="Enter private info to hide..."
                                        value="{{ old('hide_private_info') }}">
                                    @error('hide_private_info')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="images">Images</label>
                                    <input type="file" name="images[]" id="images"
                                        class="@error('images.*') is-invalid @enderror" multiple>
                                    @error('images.*')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="type">Type</label>
                                    <select name="type" id="type" class="form-select @error('type') is-invalid @enderror"
                                        required>
                                        <option value="">-- Select Type --</option>
                                        <option value="lost" {{ old('type') == 'lost' ? 'selected' : '' }}>Lost</option>
                                        <option value="found" {{ old('type') == 'found' ? 'selected' : '' }}>Found</option>
                                    </select>
                                    @error('type')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>
                             <div class="col-lg-12">
                                <fieldset>
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror" required>
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            @if (!is_null($category->parent_id))
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>

                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="orange-button">Add Post</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>| Contact Us</h6>
                        <h2>Get In Touch With Our Agents</h2>
                    </div>
                    <p>When you really need to download free CSS templates, please remember our website TemplateMo. Also,
                        tell your friends about our website. Thank you for visiting. There is a variety of Bootstrap HTML
                        CSS templates on our website. If you need more information, please contact us.</p>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="item phone">
                                <img src="assets/images/phone-icon.png" alt="" style="max-width: 52px;">
                                <h6>010-020-0340<br><span>Phone Number</span></h6>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="item email">
                                <img src="assets/images/email-icon.png" alt="" style="max-width: 52px;">
                                <h6>info@villa.co<br><span>Business Email</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
