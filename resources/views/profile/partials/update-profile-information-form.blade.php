<section x-data="{ photoName: null, photoPreview: null, isPhotoRemoved: false }">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address, including your profile photo.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- FORMULARIO PRINCIPAL: Cambio a 'PUT' y 'enctype' para la foto -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- CAMPO PARA LA FOTO DE PERFIL -->
        <div class="col-span-6 sm:col-span-4">
            <x-input-label for="photo" value="{{ __('Photo') }}" />

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
            <div class="mt-2" x-show="! photoPreview">
                @if (Auth::user()->photo)
                <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                    alt="{{ Auth::user()->name }}"
                    class="rounded-full h-20 w-20 object-cover">
                @else
                <!-- Imagen por defecto si no tiene foto -->
                <img src="{{ asset('images/default-user.png') }}"
                    alt="Foto por defecto"
                    class="rounded-full h-20 w-20 object-cover">
                @endif
            </div>


            <!-- Previsualización de la nueva foto -->
            <div class="mt-2" x-show="photoPreview" style="display: none;">
                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                    x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>

            <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('Select A New Photo') }}
            </x-secondary-button>

            <!-- Botón opcional para eliminar la foto -->
            @if (Auth::user()->profile_photo_path)
            <x-secondary-button type="button" class="mt-2"
                x-on:click.prevent="
                        isPhotoRemoved = true; 
                        photoPreview = null;
                        $refs.photo.value = null; // Limpiar el input file
                    ">
                {{ __('Remove Photo') }}
            </x-secondary-button>
            @endif

            <x-input-error for="photo" class="mt-2" :messages="$errors->get('photo')" />
        </div>

        <!-- CAMPO NOMBRE -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- CAMPO APELLIDO 1 -->
        <div>
            <x-input-label for="lastname1" :value="__('Last Name')" />
            <x-text-input id="lastname1" name="lastname1" type="text" class="mt-1 block w-full" :value="old('lastname1', $user->lastname1)" required autocomplete="lastname1" />
            <x-input-error class="mt-2" :messages="$errors->get('lastname1')" />
        </div>

        <!-- CAMPO APELLIDO 2 -->
        <div>
            <x-input-label for="lastname2" :value="__('Second Last Name')" />
            <x-text-input id="lastname2" name="lastname2" type="text" class="mt-1 block w-full" :value="old('lastname2', $user->lastname2)" autocomplete="lastname2" />
            <x-input-error class="mt-2" :messages="$errors->get('lastname2')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>