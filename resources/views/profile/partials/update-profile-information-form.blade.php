<section x-data="{ photoName: null, photoPreview: null, isPhotoRemoved: false }">
    <header>
        <h2 class="h4 mb-2">
            {{ __('Profile Information') }}
        </h2>

        <p class="text-muted mb-4">
            {{ __("Update your account's profile information and email address, including your profile photo.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="d-none">
        @csrf
    </form>

    <!-- Main Form: Changed to 'PUT' and 'enctype' for photo -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-4" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- CAMPO PARA LA FOTO DE PERFIL -->
        <div class="mb-3">
            <label for="photo" class="form-label">{{ __('Photo') }}</label>

            <!-- Campo oculto para indicar si la foto actual debe eliminarse -->
            <input type="hidden" name="_profile_photo_removal" x-model="isPhotoRemoved">

            <!-- Input de archivo oculto con referencia Alpine -->
            <input type="file"
                id="photo"
                name="photo"
                class="hidden"
                x-ref="photo"
                x-on:change="
                       photoName = $refs.photo.files[0].name;
                       const reader = new FileReader();
                       reader.onload = (e) => {
                           photoPreview = e.target.result;
                           isPhotoRemoved = false; // Si seleccionas una nueva, no se elimina
                       };
                       reader.readAsDataURL($refs.photo.files[0]);
                   " />

            <!-- Foto de perfil actual -->
            <div class="mt-2 mb-3" x-show="! photoPreview">
                @if (Auth::user()->photo)
                <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                    alt="{{ Auth::user()->name }}"
                    class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                @else
                <!-- Imagen por defecto si no tiene foto -->
                <img src="{{ asset('images/icono_sin_imagen.png') }}"
                    alt="Foto por defecto"
                    class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                @endif
            </div>


            <!-- Previsualización de la nueva foto -->
            <div class="mt-2 mb-3 mx-auto" x-show="photoPreview" style="width: 80px; height: 80px; overflow: hidden;">
                <img x-bind:src="photoPreview" alt="Previsualización de la foto" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
            </div>

            <button type="button" class="btn btn-secondary mt-2 me-2" x-on:click.prevent="$refs.photo.click()">
                {{ __('Select A New Photo') }}
            </button>

            <!-- Botón opcional para eliminar la foto -->
            @if (Auth::user()->photo)
            <button type="button" class="btn btn-danger mt-2"
                x-on:click.prevent="
                        isPhotoRemoved = true; 
                        photoPreview = null;
                        $refs.photo.value = null; // Limpiar el input file
                    ">
                {{ __('Remove Photo') }}
            </button>
            @endif

            @error('photo')<div class="text-danger mt-2">{{ $message }}</div>@enderror
        </div>

        <!-- CAMPO NOMBRE -->
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
        </div>

        <!-- CAMPO APELLIDO 1 -->
        <div class="mb-3">
            <label for="lastname1" class="form-label">{{ __('Last Name') }}</label>
            <input id="lastname1" name="lastname1" type="text" class="form-control" value="{{ old('lastname1', $user->lastname1) }}" required autocomplete="lastname1" />
            @error('lastname1')<div class="text-danger mt-2">{{ $message }}</div>@enderror
        </div>

        <!-- CAMPO APELLIDO 2 -->
        <div>
            <label for="lastname2" class="form-label">{{ __('Second Last Name') }}</label>
            <input id="lastname2" name="lastname2" type="text" class="form-control" value="{{ old('lastname2', $user->lastname2) }}" autocomplete="lastname2" />
            @error('lastname2')<div class="text-danger mt-2">{{ $message }}</div>@enderror
        </div>

        <div class="d-flex align-items-center mt-4">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="ms-3 text-success">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>